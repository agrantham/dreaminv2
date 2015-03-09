# Stripe

A simple package for processing credit card payments through the Stripe API. 
If enabled the package will send a confirmation email to the payer using the
FuelPHP email package.

# Summary
* Gather payer information (email, amount).
* Use Stripe checkout.js V2 to gather card information: https://checkout.stripe.com/v2/checkout.js
* Charge credit cards for payments via Stripe API using a charge token and passing a valid email
* Send receipts per transaction to payer.

# Version
0.1.1

# LICENSE
MIT LICENSE http://opensource.org/licenses/MIT

Copyright (c) 2013 Alleluu.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## TODO

- Enable onsite form for Credit Card processing (creates a more fluid checkout process).

## Installation
- This package uses the Stripe PHP SDK and it must be correctly included for this package to work. We recommend using composer. 
	* See https://getcomposer.org/doc/00-intro.md#installation-nix.
	* See https://packagist.org/packages/stripe/stripe-php.
	* See http://fuelphp.com/blogs/2013/01/fuelphp-and-composer.
- Place the package contents in /fuel/packages/stripe (the directory name must be stripe).
- Copy the sample config file and place it in your environment config. Include the correct Stripe API values (key, secret or test key, test secret).
- Add 'stripe' to the list of packages loaded on Fuel's startup in /fuel/app/config/config.php 

### Optional configuration
- To enable email receipts, set the config value 'send_email' to TRUE and select and email driver for the email package. See the config comments for additional options.
- Create a template for the receipt emails. There are two ways a template can be created:
	* A fuelPHP view. The view will have access to the following values: ```$name, $amount, $description, $order_id```
	* A string containing the following values: ```$name, $amount, $description, $order_id```
	
   The description, email subject and template can be set in the config file or overwritten by passing it as a POST value to the stripe/charge controller method. 
	
## Usage
### Making a Transaction

I order to separate the presentation from the logic of the package, the fuel-stripe contains some core functionality and example views (email and form) you can use to get you started.
First create a controller like [this](#create-a-controller). To make a transaction you must first collect the amount to be charged as well as the users personal email address (used to send a receipt to the payer). 
After that, you provide a custom button that calls in JavaScript the StripeCheckout function from the Stripe API.

You do not need to include a form for the credit card info as the StripeCheckout function will open up an iframe to their servers containing the required form fields to securely capture these information.. 

Here is a breakdown of the payment flow **(Bold letters makr who is responsible for each part of the process)**:

- **(My App)** Using Javascript (jQuery), we collect each form field’s value (emai, amount), and validate the form.
- **(My App)** We pass this information directly to Stripe's server, using Stripe's checkout.js.
- **(Stripe)** Confidential information (CC, Address) is captured on Stripe's end using an iframe.
- **(Stripe)** Stripe’s server will ensure that the credit card data is well-formed, prepare a transaction and send us back a “single-use token”.
- **(My App)** We pass the token, email and amount to the Controller_Stripe::action_charge (stripe/charge). Optional parameters can be passed to overwrite the defaults:
    * subject: Subject of the Email.
    * description: Brief description of the transaction, this is used as the body of the email.
    * template: path to the view or hardcoded template for the email receipt.
- **(Fuel-Stripe)** The package performs input validation, CSRF and XSS security checks.
- **(Fuel-Stripe)** The package contacts Stripe again using the SDK for PHP and triggers the actual charge to the credit card.
- **(Fuel-Stripe)** If something goes wrong the package returns a response with an error message and a 40X error code.
- **(Fuel-Stripe, Fuel-Mail)** If enabled the package will use the FuelPHP email package to send a receipt.
- **(Fuel-Stripe)** If no errors occur, there is a [response](#response) with the order ID and whether or not the email was sent.
- **(My App)** The response of the controller is then used to display the correct message (either an error or a confirmation page).


## Sample Code

### Create a controller
The package includes an working example, create the following test controller to run it:

```php
class Controller_Test extends Controller
{
    public function __construct()
    {
        Config::load('stripe');
    }
    public function action_example()
    {
        View::set_global('publishable_key', Config::get('publishable_key'));
        return Response::forge(View::forge('stripe/donate'));
    }

    public function action_refund($charge_id)
    {
        $stripe_payment = new \Stripe\Stripe_Payment();
        $charge = $stripe_payment->refund($charge_id);
    }
}  
```

### Stripe Payment Class & Refunds
If you don't wish to use the controller inclded with the package you can still use our simple abstraction of the Stripe payment class, it contains a payment proccessing method and a refund method:
```php

\Config::load('stripe');        
$stripe_payment = new \Stripe\Stripe_Payment();
$charge = $stripe_payment->process($token_id, $amount, $email);

// Refunds are not included in the controller_stripe but can be performed if the order ID is known:
$stripe_refund = new \Stripe\Stripe_Payment();
$refund = $stripe_refund->refund($charge->id);
```

### Sample JS
The example view contains inline JS that will get you started. See the code in views/stripe/donate.php:


### Response
The controller extends from the rest controller and will return one of the 
following responses in the selected format:
```php
    // Success 200
    array( 
        // If for some reason the email driver throws an exception email_success
        // will return false, the charge will still be made.
        'email_success' => true,  
        'order_id' => $charge->id,
    ); 
    
    // Error 40X
    // If an error occurs the transaction will fail and the correct error code will be returned along with an error message.
    
```
### Configuration

    return array(
        'secret_key'      => 'sk_test_zCWLWHaCd3dV782yDmDfetTZ',
        'publishable_key' => 'pk_test_lAOaTUbdQw0nlrOeGWtoiXor',
        'csrf_check'      => true, // perform an additional security check. Must pass a fuel csrf token.
        'send_email'      => true,  // If you don't desire to send emails set to false

    	'email'           => array(
            'html'          => true,              // send email with html code
            'use_view'      => true,              // use a view instead of a hard-coded template
            'template'      => 'stripe/receipt',  // view location for the template or hard-coded template
            //'template'    => 'Hello $name thank you for your donation of $$amount. <br><br> $description',
            'description'   => '',                // default email description, can be overwritten
            'driver'        => 'ses',             // default email driver 
            'from'          => '',                // default from email
            'reply_to'      => '',                // default reply_to email
            'subject'       => 'Thank you for your donation', // default subject, can be overwritten
            ),  
    );


We have created an email driver For AWS SES that can be found in our github page

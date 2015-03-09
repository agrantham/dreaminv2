<?php

return array(
    /**
     * Stripe Publishable key
     */
    'publishable_key' => 'pk_test_h5lK3s6n1SYgwMbOKna4MK8u',

    /**
     * Stripe Secret key
     */
    'secret_key'      => 'sk_test_pUBwNRZ5QrtHpGaPLZ212Kyu',

    /**
     * A fuel Cross Site Request Forgery token can be used for additional security.
     * This value can be passed to the Stripe/Charge method. The name of the token
     * must match the one set in app/config/config.php under 'security.csrf_token_key'
     *
     * For more information visit:
     * http://fuelphp.com/docs/general/security.html#csrf
     * http://fuelphp.com/docs/classes/security.html#/method_fetch_token
     * http://fuelphp.com/docs/classes/security.html#/method_js_fetch_token
     */
    'csrf_check'      => true,

    /**
     * Enable sending receipts via email using the FuelPHP Email Package.
     */
    'send_email'      => false,
    'email'           => array(
        /**
         * If true it will set the body of the email using html_body.
         * "The html_body method sets the message body and optionally generates
         * the alt body from it. If specified the inline images will be attached
         * inline automatically."
         */
        'html'          => true,

        /**
         * If true the value of 'template' will be used as the path to the view use to
         * generate the body of the email. If false a hard coded template can be set.
         * Placeholders will be replaced with the correct values for either
         * template method.
         *
         */
        'use_view'      => true,

        /**
         * Default template for the email. This value can be overwritten by passing a
         * 'template' parameter to the Stripe/Charge method.
         *
         * Template Placeholders:
         * $name        Name of the user
         * $amount      Value charged to the user
         * $order_id    The Order/Charge ID.
         * $description Description of the transaction
         *
         * EXAMPLE USING user_view FALSE:
         * 'template'  => 'Hello $name thank you for your donation of $$amount. <br><br> $description. Your order id is $order_id',
         *
         * EXAMPLE USING user_view TRUE:
         * see views/stripe/receipt.php
         */
        'template'      => 'stripe/receipt',

        /**
         * Default description of the email. This value can be overwritten by
         * passing a 'descripton' parameter to the Stripe/Charge method.
         */
        'description'   => 'Payment Receipt',

        /**
         * Choose the preferred email driver.
         */
        'driver'        => 'mail',

        /**
         * Default 'from' email
         */
        'from'          => 'admin@mydomain.com',

        /**
         * Default 'reply to' email
         */
        'reply_to'      => 'do-not-reply@mydomain.com',

        /**
         * Default subject of the email. This value can be overwritten by passing a
         * 'subject' parameter to the Stripe/Charge method.
         */
        'subject'       => 'Default Subject Goes Here',
    ),
 );

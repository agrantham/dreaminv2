<?php
/**
 * Wrapper class to process stripe payment.
 *
 * @package fuel-stripe
 * @version 0.1.1
 * @author  Devin Hanlon <devin.hanlon@alleluu.com>
 * @author  Juan Manuel Torres <juan.torres@alleluu.com>
 * @license MIT License
 * @copyright  2013-2014 Alleluu Development team
 * @link  https://github.com/alleluu/fuel-stripe
 * @link  http://opensource.org/licenses/MIT
 */
namespace Stripe;

class PaymentException extends \FuelException{}

class Stripe_Payment
{

    public function __construct()
    {
        \Config::load('stripe');

        $stripe = array(
            'secret_key'      => "sk_test_pUBwNRZ5QrtHpGaPLZ212Kyu",
            'publishable_key' => "pk_test_h5lK3s6n1SYgwMbOKna4MK8u"
        );

        \Stripe::setApiKey($stripe['secret_key']);
    }

    /**
     * Uses the stripe charge class to process the payment. PaymentException is
     * thrown if an error occurs.
     *
     * @param type $token_id
     * @param type $amount
     * @param type $email
     * @return type
     * @throws PaymentException
     */
    public function process($token_id, $amount, $email, $customer)
    {
        try
        {
            $charge = \Stripe_Charge::create(array(

                'amount'   => $amount,
                'currency' => 'usd',
                'description' => $email,
                'customer' => $customer
            ));
        }
        catch(\Stripe_Error $e)
        {
            throw new PaymentException($e->getMessage());
        }

        return $charge;
    }

    /**
     * @todo Test refund method
     */
    public function refund($order_id)
    {
        try
        {
            $charge = \Stripe_Charge::retrieve($order_id);
            $charge->refund();
        }
        catch(\Stripe_Error $e)
        {
            throw new PaymentException($e->getMessage());
        }

        return $charge;
    }

    /**
     * Creates a validaton object checking the fields token_id, amount and email
     *
     * @return Fuel validation object
     */
    public function validate()
    {
        $val = \Validation::forge();
        $val->add_field('token_id', 'Token', 'required|max_length[50]');
        $val->add_field('amount', 'Amount', 'required|valid_string[numeric]');
        $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');

        return $val;
    }

    public function new_customer($token,$email = null, $plan = null)
    {
        try {
            $customer = \Stripe_Customer::create(array(
                    'card' => $token,
                    'email' => $email,
                    'plan' => $plan
                ));
            return $customer->id;
        }
        catch(\Stripe_Error $e)
        {
            return false;
        }
    }

    public function get_customer($customerid)
    {
        try {
            $customer = \Stripe_Customer::retrieve($customerid);
            return $customer;
        } catch (\Stripe_Error $e){
            return false;
        }
    }

    public function getPlans()
    {
        $plans = \Stripe_Plan::all();
        return $plans;
    }
}
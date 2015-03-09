<?php

Autoloader::add_core_namespace('Stripe');

Autoloader::add_classes(array(
        /**
        * Stripe classes.
        */
        'Stripe\\Controller_Stripe'     => __DIR__.'/classes/controller/stripe.php',
        'Stripe\\Stripe_Payment'       => __DIR__.'/classes/stripe/payment.php',

));
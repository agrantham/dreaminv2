/**
 * All angular AngularJS components are wrapped in JavaScript Closures or Immediately Invoked Function Expression (IIFE) to remove variables from global scope
 *  Why?
 *  - An IIFE removes variables from the global scope. This helps prevent variables and function declarations from living longer than expected in the global
 *  scope, which also helps avoid variable collisions.
 *  - When your code is minified and bundled into a single file for deployment to a production server, you could have collisions of variables and many global
 *  variables. An IIFE protects you against both of these by providing variable scope for each file.
 */

(function() {
    'use strict';

    angular
        .module("app")
        .factory('stripefac', stripefac);

        function stripefac($rootScope, $q, $http, $state){
            var plans = [];
            var sh = {
                subscribeUser               : subscribeUser,
                getPlans                    : getPlans,
                updateSubscription          : updateSubscription,
                plans                       : plans,
                createToken                 : createToken,
                deleteCustomer              : deleteCustomer,
                updateCustomerCard          : updateCustomerCard,

            }
            return sh;

            //////////////

            function subscribeUser(token,email,plan)
            {
                var defer = $q.defer();
                $http.post('/users/subscribe',{token:token,email:email,plan:plan})
                .success(function(data){
                    console.log(data);

                    defer.resolve(data);
                })
                .error(function(data){
                    console.log(data);
                    defer.reject();
                });

                return defer.promise;
            }


            function getPlans()
            {
                var defer = $q.defer();
                 $http.post("/users/getplans")
                .success(function(data){
                    sh.plans = data.plans;
                    console.log(data);
                    defer.resolve();
                })
                .error(function(data){
                    console.log(data);
                });
                return defer.promise;
            }

            function updateSubscription(stripe_id)
            {
                var defer = $q.defer();
                // Process:
                // $cu = Stripe_Customer::retrieve("cus_5IFzSNpS4ouqSH");
                // $subscription = $cu->subscriptions->retrieve("sub_5IFzaBoneiWRlp");
                // $subscription->plan = "Egg";
                // $subscription->save();

                return defer.promise;
            }

            function cancelSubscription(stripe_id)
            {
                var defer = $q.defer();
                // process
                // $cu = Stripe_Customer::retrieve("cus_5IFzSNpS4ouqSH");
                // $cu->subscriptions->retrieve("sub_5IFzaBoneiWRlp")->cancel();

                return defer.promise;
            }

            function updateCustomerCard(token)
            {
                var defer = $q.defer();
                var defer = $q.defer();
                $http.post('/users/updatecard',{token: token})
                .success(function(data){
                    if(data.result){
                        defer.resolve();
                    } else {
                        defer.reject();
                    }
                })
                .error(function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;

                return defer.promise;
            }

            function createToken(card)
            {
                var defer = $q.defer();
                 Stripe.card.createToken({
                    number      : card.cardNumber,
                    cvc         : card.cvc,
                    exp_month   : card.expMonth,
                    exp_year    : card.expYear
                },function(status,response){
                    if(status != 200){
                        defer.reject();
                    } else {
                        var _return = {};
                        _return.status = status;
                        _return.response = response;
                        defer.resolve(_return);
                    }

                });

                return defer.promise;
            }

            function deleteCustomer(stripe_id)
            {
                var defer = $q.defer();

                return defer.promise;
            }
        }



})();
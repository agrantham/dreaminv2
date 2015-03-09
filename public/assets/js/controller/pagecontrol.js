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
      .module('app')
      .controller('pagecontrol', pagecontrol);

    //pagecontrol.$inject = ["$scope","$http","$element","$timeout","$q","userAuth","clouds","drops","droplets","ezfb"];

    function pagecontrol($state,$scope,$http,$timeout,$upload,userAuth,clouds,$q,$modal,ezfb,stripefac){
      var vm = this;

        vm.submitCreds                  = submitCreds;
        vm.checkPassEmail               = checkPassEmail;
        vm.resetPassword                = resetPassword;
        vm.stripeResponseHandler        = stripeResponseHandler;
        vm.createToken                  = createToken;
        vm.login                        = login;
        vm.logout                       = logout;
        vm.updateUser                   = updateUser;
        vm.editUser                     = editUser;
        vm.updatePassword               = updatePassword;
        vm.changegroup                  = changegroup;
        vm.updateCustomerCard           = updateCustomerCard;
        vm.createUpdateToken            = createUpdateToken;
        vm.upload                       = upload;

        vm.userLogin                    = userAuth.auth;
        vm.users                        = userAuth.users;
        vm.user                         = userAuth.user;
        vm.subPlans                     = stripefac.plans;
        vm.updateUserObj                = {};
        vm.newPass                      = {};

        vm.username                     = null;
        vm.password                     = null;
        vm.pwrecover                    = {};
        vm.result                       = null;
        vm.message                      = false;
        vm.cardError                    = false;
        vm.updateCreditCardFlag         = false;
        vm.disableCreditCard            = false;
        vm.card                         = {};
        vm.groupType                    = 3;
        vm.files                        = {};
        vm.newCloudList                 = clouds.newCloudList;


        /* starter functions, get dreams, get users */

        $scope.$on("getPlans",function(){
            vm.subPlans = stripefac.plans;
        });

        $scope.$on('newCloudList',function(){
            vm.newCloudList = clouds.newCloudList;
        })

        $scope.$on("$stateChangeStart",function(){
            vm.userLogin    = userAuth.auth;
            vm.user         = userAuth.user;
        });

        $scope.$watch('files', function(){
           vm.upload(vm.files);
        })

        function upload(files)
        {
          console.log(files);
        }

        function changegroup(userid,newgroup)
        {
            console.log("user id is "+userid);
            console.log("groupid is "+groupid)
        }

        function submitCreds()
        {
            userAuth.login(vm.credentials.username,vm.credentials.password).then(function(data){
              vm.user = data;
            },function(){
              setMessage('log in failed');
            });
        }

        function IsEmail(email)
        {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
        }

        function resetPassword()
        {
            if(vm.pwrecover.username !== ""){
                vm.pwrecover.result = null;
                vm.pwrecover.message = false;
                userAuth.resetPassword(vm.pwrecover.username).then(function(data){
                    vm.pwrecover.result = data.result;
                    setMessage(data.message);
                },function(data){
                    setMessage('Password update failed');
                })
            } else {
                vm.result = false;
                setMessage("You must enter a username");
            }
        }

        function updatePassword()
        {
           userAuth.updatePassword(vm.newPass).then(function(){
              setMessage("Password Updated!");
              vm.newPass = {};
           },function(data){
              setMessage("Failed to update password");
              vm.newPass = {};
           });
        }

        function editUser()
        {

        }

        function setMessage(message)
        {
           vm.message = message;
           $timeout(function(){
                 vm.message = false;
            },3000)
        }

        function updateUser()
        {
           userAuth.update(vm.user).then(function(){
              setMessage("Information Updated");
           },function(){
             setMessage("Failed to update information");
           })
        }

        function checkPassEmail()
        {
            if(vm.credentials.password !== "" && vm.credentials.username !== ""){
                if(IsEmail(vm.credentials.username)){
                    vm.credentials.error = "";
                    vm.userLogin = true;
                } else {
                    vm.credentials.error = "Email is not a valid email";
                }
            }
        }

        function login()
        {
            userAuth.login(vm.username, vm.password).then(function(){
              vm.user           = userAuth.user;
              vm.userLogin      = userAuth.auth;
            },function(){
              setMessage("Credentials were incorrect");
            });
        }

        function logout() {
            userAuth.logout().then(function(){
                $state.go('home');
            },function(){

            })
          /**
           * Calling FB.logout
           * https://developers.facebook.com/docs/reference/javascript/FB.logout

          ezfb.logout(function () {
              updateLoginStatus(updateApiMe);
          });
           */

        function fblogin() {
          /**
           * Calling FB.login with required permissions specified
           * https://developers.facebook.com/docs/reference/javascript/FB.login/v2.0
           */
          ezfb.login(function (res) {
            /**
             * no manual $scope.$apply, I got that handled
             */
            if (res.authResponse) {
              updateLoginStatus(updateApiMe);
            }
          }, {scope: 'email,user_likes'});
        };


        };

        $scope.share = function () {
          ezfb.ui(
            {
              method: 'feed',
              name: 'angular-easyfb API demo',
              picture: 'http://plnkr.co/img/plunker.png',
              link: 'http://plnkr.co/edit/qclqht?p=preview',
              description: 'angular-easyfb is an AngularJS module wrapping Facebook SDK.' +
                           ' Facebook integration in AngularJS made easy!' +
                           ' Please try it and feel free to give feedbacks.'
            },
            function (res) {
              // res: FB.ui response
            }
          );
        };

        /**
         * For generating better looking JSON results
         */
        var autoToJSON = ['loginStatus', 'apiMe'];
        angular.forEach(autoToJSON, function (varName) {
          $scope.$watch(varName, function (val) {
            $scope[varName + 'JSON'] = JSON.stringify(val, null, 2);
          }, true);
        });

        /**
         * Update loginStatus result
         */
        function updateLoginStatus(more) {
          ezfb.getLoginStatus(function (res) {
            vm.loginStatus = res;
            (more || angular.noop)();
          });
        }

        /**
         * Update api('/me') result
         */
        function updateApiMe() {
          ezfb.api('/me', function (res) {
              userAuth.login(null,null,true,res.id).then(function(data){

              },function(data){
                  // login didnt make it via social media
                 // Not necessarily a bad thing. happens when logout
              })
          });
        }

        //////// stripe info

        function createToken() {
            var elmnt = document.getElementById('payment-button');
            //Disable the submit button to prevent repeated clicks
            angular.element(elmnt).prop('disabled', true);
            stripefac.createToken(vm.card).then(function(data){
                vm.card = {};
                vm.stripeResponseHandler(data);
            },function(data){
                vm.card = {};
                console.log(data);
            });
            // Prevent the form from submitting with the default action
            return false;
        };

        function createUpdateToken() {
            var elmnt = document.getElementById('payment-button');
            //Disable the submit button to prevent repeated clicks
            angular.element(elmnt).prop('disabled', true);
            stripefac.createToken(vm.card).then(function(data){
                vm.card = {};
                vm.updateCustomerCard(data);
            },function(data){
                vm.card = {};
                setMessage("You entered incorrect credit card information");
            });
            // Prevent the form from submitting with the default action
            return false;
        };

        function updateCustomerCard(data){
            var elmnt       = document.getElementById('payment-button');
            var response    = data.response;
            var status      = data.status;
             if (response.error) {
                // Show the errors on the form
                vm.cardError = response.error.message;
                angular.element(elmnt).prop('disabled', false);
            } else {
                stripefac.updateCustomerCard(response.id).then(function(data){
                    setMessage("Credit Card updated successfully");
                    vm.updateCreditCardFlag = false;
                    vm.disableCreditCard = true;
                },function(data){
                    setMessage("Sorry your information could not be updated, contact administrator.")
                });
            }
        }

        function stripeResponseHandler(data) {
            var elmnt       = document.getElementById('payment-button');
            var response    = data.response;
            var status      = data.status;
            if (response.error) {
                // Show the errors on the form
                vm.cardError = response.error.message;
                angular.element(elmnt).prop('disabled', false);
            } else {
                stripefac.subscribeUser(response.id,vm.newCustomer.email,vm.newCustomer.plan).then(function(data){
                    if(data.result){
                        userAuth.create(vm.newCustomer,data.customer).then(function(data){
                            if(data){
                                $state.go('home');
                            }
                        },function(data){
                            console.log(data);
                        })
                    } else {
                        console.log('failed to create stripe customer');
                    }
                },function(){
                    // creating failed
                    setMessage("We were unable to complete your sign up");
                })
            }
        };


    }

})();
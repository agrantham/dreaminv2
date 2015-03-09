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
        .factory('userAuth', userAuth);

        function userAuth($rootScope, $q, $http, $state){
            var auth        = false;
            var user        = {};
            var users       = {};
            var dreams      = {};
            var sh = {
                auth        : auth,
                login       : login,
                logout      : logout,
                dreams      : dreams,
                user        : user,
                users       : users,
                getUsers    : getUsers,
                checkStatus : checkStatus,
                resetPassword : resetPassword,
                create      : create,
                update      : update,
                updatePassword : updatePassword,
                adminGetUsers : adminGetUsers,
                refreshUser     : refreshUser,
                getUser : getUser,
                updateGroup : updateGroup,
                checkPlanDreams : checkPlanDreams,

            }
            return sh;

            //////////////
            function getUsers(){
                var defer = $q.defer();
                $http.post('users/getAll')
                .success(function(data){
                    console.log(data);
                    sh.users = data;
                    defer.resolve();
                })
                .error(function(data){
                    console.log(data);
                });
                return defer.promise;
            }
            function updateGroup(userid,groupid)
            {
                var defer = $q.defer();
                $http.post('/users/updategroup', { userid : userid, groupid : groupid})
                .success(function(data){
                    if(data){
                        defer.resolve(true);
                    } else {
                        defer.reject(false);
                    }

                })
                .error(function(data){
                    console.log(data);
                })
                return defer.promise;
            }

            function checkPlanDreams()
            {
                var defer = $q.defer();
                $http.post("/users/checkPlanDreams")
                .success(function(data){
                    console.log(data);
                    defer.resolve(data);
                })
                .error(function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }



            function refreshUser(){
                var defer = $q.defer();
                console.log(sh.user.id);
                defer.resolve(true);
                return defer.promise;
            }

            function getUser(userid)
            {
                var defer = $q.defer();
                $http.post("/users/getuser", {userid: userid})
                .success(function(data){
                    console.log(data);
                    sh.user = data;
                    defer.resolve(data);
                })
                .error(function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }
            function adminGetUsers(){
                var defer = $q.defer();
                $http.post('users/getalladmin')
                .success(function(data){
                    console.log(data);
                    sh.users = data;
                    defer.resolve();
                })
                .error(function(data){
                    console.log(data);
                });
                return defer.promise;
            }

            function logout()
            {
                var defer = $q.defer();

                $http.post('/users/logout')
                .success(function(){
                    console.log('logged out');
                    sh.user = sh.dreams = {};
                    sh.auth = false;
                    $rootScope.$broadcast('securityStateChange');
                    defer.resolve();
                },function(){
                    defer.reject();
                })
                return defer.promise;
            }


            function login(username, password,facebooklogin,userfbid )
            {
                var defer = $q.defer();
                $http.post('/api/login',{username : username,password : password})
                .success(function(data){
                    console.log(data);
                    if(data){
                        // validation succeed, user logged in
                        sh.user = data.user;
                        sh.auth = true;
                        $state.go(data.location);
                        $rootScope.$broadcast('securityStateChange');
                        console.log('logged in');
                        defer.resolve();
                    } else {
                        // validation failed
                        defer.reject();
                    }
                })
                .error(function(data){
                    defer.reject(data);
                });
                return defer.promise;
            };

            function checkStatus(){
                var defer = $q.defer();
                    $http.post('/api/login')
                    .success(function(data){
                        console.log(data);
                        if(data){
                            sh.user = data.user;
                            sh.auth = true;
                            $rootScope.$broadcast('securityStateChange');
                            $state.go(data.location);
                            defer.resolve();
                        } else {
                            console.log('failed');
                            defer.reject();
                        }
                    })
                    .error(function(data){
                        // connection to server failed or call blew up
                        console.log(data);
                    });

                return defer.promise;
            }


            function resetPassword(username)
            {
                var defer = $q.defer();
                $http.post('/users/resetpassword', {username:username})
                .success(function(data){
                    console.log(data);
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function updatePassword(creds)
            {
                var defer = $q.defer();
                $http.post('/users/updatepassword', {creds: creds})
                .success(function(data){
                    if(data){
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
            }


            function create(customer,stripe_id)
            {
                var defer = $q.defer();
                $http.post('/users/add',{newCustomer:customer,stripe_id:stripe_id})
                .success(function(data){
                    console.log(data);
                    defer.resolve(data);
                })
                .error(function(data){
                    console.log(data);
                    defer.reject(data);
                })
                return defer.promise;
            }

            function update(userObj)
            {
                var defer = $q.defer();

                $http.post("/users/update", {userObj:userObj})
                .success(function(data){
                    console.log(data);
                    if(data){
                        defer.resolve();
                    } else {
                        defer.reject();
                    }
                })
                .error(function(data){
                    console.log(data);
                    defer.reject();
                });

                return defer.promise;
            }

        }




})();
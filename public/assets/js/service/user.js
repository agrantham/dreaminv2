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
        .factory('user', user);

        function user($rootScope, $q, $http, $state, userAuth){

            var sh = {
                add         : add,
                remove      : remove,
                update      : update,
                addCloud    : addCloud,
                removeCloud : removeCloud
            };
            return sh;

            //////////////////

            // function getAll()
            // {
            //     var defer = $q.defer();
            //     $http.post("/clouds/getall")
            //     .success(function(data){
            //         defer.resolve(data);
            //     },function(data){
            //         console.log(data);
            //         defer.reject();
            //     });
            //     return defer.promise;
            // }

            // function getC(cloudid)
            // {
            //     var defer = $q.defer();
            //     $http.post("/clouds/get",{cloudid:cloudid})
            //     .success(function(data){
            //         defer.resolve(data);
            //     },function(data){
            //         console.log(data);
            //         defer.reject();
            //     });

            //     return defer.promise;
            // }

            function add(cloudObj)
            {
                var defer = $q.defer();
                $http.post("/clouds/add",{cloudObj:cloudObj})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function remove(cloudid)
            {
                var defer = $q.defer();
                $http.post("/clouds/delete",{cloudid:cloudid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function update(cloudObj)
            {
                var defer = $q.defer();
                $http.post("/clouds/update",{cloudObj:cloudObj})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function addCloud(userid,cloudid)
            {
                var defer = $q.defer();
                $http.post("/users/addcloud",{cloudid:cloudid,userid:userid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function removeCloud(userid,cloudid)
            {
                var defer = $q.defer();
                $http.post("/users/removecloud",{cloudid:cloudid,userid:userid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

        }

})();
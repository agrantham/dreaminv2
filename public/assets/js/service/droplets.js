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
        .factory('droplets', droplets);

        function droplets($rootScope, $q, $http, $state, userAuth){

            var sh = {
                getAll      : getAll,
                getDroplet  : getDroplet,
                add         : add,
                remove      : remove,
                update      : update,
            };
            return sh;

            //////////////////

            function getAll()
            {
                var defer = $q.defer();
                $http.post("/droplets/getall")
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function getDroplet(dropletid)
            {
                var defer = $q.defer();
                $http.post("/droplets/get",{dropletid:dropletid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function add(dropletObj)
            {

                var defer = $q.defer();
                $http.post("/droplets/add",{dropletObj:dropletObj})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function remove(dropletid)
            {
                var defer = $q.defer();
                $http.post("/droplets/delete",{dropletid:dropletid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function update(dropletObj)
            {
                var defer = $q.defer();
                $http.post("/droplets/update",{dropletObj:dropletObj})
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
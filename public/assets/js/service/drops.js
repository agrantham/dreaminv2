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
        .factory('drops', drops);

        function drops($rootScope, $q, $http, $state, userAuth){

            var sh = {
                getAll          : getAll,
                getDrop         : getDrop,
                add             : add,
                remove          : remove,
                update          : update,
                addDroplet      : addDroplet,
                removeDroplet   : removeDroplet
            };
            return sh;

            //////////////////

            function getAll()
            {
                var defer = $q.defer();
                $http.post('/drops/getall')
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject(false);
                })
                return defer.promise;
            }

            function getDrop(dropid)
            {
                var defer = $q.defer();
                $http.post("/drops/get",{dropid:dropid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function add(dropObj)
            {
                console.log(dropObj);
                var defer = $q.defer();
                $http.post('/drops/add',{dropObj:dropObj})
                .success(function(data){
                    console.log(data);
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function remove(dropid)
            {
                var defer = $q.defer();
                $http.post("/drops/delete",{dropid:dropid})
                .success(function(data){
                    defer.resolve();
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function update(dropObj)
            {
                console.log(dropObj);
                var defer = $q.defer();
                $http.post("/drops/update",{dropObj:dropObj})
                .success(function(data){
                    defer.resolve();
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function addDroplet(dropid,dropletid)
            {
                var defer = $q.defer();
                $http.post("/drops/adddroplet",{dropid:dropid,dropletid:dropletid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function removeDroplet(dropid,dropletid)
            {
                var defer = $q.defer();
                $http.post("/drops/removeroplet",{dropid:dropid,dropletid:dropletid})
                .success(function(data){
                    if(data){
                        defer.resolve();
                    } else {
                        defer.reject();
                    }
                },function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

        }

})();
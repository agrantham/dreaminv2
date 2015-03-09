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
        .factory('clouds', clouds);

        function clouds($rootScope, $q, $http, $state, userAuth){
            var newCloudList = {};
            var sh = {
                getAll          : getAll,
                getCloud        : getCloud,
                add             : add,
                remove          : remove,
                update          : update,
                addDrop         : addDrop,
                removeDrop      : removeDrop,
                dreamData       : dreamData,
                newClouds       : newClouds,
                refresh         : refresh,
                addTag          : addTag,
                deleteTag       : deleteTag,
                verifyNumberOfDrops : verifyNumberOfDrops,

            };
            return sh;

            //////////////////

            function getAll()
            {
                var defer = $q.defer();
                $http.post("/clouds/getall")
                .success(function(data){
                    console.log(data);
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function newClouds()
            {
                var defer = $q.defer();
                $http.post("/clouds/newclouds")
                .success(function(data){
                    console.log(data);
                    sh.newCloudList = data;
                    defer.resolve();
                })
                .error(function(data){
                    console.log(data);
                    defer.reject(data);
                })

                return defer.promise;
            }

            function verifyNumberOfDrops(cloudid)
            {
                var defer = $q.defer();
                $http.post("/clouds/verifynumberofdrops",{cloudid: cloudid})
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

            function addTag(cloudid,tagName)
            {
                var defer = $q.defer();
                $http.post('/tags/add',{tagName : tagName})
                .success(function(data){
                    console.log(data);
                    if(data){
                        $http.post("/tags/addcloud", {cloudid:cloudid,tagid:data.id})
                        .success(function(dataTwo){
                            if(dataTwo){
                                defer.resolve(data);
                            }
                        })
                        .error(function(data){
                            console.log(data)
                            defer.reject();
                        })
                    }
                })
                .error(function(data){
                    console.log(data);
                    defer.reject();
                })
                return defer.promise;
            }

            function deleteTag(cloudid,tagid)
            {
                var defer = $q.defer();
                $http.post("/tags/removeCloud", {cloudid:cloudid,tagid:tagid})
                .success(function(data){
                    if(data){
                        defer.resolve(data);
                    } else {
                        defer.reject(data);
                    }
                })
                .error(function(data){
                    defer.reject(data);
                    console.log(data);
                })
                return defer.promise;
            }

            function refresh()
            {
                var defer = $q.defer();
                $http.post("/clouds/refresh")
                .success(function(data){
                    if(data){
                        defer.resolve(data);
                    } else {
                        defer.reject(false);
                    }
                })
                .error(function(data){
                    console.log(data);
                })
                return defer.promise;
            }

            function getCloud(cloudid)
            {
                var defer = $q.defer();
                $http.post("/clouds/get",{cloudid:cloudid})
                .success(function(data){
                    console.log(data);
                    sh.dreamData = data;
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });

                return defer.promise;
            }

            function add(cloudObj)
            {
                console.log('inside add cloud');
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
                    // php only returns true
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject(data);
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

            function addDrop(cloudid,dropid)
            {
                var defer = $q.defer();
                $http.post("/clouds/adddrop",{cloudid:cloudid,dropid:dropid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function removeDrop(cloudid,dropid)
            {
                var defer = $q.defer();
                $http.post("/clouds/removedrop",{cloudid:cloudid,dropid:dropid})
                .success(function(data){
                    defer.resolve(data);
                },function(data){
                    console.log(data);
                    defer.reject();
                });
                return defer.promise;
            }

            function dreamData()
            {
                var defer = $q.defer();
                defer.resolve();

                return defer.promise;
            }

        }

})();
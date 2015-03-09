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
        .config(function(
            $interpolateProvider,$stateProvider,$urlRouterProvider,$locationProvider,ezfbProvider
        ){
        Stripe.setPublishableKey('pk_test_h5lK3s6n1SYgwMbOKna4MK8u');
        $locationProvider.hashPrefix('!');
        $urlRouterProvider.otherwise("");
        $stateProvider

        .state('home', {
            url: '/home',
            templateUrl: '/ng/home/home.html',

            resolve : {
                users: function(userAuth,$rootScope){
                    return userAuth.getUsers().then(function(data){

                    },function(){
                        console.log('failed to get users');
                    });
                },
                userLogin : function(userAuth,$rootScope){
                    return userAuth.checkStatus().then(function(data){

                        //$rootScope.$broadcast('securityStateChange');
                    },function(){
                        console.log('not logged in');
                    });
                }
            },
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]
            },
            controller : 'pagecontrol as body'
        })
        .state('dream', {
            url: '/dream/:cloudid',
            templateUrl: '/ng/dreams/dreamdash.html',
            resolve: {
                dreamData : function(clouds,$stateParams){
                    return clouds.getCloud($stateParams.cloudid).then(function(data){
                        console.log(data);
                        return data;
                    },function(data){
                        console.log(data);
                        console.log('failed dreamdata resovled');
                    });
                }
            },
            controller : 'dreamcubator as dream',
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]

            }
        })

        .state('messages', {
            url: '/mesages',
            templateUrl: '/ng/messages/messages.html',
            data : {
                requireLogin : true,
                groupid         : [ 3, 4, 5, 6 ]
            }
        })

        .state('notifications', {
            url: '',
            templateUrl: '/ng/notifications/notifications.html',
            data : {
                requireLogin : true,
                groupid         : [ 3, 4, 5, 6 ]
            }
        })
        .state('moderator', {
            url: '/moderator',
            templateUrl : '/ng/admin/moderate.html',
            controller : 'pagecontrol as body',
            data : {
                requireLogin : true,
                groupid     : [ 4 ]
            }
        })
        .state('admin', {
            url: '/admin',
            templateUrl : '/ng/admin/admin.html',
            controller : 'pagecontrol as body',
            data : {
                requireLogin : true,
                groupid         : [ 5 ]
            },
            resolve : {
                users: function(userAuth,$rootScope){
                    return userAuth.adminGetUsers().then(function(){

                    },function(){
                        console.log('failed to get users');
                    });
                },
                newCloudList : function(clouds,$rootScope){
                    return clouds.newClouds().then(function(data){

                        console.log('got new clouds');
                        console.log(data);

                    },function(data){
                        console.log(data);
                        console.log('failed to get new clouds');
                    })
                }
            },
        })
        .state('settings.updateuser', {
            url : 'updateuser',
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]

            },
            onEnter : [ '$stateParams', '$state', '$modal', function($stateParams, $state, $modal,userAuth ) {
                        $modal.open({
                            templateUrl : '/ng/settings/updateuser.html',
                            resolve : {
                                user : function(userAuth){
                                    return userAuth.user;
                                }
                            },
                            controller : [ '$scope', 'user', function($scope, user){

                            }],
                            size : 'lg',
                            backdrop : true
                        }).result.finally(function(){
                            $state.go('settings');
                        });
                    }]
        })
        .state('admin.edituser', {
            url: '/edituser/:userid',
            templateUrl : '/ng/admin/edituser.html',
            controller : 'pagecontrol as body',
            data : {
                requireLogin : true,
                groupid         : [ 5 ]
            },
            // resolve : {
            //     user: function(userAuth,$rootScope,$stateParams){

            //         return userAuth.getUser($stateParams.userid).then(function(data){

            //         },function(){
            //             console.log('failed to get users');
            //         });
            //     },
            // },
            onEnter : [ '$stateParams', '$state', '$modal', function($stateParams, $state, $modal,userAuth ) {
                        $modal.open({
                            templateUrl : '/ng/admin/edituser.html',
                            resolve : {
                                user : function(userAuth){
                                    return userAuth.getUser($stateParams.userid).then(function(data){
                                        return data;
                                    },function(){
                                        console.log(data);
                                    });
                                }
                            },
                            controller : [ '$scope', 'user','userAuth', function($scope, user,userAuth){
                                $scope.user = user;
                                $scope.message = false;

                                $scope.changegroup = function(userid,groupid)
                                {
                                    userAuth.updateGroup(userid,groupid).then(function(data){
                                        $scope.message = "Success";
                                    },function(data){

                                    })
                                }
                            }],
                            size : 'lg',
                            backdrop : true
                        }).result.finally(function(){
                            $state.go('admin',true);
                        });
                    }]
        })
        .state('ironman', {
            url: '/ironman',
            templateUrl : '/ng/admin/ironman.html',
            controller : 'pagecontrol as body',
            data : {
                requireLogin : true,
                groupid      : [ 6 ]
            }
        })
        .state('profile', {
            url: '/profile',
            templateUrl: '/ng/profile/profile.html',
            controller : 'dreamcubator as dreamin',
            data : {
                requireLogin : true,
                groupid         : [ 3 ]
            }
        })
        .state('settings', {
            url: '/settings',
            templateUrl: '/ng/settings/settings.html',
            data : {
                requireLogin : true,
                groupid         : [ 3, 4, 5, 6 ]
            }

        })
        .state('passwordRecovery', {
            url: 'passwordrecovery',
            templateUrl: '/ng/help/passwordRecovery.html',
            controller : 'pagecontrol',
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]

            }
        })
        .state('usernameRecovery', {
            url: 'usernamerecovery',
            templateUrl: '/ng/help/usernameRecovery.html',
            controller : 'userAuth',
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]

            }
        })
        .state('notifications.new-notification', {
            url: '',
            templateUrl: '/ng/notifications/new-notification.html',
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]

            }
        })
        .state('signup', {
            url: 'signup',
            templateUrl: '/ng/profile/new.html',

            resolve : {
                subPlans : function(stripefac,$rootScope){
                    return stripefac.getPlans().then(function(data){

                    },function(){
                        console.log('failed to get plans');
                    });
                },
            },
            data : {
                requireLogin : false,
                groupid         : [2, 3, 4, 5, 6 ]

            },
            controller : 'pagecontrol as body'
        })



        // Facebook angular login provider details
        ezfbProvider.setInitParams({
            appId : '303125566538286'

        })

    })
})();
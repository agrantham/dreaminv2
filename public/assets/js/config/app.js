
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
        .module('app',[
            'ui.router',
            'ezfb',
            'ui.bootstrap',
            'angularFileUpload',
            'angularUtils.directives.dirDisqus'
        ]);
})();



(function(){
    angular
        .module('app')
        .run(function($rootScope,userAuth,$state){
            $rootScope.$on('$stateChangeStart', function(event, toState, toParams){
                var requiresLogin = toState.data.requireLogin;
                var groupid         = toState.data.groupid;
                if(requiresLogin){
                    if(userAuth.user.group_id != undefined){
                        //console.log(groupid.indexOf(parseInt(userAuth.user.group_id)));
                        if(!userAuth.auth || (groupid.indexOf(parseInt(userAuth.user.group_id)) == -1)) {
                            $state.go('home');
                            event.preventDefault();
                        }
                    } else {
                        $state.go('home');
                        event.preventDefault();
                    }
                }
            })
        })
})();




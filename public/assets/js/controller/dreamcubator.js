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
        .controller('dreamcubator', dreamcubator);

        //dreamcubator.$inject = ["$scope", "$timeout","$http","userAuth","droplets","drops","clouds","ezfb","$stateParams"];

        function dreamcubator($scope, $timeout, $q, $http,$state, userAuth, ezfb, $stateParams,clouds,drops,droplets){
            var vm = this;

            $scope.contentLoaded        = false;
            vm.addTagFlag = false;
            vm.newCloud  = vm.newDroplet =  vm.newDrop = vm.message = vm.deleteFlag = false;
            vm.currentCloudId = vm.currentDropId = null;
            vm.addNewTag = null;
            vm.currentDrop = {};
            vm.addCloud = {};
            vm.addDrop = {};
            vm.addDroplet = {};
            vm.editCloud = {};
            vm.dreamData           = clouds.dreamData;

            //vm.currentCloud        = {};
            //vm.disqus_identifier   = vm.currentDrop.dropName;

            vm.submitCloud          = submitCloud;
            vm.submitDrop           = submitDrop;
            vm.submitDroplet        = submitDroplet;
            vm.updateDropStatus     = updateDropStatus;
            vm.refreshAll           = refreshAll;
            vm.deleteDrop           = deleteDrop;
            vm.assignCurrentCloud   = assignCurrentCloud;
            vm.assignCurrentDrop   = assignCurrentDrop;
            vm.deleteCloud          = deleteCloud;
            vm.dropListLength       = dropListLength;
            vm.updateDropletStatus  = updateDropletStatus;
            vm.deleteDroplet        = deleteDroplet;
            vm.makeCloudPrivate        = makeCloudPrivate;
            vm.cloudFlagReview          = cloudFlagReview;
            vm.addTag                   = addTag;
            vm.deleteTag            = deleteTag;
            vm.checkPlanDreams      = checkPlanDreams;
            vm.verifyNumberOfDrops  = verifyNumberOfDrops;
            vm.dropListLength       = dropListLength;


            vm.clouds               = userAuth.user.clouds;

            $scope.$watch('clouds',function(){

                setCurrentCloud().then(function(){
                    // vm.contentLoaded = true;
                    setCurrentDrop().then(function(){
                        // cloud and drop set
                        $scope.contentLoaded = true;
                    });
                });
            })

            function dropListLength()
            {
                if(Object.keys(vm.currentDrop).length == 0){
                    return true;
                } else {
                    return false;
                }
            }

            function contentLoaded()
            {
                var defer = $q.defer();
                $scope.contentLoaded = false;

                defer.resolve();
                return defer.promise;
            }

            function setCurrentCloud()
            {
                var defer = $q.defer();
                var _counter = 1;
                if(vm.clouds.length == 0){
                    vm.currentCloudId = false;
                    vm.currentCloud = {};
                    defer.reject();
                } else {
                    angular.forEach(vm.clouds,function(value,key){
                        if(_counter == 1){
                            var _dropcount = 1;
                                vm.currentCloud = value;
                                vm.currentCloudId = key;
                                _counter++;
                                defer.resolve();
                                //setCurrentDrop();
                        }
                    });
                }
                return defer.promise;
            }
            function setCurrentDrop()
            {
                var defer = $q.defer();
                var _dropCounter = 1;
                console.log(vm.currentCloud);
                console.log(vm.currentDrop);
                if(vm.currentCloud.drops.length == 0 || vm.clouds.length == 0){
                    vm.currentDrop = {};
                    vm.currentDropId = false;
                    defer.resolve();
                } else {
                    angular.forEach(vm.currentCloud.drops,function(value,key){
                        if(_dropCounter == 1){
                            vm.currentDrop = value;
                            vm.currentDropId = key;
                            _dropCounter++;
                            defer.resolve();
                        }
                    })
                }
                return defer.promise;
            }


            function assignCurrentCloud(cloudid)
            {
                contentLoaded().then(function(){
                    vm.currentCloudId = cloudid;
                    vm.currentCloud = vm.clouds[cloudid];
                    setCurrentDrop().then(function(){
                        $scope.contentLoaded = true;
                    });
                })
            }

            function assignCurrentDrop(dropid)
            {

                vm.currentDropId        = dropid;
                vm.currentDrop          = vm.currentCloud.drops[dropid];

            }

            function refreshAll()
            {
                var defer = $q.defer();
                clouds.refresh().then(function(data){
                    console.log(data);
                    console.log(vm.currentCloudId);

                    if(Object.keys(vm.clouds).length != 0){
                        vm.clouds = data;
                        if(vm.currentCloudId != null){
                            vm.currentCloud = data[vm.currentCloudId];
                            if(typeof vm.currentCloud.drops != 'undefined'){
                                if(vm.currentCloud.drops.length !== 0){
                                    vm.currentDrop = data[vm.currentCloudId].drops[vm.currentDropId];
                                    defer.resolve();
                                } else {
                                    vm.currentDrop = {};
                                    vm.currentDropId = null;
                                    defer.resolve();
                                }

                            } else {
                                vm.currentDrop = {};
                                vm.currentDropId = null;
                                defer.resolve();
                            }
                        } else {
                            defer.resolve();
                        }
                    } else {
                        vm.clouds = data;
                        defer.resolve();
                    }
                },function(data){
                    if(data == false || data == 'false'){
                        vm.clouds = [];
                        defer.resolve();
                    } else {
                        defer.reject();
                        console.log(data);
                    }
                });
                return defer.promise;
            }

            function checkPlanDreams()
            {
                userAuth.checkPlanDreams().then(function(data){
                    if(data){
                        vm.newCloud = true;
                    } else {
                        setMessage("Currently your plan does not allow you to have anymore dreams. Please upgrade your plan to add more.");
                    }
                },function(data){
                    console.log(data);
                })
            }

            function verifyNumberOfDrops()
            {
                clouds.verifyNumberOfDrops(vm.currentCloudId).then(function(data){
                    console.log(data);
                    if(data){
                        vm.newDrop = true;
                    } else {
                        setMessage("You are not allowed to have any more drops");
                    }
                },function(data){
                    console.log(data);
                })
            }

            /// Clouds
            function getDream()
            {
                $http.post('/clouds/get', {cloudid : $stateParams.cloudid})
                .success(function(data){
                    console.log(data);
                    vm.dreamData = data.cloud;
                    vm.drops = data.drops;
                })
                .error(function(data){
                    console.log(data);
                    setMessage("Failed to retrieve Dream");
                });
            }

            function makeCloudPrivate(value)
            {
                console.log(value);
                if(value == true || value == "true" || value == 1 || value == "1"){
                    vm.currentCloud.private = 1;
                } else if (value == false || value == "false" || value == 0 || value == "0"){
                    vm.currentCloud.private = 0;
                }
                //vm.currentCloud.private = value;
                clouds.update(vm.currentCloud).then(function(data){
                    setMessage("Cloud updated!");
                },function(data){
                    setMessage("Failed to update");
                })
            }

            function cloudFlagReview(value)
            {
                console.log(value);
                 if(value == true || value == "true" || value == 1 || value == "1"){
                    vm.currentCloud.newcloud = 1;
                } else if (value == false || value == "false" || value == 0 || value == "0"){
                    vm.currentCloud.newcloud = 0;
                }
                clouds.update(vm.currentCloud).then(function(data){
                    setMessage("Cloud updated!");
                },function(data){
                    setMessage("Failed to update");
                })
            }

            function submitCloud()
            {
                console.log(vm.addCloud);
                if(vm.addCloud.title !== null && vm.addCloud.body != null && vm.addCloud.goal != null){
                    clouds.add(vm.addCloud).then(function(data){
                        vm.message = false;
                        vm.refreshAll().then(function(){
                            vm.currentCloud = data;
                            vm.currentCloud.drops = {};
                            vm.currentCloudId = data.id
                            vm.currentDrop = {};
                            vm.currentDropId = null;
                        });
                        vm.addCloud = {};
                        vm.newDroplet = vm.newDrop = vm.newCloud = false;
                        console.log(data);
                    },function(){
                        console.log('adding cloud failed');
                    });
                } else {
                    setMessage("One or more of the fields needed are empty");
                }
            }

            function deleteCloud(cloudid)
            {
                clouds.remove(cloudid).then(function(data){
                    vm.currentDrop = {};
                    vm.currentCloud = {};
                    vm.currentDropId = vm.currentCloudId = null;
                    delete vm.clouds.cloudid;
                    vm.refreshAll().then(function(){
                        setCurrentCloud().then(function(){
                            setCurrentDrop().then(function(){

                            });
                        });
                    });
                    //console.log(data);
                },function(data){
                    console.log(data);
                })
            }

            function addTag()
            {
                if(vm.addNewTag != null){
                    clouds.addTag(vm.currentCloudId,vm.addNewTag).then(function(data){
                        vm.currentCloud.tags[data.id] = data;
                        vm.addNewTag = null;
                        vm.newTagFlag = false;
                    },function(data){
                        console.log(data);
                    })
                } else {
                    setMessage("Tag cannot be empty");
                }
            }

            function deleteTag(tagid)
            {
                clouds.deleteTag(vm.currentCloudId,tagid).then(function(data){
                    console.log(data);
                    if(data){
                        delete vm.currentCloud.tags[tagid];
                        delete vm.clouds[vm.currentCloudId].tags[tagid];
                    }
                },function(data){
                    console.log(data);
                });
            }

            /// Drops
            function removeDrop(dropid)
            {
                clouds.removeDrop(vm.currentCloudId,dropid).then(function(data){
                    console.log(data);
                    vm.cloudRefresh();
                },function(data){
                    setMessage('failed to remove');
                    console.log('failed to remove');
                })
            }

            function submitDrop()
            {
                if(vm.addDrop.name != null){
                    drops.add(vm.addDrop).then(function(data){
                        if(data){
                            vm.currentDrop = data;
                            vm.currentDropId = data.id;
                            clouds.addDrop(vm.currentCloudId,data.id).then(function(data){
                                console.log(data);
                                vm.refreshAll().then(function(){
                                    if(typeof vm.currentCloud.drops == 'undefined'){
                                        vm.currentCloud.drops = {};
                                        vm.currentCloud.drops[data.id] = data;
                                    } else {
                                        vm.currentCloud.drops[data.id] = data;
                                    }
                                    vm.addDrop = {};
                                    vm.message = false;
                                    vm.newDroplet = vm.newDrop = vm.newCloud = false;

                                });
                            },function(data){
                                console.log(data);
                            });
                        }
                    },function(){
                        setMessage('adding drop failed');
                    })
                } else {
                    setMessage("You left some fields empty, fill them in and try again");
                }
            }

            function deleteDrop(dropid)
            {
                clouds.removeDrop(vm.currentCloudId,dropid).then(function(data){
                    drops.remove(dropid).then(function(data){
                        vm.currentDrop = {};
                        vm.currentDropId = false;
                        vm.refreshAll().then(function(){

                        });
                    },function(data){
                        console.log(data);
                    })
                },function(data){

                    console.log(data);
                })
            }

            function updateDropStatus(dropid)
            {
                //console.log(vm.currentCloud.drops[dropid].status);
                if(vm.currentCloud.drops[dropid].status == false){
                    vm.currentCloud.drops[dropid].status = 0;
                } else if (vm.currentCloud.drops[dropid].status == true){
                    vm.currentCloud.drops[dropid].status = 1;
                }
                vm.currentCloud.drops[dropid].status = !vm.currentCloud.drops[dropid].status;
                //console.log(vm.currentCloud.drops[dropid].status);
                drops.update(vm.currentCloud.drops[dropid]).then(function(data){
                    //console.log('updating drop  succeed');
                },function(data){
                    //console.log('updating drop failed');
                })
            }


            /// Droplet
            function submitDroplet()
            {
                if(vm.addDroplet.name != null && vm.addDroplet.body != null){
                    droplets.add(vm.addDroplet).then(function(data){
                        console.log(data);
                        if(data){
                            drops.addDroplet(vm.currentDropId,data.id).then(function(data){
                                console.log(data);
                                vm.message = false;
                                vm.addDroplet = {};
                                vm.newDroplet = vm.newDrop = vm.newCloud = false;
                                vm.refreshAll().then(function(){

                                });
                            },function(data){
                                console.log('failed to build relationship');
                            });
                        } else {
                            setMessage("Failed to add droplet, try again.");
                        }
                    },function(data){
                        console.log('failed to add droplet');
                    })
                } else {
                    setMessage("You left some fields empty, please fill in and try again");
                }
            }

            function deleteDroplet(dropletid)
            {
                droplets.remove(dropletid).then(function(data){
                    vm.refreshAll().then(function(){

                    })
                    setMessage("Droplet deleted");
                },function(data){
                    setMessage("Droplet was not deleted");
                    console.log(data);
                })
            }

            function updateDropletStatus(dropletid)
            {
                console.log(vm.currentDrop);
                //console.log(vm.currentCloud.drops[dropid].status);
                if(vm.currentDrop.droplets[dropletid].status == false){
                    vm.currentDrop.droplets[dropletid].status = 0;
                } else if (vm.currentDrop.droplets[dropletid].status == true){
                    vm.currentDrop.droplets[dropletid].status = 1;
                }
                vm.currentDrop.droplets[dropletid].status = !vm.currentDrop.droplets[dropletid].status;
                //console.log(vm.currentDrop.droplets[dropletid].status);
                droplets.update(vm.currentDrop.droplets[dropletid]).then(function(data){
                    //console.log('updating drop  succeed');
                },function(data){
                    //console.log('updating drop failed');
                })
            }

          // Call for weather api
          // $.ajax({
          //        url : "http://api.wunderground.com/api/18f8e7c862598dc7/geolookup/conditions/q/NV/Las_Vegas.json",
          //        dataType : "jsonp",
          //        success : function(parsed_json) {
          //                $scope.city = parsed_json['location']['city'];
          //                $scope.temperature = parsed_json['current_observation']['temp_f'];
            //   }
          // });

            // function resetDisqus(newIdentifier,newUrl,newTitle){
            //     console.log('resetting disqus');

            //     DISQUS.reset({
            //         reload: true,
            //         config: function () {
            //             this.page.identifier = newIdentifier;
            //             this.page.url = newUrl;
            //             this.page.title = newTitle;
            //         }
            //     });
            //     $scope.contentLoaded = true;
            // }

            // $scope.$on("securityStateChange",function(){
            //     if(userAuth.auth){
            //         vm.dreamData        = userAuth.dreams;
            //         vm.currentCloud     = vm.dreamData.clouds[0];
            //         vm.currentDrop      = vm.dreamData.clouds[0].cloudDrops[0];
            //     }
            //     $("#overlay").fadeOut();
            //     $(".login_panel").removeClass("animated bounceInDown");
            //     $(".login_panel").animate({'top':"-500"},function(){
            //         $(".login_panel").fadeOut();
            //     });
            //     vm.resetDisqus(vm.currentDrop.uuid,vm.currentDrop.url,vm.currentDrop.dropName);
            //  });

            // function resetDisqus(newIdentifier,newUrl,newTitle){
            //     console.log('inside resetDisqus');
            //     DISQUS.reset({
            //         reload: true,
            //         config: function () {
            //             this.page.identifier    = newIdentifier;
            //             this.page.url           = newUrl;
            //             this.page.title         = newTitle;
            //         }
            //     });
            //     $scope.contentLoaded = true;
            //     console.log(vm.contentLoaded);
            // }

            // function changeDrops(_dropId,newIdentifier, newUrl, event){
            //     vm.currentDrop = vm.dreamData.clouds[0].cloudDrops[_dropId];
            //     $(".dropListLi").removeClass('active');
            //     $(event.target).parent().addClass("active");
            //     vm.resetDisqus(newIdentifier,newUrl,vm.currentDrop.dropName);
            // }

            // function dropletStatus(_dropId){
            //     console.log(vm.currentDrop);
            //     angular.forEach(vm.currentDrop.droplets, function(value,key){
            //         if(value.dropId === _dropId){
            //             vm.currentDrop.droplets[key].status = !vm.currentDrop.droplets[key].status;
            //         }
            //     });
            //     console.log("break");
            //     console.log(vm.currentDrop);
            // }

            // function editOverview(_cloudId){
            //     if(_cloudId != false){
            //         // cloud id given, push cloud to edit mode
            //         vm.editCloud = vm.currentCloud;
            //     } else {
            //         // no cloud given, create empty edit cloud with temp id
            //         vm.editCloud = {};
            //         vm.currentCloud.cloudId = "new";
            //     }
            // }

            // function saveChanges(_cloudId){
            //     if(_cloudId === 'new'){
            //         // Cloud info is new, gather information and send to php for creation and save

            //     } else {
            //         // Cloud exists and just needs to be updated

            //     }
            // }
            function setMessage(message)
            {
               vm.message = message;
               $timeout(function(){
                     vm.message = false;
                },3000)
            }
        }

})();
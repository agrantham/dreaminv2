(function(){
    angular
        .module('app')
        .filter('object2Array',function(){
            return function(input){
                if(typeof input == "object"){
                    var out = [];
                    for(i in input){
                        out.push(input[i]);
                    }
                    return out;
                } else {
                    return input;
                }
            }
        })
})();
(function(){
    angular
        .module('app')
        .filter('boolean_convert',function(){
            return function(input){
                if(input == 1){
                    return "True";
                } else {
                    return "False";
                }
            }
        })
})();
(function(){
    angular
        .module('app')
        .filter('status_convert',function(){
            return function(input){
                if(input == '0' || input == 0 || input == "Inactive" || input == "inactive"){
                    return "Inactive";
                } else if (input == 1 || input == "1" || input == "active" || input == "Active") {
                    return "Active";
                } else {
                    return "Unknown";
                }
            }
        })
})();
(function(){
    angular
        .module('app')
        .filter('user_group',function(){
            return function(input){
                switch (input){
                    case "1":
                        return "Banned";
                        break;
                    case "2":
                        return "Guest";
                        break;
                    case "3":
                        return "General User";
                        break;
                    case "4":
                        return "Moderator";
                        break;
                    case "5":
                        return "Admin";
                        break;
                    case "6":
                        return "Super Admin";
                        break;
                    case "7":
                        return "Mentor";
                        break;
                    default:
                        return "None";
                        break;
                }
            }
        })
})();
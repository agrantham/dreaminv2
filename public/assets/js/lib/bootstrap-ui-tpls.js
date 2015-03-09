angular.module("template/accordion/accordion-group.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/accordion/accordion-group.html",
    "<div class=\"accordion-group\">" +
    "  <div class=\"accordion-heading\" ><a class=\"accordion-toggle\" ng-click=\"isOpen = !isOpen\">{{heading}}</a></div>" +
    "  <div class=\"accordion-body\" collapse=\"!isOpen\">" +
    "    <div class=\"accordion-inner\" ng-transclude></div>  </div>" +
    "</div>");
}]);

angular.module("template/accordion/accordion.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/accordion/accordion.html",
    "<div class=\"accordion\" ng-transclude></div>");
}]);

angular.module("template/alert/alert.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/alert/alert.html",
    "<div class='alert' ng-class='type && \"alert-\" + type'>" +
    "    <button type='button' class='close' ng-click='close()'>&times;</button>" +
    "    <div ng-transclude></div>" +
    "</div>");
}]);

angular.module("template/carousel/carousel.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/carousel/carousel.html",
    "<div ng-mouseenter=\"pause()\" ng-mouseleave=\"play()\" class=\"carousel\">" +
    "    <div class=\"carousel-inner\" ng-transclude></div>" +
    "    <a ng-click=\"prev()\" class=\"carousel-control left\">&lsaquo;</a>" +
    "    <a ng-click=\"next()\" class=\"carousel-control right\">&rsaquo;</a>" +
    "</div>" +
    "");
}]);

angular.module("template/carousel/slide.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/carousel/slide.html",
    "<div ng-class=\"{" +
    "    'active': leaving || (active && !entering)," +
    "    'prev': (next || active) && direction=='prev'," +
    "    'next': (next || active) && direction=='next'," +
    "    'right': direction=='prev'," +
    "    'left': direction=='next'" +
    "  }\" class=\"item\" ng-transclude></div>" +
    "");
}]);

angular.module("template/dialog/message.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/dialog/message.html",
    "<div class=\"modal-header\">" +
    "   <h1>{{ title }}</h1>" +
    "</div>" +
    "<div class=\"modal-body\">" +
    "   <p>{{ message }}</p>" +
    "</div>" +
    "<div class=\"modal-footer\">" +
    "   <button ng-repeat=\"btn in buttons\" ng-click=\"close(btn.result)\" class=btn ng-class=\"btn.cssClass\">{{ btn.label }}</button>" +
    "</div>" +
    "");
}]);

angular.module("template/pagination/pagination.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/pagination/pagination.html",
    "<div class=\"pagination\"><ul>" +
    "  <li ng-class=\"{disabled: noPrevious()}\"><a ng-click=\"selectPrevious()\">{{previousText || 'Previous'}}</a></li>" +
    "  <li ng-repeat=\"page in pages\" ng-class=\"{active: isActive(page)}\"><a ng-click=\"selectPage(page)\">{{page}}</a></li>" +
    "  <li ng-class=\"{disabled: noNext()}\"><a ng-click=\"selectNext()\">{{nextText || 'Next'}}</a></li>" +
    "  </ul>" +
    "</div>" +
    "");
}]);

angular.module("template/popover/popover.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/popover/popover.html",
    "<div class=\"popover {{placement}}\" ng-class=\"{ in: isOpen(), fade: animation() }\">" +
    "  <div class=\"arrow\"></div>" +
    "" +
    "  <div class=\"popover-inner\">" +
    "      <h3 class=\"popover-title\" ng-bind=\"popoverTitle\" ng-show=\"popoverTitle\"></h3>" +
    "      <div class=\"popover-content\" ng-bind=\"popoverContent\"></div>" +
    "  </div>" +
    "</div>" +
    "");
}]);

angular.module("template/tabs/pane.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/tabs/pane.html",
    "<div class=\"tab-pane\" ng-class=\"{active: selected}\" ng-show=\"selected\" ng-transclude></div>" +
    "");
}]);

angular.module("template/tabs/tabs.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/tabs/tabs.html",
    "<div class=\"tabbable\">" +
    "  <ul class=\"nav nav-tabs\">" +
    "    <li ng-repeat=\"pane in panes\" ng-class=\"{active:pane.selected}\">" +
    "      <a href=\"\" ng-click=\"select(pane)\">{{pane.heading}}</a>" +
    "    </li>" +
    "  </ul>" +
    "  <div class=\"tab-content\" ng-transclude></div>" +
    "</div>" +
    "");
}]);

angular.module("template/tooltip/tooltip-popup.html", []).run(["$templateCache", function($templateCache){
  $templateCache.put("template/tooltip/tooltip-popup.html",
    "<div class=\"tooltip {{placement}}\" ng-class=\"{ in: isOpen(), fade: animation() }\">" +
    "  <div class=\"tooltip-arrow\"></div>" +
    "  <div class=\"tooltip-inner\" ng-bind=\"tooltipTitle\"></div>" +
    "</div>" +
    "");
}]);
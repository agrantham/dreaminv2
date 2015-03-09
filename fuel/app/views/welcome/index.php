<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!-- META -->
	<meta name="description" content="">
	<meta name="author" content="Get Dreamin">

 	<base href="/">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><!-- Force IE to use the latest rendering engine -->
	<meta name="viewport" content="width=device-width, initial-scale=1"><!-- Optimize mobile viewport -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<title>Get Dreamin | Dreamcubator</title>

	<!-- CSS libraries -->
	<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.1/sandstone/bootstrap.min.css" rel="stylesheet">

	<link href="assets/css/style.css" rel="stylesheet">

	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

	<!-- Stripe workman -->
<script type="text/javascript">
    // This identifies your website in the createToken call below

	    // Bootstrap js events

  </script>



</head>
<body ng-app="app" ng-controller="pagecontrol as body" class="bg_1">
	<div class="messageBox" ng-show="body.message" id="messageBox">
		<h3 class="text-center">{{ body.message }}</h3>
	</div>
	<nav class="navbar navbar-default"  style="margin-top:15px;">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-main">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand"><img src="/assets/img/logo.png" class="img-responsive" width="163" height="79"></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="navigation-main">
	      <ul class="nav navbar-nav">
	        <li ui-sref-active="active" ng-show="!body.userLogin" ui-sref="home"><a >Home</a></li>
	        <li ui-sref-active="active" ng-show="body.userLogin && body.user.group_id == 3" ui-sref="profile"><a >Home</a></li>
	        <li ui-sref-active="active" ui-sref="messages"><a  ng-show="body.userLogin">Messages</a></li>
	        <li ui-sref-active="active" ui-sref="settings"> <a  ng-show="body.userLogin">Settings</a></li>
	        <li ui-sref-active="active" ui-sref="ironman"><a  ng-show="body.userLogin && body.user.group_id == 6">Ironman</a></li>
	        <li ui-sref-active="active" ui-sref="admin"><a  ng-show="body.userLogin && body.user.group_id == 5">Admin</a></li>
	        <li ui-sref-active="active" ui-sref="moderator"> <a  ng-show="body.userLogin && body.user.group_id == 4">Moderator</a></li>

	        <li class="pull-right" ng-show="!body.userLogin"><a ui-sref="home">Login</a></li>
	        <li class="pull-right" ng-show="body.userLogin" ng-click="body.logout()"><a href="javascript:;">Logout</a></li>

	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div class="container-fluid">
		<ui-view autoscroll="true"></ui-view>
	</div>
	<footer role="footer" class="hidden">
		<div class="row">
			<div class="col-md-6 text-left">
				<p>All rights reserved 2015. Get Dreamin! A Life Management Company</p>
			</div>
			<div class="col-md-6 text-right">
				<a ui-sref="contact">Contact</a> &nbsp;&nbsp;
				<a ui-sref="help" >Help</a>
			</div>
		</div>
	</footer>
	<!-- JS Libraries -->
	<!-- <script src="assets/js/jquery.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.js"></script>
	<script src="assets/js/lib/angular.ui-router.js"></script>
	<script src="assets/js/lib/ui-bootstrap-custom-0.12.0.js"></script>
	<script src="assets/js/lib/ui-bootstrap-custom-tpls-0.12.0.js"></script>
	<script src="assets/js/lib/easyfb.min.js"></script>
	<script src="assets/js/lib/angular-file-upload-shim.js"></script>
	<script src="assets/js/lib/angular-file-upload-all.js"></script>

	<script src="assets/js/config/app.js"></script>
	<script src="assets/js/config/app.config.js"></script>
	<!-- Angular Directives -->
	<script src="assets/js/config/cus-directive.js"></script>
	<!-- Angular Filters -->
	<script src="assets/js/config/cus-filters.js"></script>
	<!-- Angular Services -->
	<script src="assets/js/service/userAuth.js"></script>
	<script src="assets/js/service/drops.js"></script>
	<script src="assets/js/service/droplets.js"></script>
	<script src="assets/js/service/clouds.js"></script>
	<script src="assets/js/service/stripe-payment.js"></script>
	<!-- Angular Controllers -->
	<script src="assets/js/controller/pagecontrol.js"></script>
	<script src="assets/js/controller/dreamcubator.js"></script>

</body>
</html>

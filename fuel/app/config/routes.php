<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route

	'hellob(/:name)?' => array('welcome/hello', 'name' => 'hello'),

    'api/login' => array(array('GET', new Route('users/testdrop')), array('POST', new Route('users/login'))),
);
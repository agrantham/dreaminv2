<?php

class Model_Droplet extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'body',
		'status',
		'created_at',
		'updated_at',
	);

	protected static $_many_many = array(
		'drops' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'dropletid',
			'table_through'		=> 'drops_droplets',
			'key_through_to'	=> 'dropid',
			'model_to'			=> 'Model_Drop',
			'key_to'			=> 'id'
		)
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'droplets';

}

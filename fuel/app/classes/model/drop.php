<?php

class Model_Drop extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'body',
		'status',
		'commenturl',
		'created_at',
		'updated_at',
	);

	protected static $_many_many = array(
		'droplets' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'dropid',
			'table_through'		=> 'drops_droplets',
			'key_through_to'	=> 'dropletid',
			'model_to'			=> 'Model_Droplet',
			'key_to'			=> 'id'
		),
		'clouds' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'dropid',
			'table_through'		=> 'clouds_drops',
			'key_through_to'	=> 'cloudid',
			'model_to'			=> 'Model_Cloud',
			'key_to'			=> 'id'
		)
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events'			=> array('before_insert'),
			'mysql_timestamp'	=> false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events'			=> array('before_update'),
			'mysql_timestamp'	=> false,
		),
	);

	protected static $_table_name = 'drops';

}

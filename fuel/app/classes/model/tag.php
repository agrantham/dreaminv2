<?php

class Model_Tag extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'created_at',
		'updated_at',
	);

	protected static $_many_many = array(
		'clouds' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'tagid',
			'table_through'		=> 'clouds_tags',
			'key_through_to'	=> 'cloudid',
			'model_to'			=> 'Model_Cloud',
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

	protected static $_table_name = 'tags';

}

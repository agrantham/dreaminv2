<?php

class Model_Cloud extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'body',
		'status',
		'goal',
		'private',
		'version',
		'inappropriate',
		'newcloud',
		'created_at',
		'updated_at',
	);

	protected static $_many_many = array(
		'users' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'cloudid',
			'table_through'		=> 'clouds_users',
			'key_through_to'	=> 'userid',
			'model_to'			=> 'Model_User',
			'key_to'			=> 'id'
		),
		'drops' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'cloudid',
			'table_through'		=> 'clouds_drops',
			'key_through_to'	=> 'dropid',
			'model_to'			=> 'Model_Drop',
			'key_to'			=> 'id'
		),
		'clouds' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'cloudoneid',
			'table_through'		=> 'clouds_clouds',
			'key_through_to'	=> 'cloudtwoid',
			'model_to'			=> 'Model_Cloud',
			'key_to'			=> 'id'
		),
		'tags' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'cloudid',
			'table_through'		=> 'clouds_tags',
			'key_through_to'	=> 'tagid',
			'model_to'			=> 'Model_Tag',
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

	protected static $_table_name = 'clouds';

}

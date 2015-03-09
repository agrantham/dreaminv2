<?php

class Model_User extends \Model\Auth_User
{
	protected static $_properties = array(

	);

	/**
	 * @var array	many_many relationships
	 */
	protected static $_many_many = array(
		'roles' => array(
			'key_from' => 'id',
			'model_to' => 'Model\\Auth_Role',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'user_id',
			'key_through_to' => 'role_id',
		),
		'permissions' => array(
			'key_from' => 'id',
			'model_to' => 'Model\\Auth_Permission',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'user_id',
			'key_through_to' => 'perms_id',
		),
		'clouds' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'userid',
			'table_through'		=> 'clouds_users',
			'key_through_to'	=> 'cloudid',
			'model_to'			=> 'Model_Cloud',
			'key_to'			=> 'id'
		),
		'users' => array(
			'key_from'			=> 'id',
			'key_through_from'	=> 'useroneid',
			'table_through'		=> 'users_users',
			'key_through_to'	=> 'usertwoid',
			'model_to'			=> 'Model_User',
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

	protected static $_table_name = 'users';

}

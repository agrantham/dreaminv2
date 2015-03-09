<?php

namespace Fuel\Migrations;

class Create_clouds
{
	public function up()
	{
		\DBUtil::create_table('clouds', array(
			'id'		=> array('constraint' 		=> 11, 'type' 		=> 'int', 'auto_increment' => true, 'unsigned' => true),
			'title'		=> array('constraint' 		=> 255, 'type' 		=> 'varchar'),
			'body'		=> array('type' 			=> 'text'),
			'status'	=> array('constraint' 		=> 5, 'type' 		=> 'int'),
			'goal'		=> array('type' 			=> 'timestamp'),
			'created_at'=> array('constraint' 		=> 11, 'type'		=> 'int', 'null' => true),
			'updated_at'=> array('constraint' 		=> 11, 'type' 		=> 'int', 'null' => true),

		), array('id'));

		// Create relational tables for ORM
		\DBUtil::create_table('clouds_users',array(
			'cloudid' 		=> array('constraint'	=> 50,'type'	=>'varchar'),
			'userid' 		=> array('constraint'	=> 50,'type'	=>'varchar')
		),array('cloudid','userid'));

		\DBUtil::create_table('clouds_drops',array(
			'cloudid' 		=> array('constraint'	=> 50,'type'	=>'varchar'),
			'dropid' 		=> array('constraint'	=> 50,'type'	=>'varchar')
		),array('cloudid','dropid'));

	}

	public function down()
	{
		\DBUtil::drop_table('clouds');
	}
}
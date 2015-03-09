<?php

namespace Fuel\Migrations;

class Create_tags
{
	public function up()
	{
		\DBUtil::create_table('tags', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 100, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		 // Create relational tables for ORM
        \DBUtil::create_table('clouds_tags',array(
            'cloudid'       => array('constraint'   => 50,'type'    =>'varchar'),
            'tagid'        => array('constraint'   => 50,'type'    =>'varchar')
        ),array('cloudid','tagid'));
	}

	public function down()
	{
		\DBUtil::drop_table('tags');
		\DBUtil::drop_table('clouds_tags');
	}
}
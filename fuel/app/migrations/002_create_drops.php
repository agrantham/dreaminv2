<?php

namespace Fuel\Migrations;

class Create_drops
{
	public function up()
	{
		\DBUtil::create_table('drops', array(
			'id' 			=> array('constraint' => 11, 'type' 	=> 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' 			=> array('constraint' => 255, 'type' 	=> 'varchar'),
			'status' 		=> array('constraint' => 5, 'type' 		=> 'int'),
			'commenturl' 	=> array('constraint' => 255, 'type' 	=> 'varchar'),
			'created_at' 	=> array('constraint' => 11, 'type' 	=> 'int', 'null' => true),
			'updated_at' 	=> array('constraint' => 11, 'type'	 	=> 'int', 'null' => true),

		), array('id'));

		// Create relational table(s) for ORM
		\DBUtil::create_table('drops_droplets',array(
			'dropid' 			=> array('constraint'	=> 50,'type'	=>'varchar'),
			'dropletid' 		=> array('constraint'	=> 50,'type'	=>'varchar')
		),array('dropid','dropletid'));

	}

	public function down()
	{
		\DBUtil::drop_table('drops');
	}
}
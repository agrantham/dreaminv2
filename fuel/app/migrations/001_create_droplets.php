<?php

namespace Fuel\Migrations;

class Create_droplets
{
	public function up()
	{
		\DBUtil::create_table('droplets', array(
			'id' 			=> array('constraint' 	=> 11, 'type' 	=> 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' 			=> array('constraint'	=> 255, 'type' 	=> 'varchar'),
			'status' 		=> array('constraint' 	=> 5, 'type' 	=> 'int'),
			'created_at' 	=> array('constraint' 	=> 11, 'type' 	=> 'int', 'null' => true),
			'updated_at' 	=> array('constraint' 	=> 11, 'type' 	=> 'int', 'null' => true),

		), array('id'));

		// Droplet relational table created under drops migration

	}

	public function down()
	{
		\DBUtil::drop_table('droplets');
	}
}
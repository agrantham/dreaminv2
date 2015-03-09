<?php

namespace Fuel\Migrations;

class Add_cloud_to_cloud
{
    public function up()
    {

        // Create relational tables for ORM
        \DBUtil::create_table('clouds_clouds',array(
            'cloudoneid'       => array('constraint'   => 50,'type'    =>'varchar'),
            'cloudtwoid'        => array('constraint'   => 50,'type'    =>'varchar')
        ),array('cloudoneid','cloudtwoid'));


    }

    public function down()
    {
        \DBUtil::drop_table('clouds_clouds');
    }
}
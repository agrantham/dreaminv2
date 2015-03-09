<?php

namespace Fuel\Migrations;

class Add_body_drops_droplets
{
    public function up()
    {
        \DBUtil::add_fields('drops', array(
            'body' => array(
                'type'      => "text",
                'null'      => true,
                'after'     => 'name'
            ),
        ));
        \DBUtil::add_fields('droplets', array(
            'body' => array(
                'type'      => "text",
                'null'      => true,
                'after'     => 'name'
            ),
        ));
    }

    public function down()
    {
        \DBUtil::drop_fields('drops',array("body"));
        \DBUtil::drop_fields('droplets',array("body"));
    }
}
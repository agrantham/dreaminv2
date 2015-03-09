<?php

namespace Fuel\Migrations;

class Add_flags
{
    public function up()
    {
        \DBUtil::add_fields('clouds', array(
            'newcloud' => array(
                'type'      => "int",
                'constraint'=> 2,
                'null'      => true,
                'after'     => 'goal',
                'default'   => 1
            ),
            'inappropriate' => array(
                'type'      => "int",
                'constraint'=> 2,
                'null'      => true,
                'after'     => 'goal',
                'default'   => 0
            ),
            'version' => array(
                'type'      => "int",
                'constraint'=> 4,
                'null'      => true,
                'after'     => 'goal',
                'default'   => null
            ),
            'private' => array(
                'type'      => "int",
                'constraint'=> 2,
                'null'      => true,
                'after'     => 'goal',
                'default'   => 0
            )
        ));
    }

    public function down()
    {
        \DBUtil::drop_fields('clouds',array("newcloud","inappropriate","version","private"));
    }
}
<?php

namespace Fuel\Migrations;

class Add_disqus_url_clouds
{
    public function up()
    {
        \DBUtil::add_fields('clouds', array(
            'comment_url' => array(
                'type'      => "varchar",
                'constraint' => 255,
                'null'      => true,
                'after'     => 'newcloud'
            ),
        ));
    }

    public function down()
    {
        \DBUtil::drop_fields('clouds',array("comment_url"));
    }
}
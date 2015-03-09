<?php

namespace Fuel\Migrations;

class Add_user_to_user
{
    public function up()
    {

        // Create relational tables for ORM
        \DBUtil::create_table('users_users',array(
            'useroneid'       => array('constraint'   => 50,'type'    =>'varchar'),
            'usertwoid'        => array('constraint'   => 50,'type'    =>'varchar')
        ),array('useroneid','usertwoid'));


    }

    public function down()
    {
        \DBUtil::drop_table('users_users');
    }
}
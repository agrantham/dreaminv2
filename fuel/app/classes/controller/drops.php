<?php

class Controller_Drops extends Controller_Rest
{

    public function post_get()
    {
        return $this->response(Model_Drop::find(Input::post('dropid')));
    }

    public function post_getAll()
    {
        return $this->response(Model_Drop::find("all"));
    }

    public function post_add()
    {

        $params = json_decode(file_get_contents('php://input'));


        $drop = Model_Drop::forge(array(
                'name'          => $params->dropObj->name,
                'body'          => $params->dropObj->body,
                'status'        => 0,
                'commenturl'    => 'notusingatthemoment'
            )
        );
        if($drop->save()){
            return $this->response($drop);
        } else {
            return $this->response(false);
        }
    }

    public function post_delete()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop = Model_Drop::find($params->dropid);
        $drop->delete();
        return $this->response(true);
    }

    public function post_update()
    {
        $params = json_decode(file_get_contents('php://input'));
        $dropObj                = $params->dropObj;
        $drop                   = Model_Drop::find($dropObj->id);
        $drop->name             = $dropObj->name;
        $drop->status           = $dropObj->status;
        $drop->body           = $dropObj->body;
        $drop->commenturl       = $dropObj->commenturl;
        $drop->save();
        return $this->response(true);
    }

    public function post_addCloud()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop                   = Model_Drop::find($params->dropid);
        $cloud                  = Model_Cloud::find($params->cloudid);
        $drop->clouds[$cloud['id']] = $cloud;
        $drop->save();
        return $this->response(true);
    }

    public function post_removeCloud()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop                   = Model_Drop::find($params->dropid);
        $cloud                  = Model_Cloud::find($params->cloudid);
        if(!empty($cloud->drops)){
            unset($cloud->drops[$drop['id']]);
            $cloud->save();
        }
        return $this->response(true);
    }

    public function post_addDroplet()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop                   = Model_Drop::find($params->dropid);
        $droplet                = Model_Droplet::find($params->dropletid);
        $drop->droplets[$droplet->id] = $droplet;
        if($drop->save()){
            return $this->response($droplet);
        } else {
            return $this->response(false);
        }
    }

    public function post_removeDroplet()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop                   = Model_Drop::find($params->dropid);
        $droplet                = Model_Droplet::find($params->dropletid);
        if(!empty($droplet->drops)){
            unset($droplet->drops[$drop['id']]);
            $droplet->save();
        }
        return $this->response(true);
    }

}
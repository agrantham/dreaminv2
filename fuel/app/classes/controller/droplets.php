<?php

class Controller_Droplets extends Controller_Rest
{

    public function post_get()
    {
        $params = json_decode(file_get_contents('php://input'));
        return $this->response(
            Model_Droplet::find($params->dropletid)
        );
    }

    public function post_getAll()
    {
        return $this->response(
            Model_Droplet::find("all")
        );
    }

    public function post_add()
    {
        $params = json_decode(file_get_contents('php://input'));
        $dropletObj = $params->dropletObj;
        $droplet = Model_Droplet::forge(array(
               'name' =>$dropletObj->name,
               'body' =>$dropletObj->body,
               'status' => 0
        ));
        if($droplet->save()){
            return $this->response($droplet);
        } else {
            return $this->response(false);
        }
    }

    public function post_delete()
    {
        $params = json_decode(file_get_contents('php://input'));
        $droplet = Model_Droplet::find($params->dropletid);
        $droplet->delete();
        return $this->response(true);
    }

    public function post_update()
    {
        $params = json_decode(file_get_contents('php://input'));
        $dropletObj                 = $params->dropletObj;
        $droplet                    = Model_Droplet::find($dropletObj->id);
        $droplet->name              = $dropletObj->name;
        $droplet->status            = $dropletObj->status;
        $droplet->body            = $dropletObj->body;
        $droplet->save();
        return $this->response(true);
    }

    public function post_addDrop()
    {
        $params = json_decode(file_get_contents('php://input'));
        $droplet                    = Model_Droplet::find($params->dropletid);
        $drop                       = Model_Drop::find($params->dropid);
        $droplet->drops[$drop['id']] = $drop;
        $droplet->save();
        return $this->response(true);
    }

    public function post_removeDrop()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop                       = Model_Drop::find($params->dropid);
        $droplet                    = Model_Droplet::find($params->droplet);
        if(!empty($drop->droplets)){
            unset($drop->droplets[$droplet['id']]);
            $drop->save();
        }
        return $this->response(true);
    }

}
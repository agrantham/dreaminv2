<?php
use \UUID;

class Controller_Clouds extends Controller_Rest
{

    public function post_get()
    {
        $params             = json_decode(file_get_contents('php://input'));
        $returnObj          = new stdClass();
        $cloud              = Model_Cloud::query()->related('tags')->related('drops')->related('drops.droplets')->where('id',$params->cloudid)->get_one();
        // if(!empty($cloud->drops)){
        //     $returnObj->drops = array();
        //     foreach($cloud->drops as $drop){
        //         $returnObj->drops[] = Model_Drop::find($drop['id']);
        //     }
        // }
        // $returnObj->cloud = $cloud;
        return $this->response(
            $cloud
            );
    }

    public function post_getAll()
    {
        return $this->response(Model_Cloud::query()->related('tags')->get());
    }

    public function post_add()
    {
        $params = json_decode(file_get_contents('php://input'));
        $tmp = Auth::get_user_id();
        $user = Model_User::find($tmp[1]);
        $params = $params->cloudObj;
        $identifier = UUID::mint(4);

        $cloud = Model_Cloud::forge(array(
                'title' => $params->title,
                'body'  => $params->body,
                'status'=> 0,
                'goal'  => $params->goal,
                'private' => 0,
                'version' => 0,
                'inappropriate' => 0,
                'newcloud' => 1,
                'comment_url' => Uri::base(false).'#!/profile/'.$identifier->string
            ));
        $user->clouds[] = $cloud;
        $user->save();
        $cloud->save();
        $cloud->comment_url = $cloud->comment_url."/".$cloud->id;
        $cloud->save();
        // $cloud = Model_Cloud::find($cloudid);
        // $cloud->users[$user->id] = $user;
        // $cloud->save();

        return $this->response($cloud);
    }

    public function post_refresh()
    {
        if(!Auth::check()){
            return $this->response(false);
        } else {
            $tmp = Auth::get_user_id();
            $user = Model_User::query()->related('clouds')->related('clouds.tags')->related("clouds.drops")->related("clouds.drops.droplets")->where('id',$tmp[1])->get_one();
            if(empty($user->clouds)){
                return $this->response(false);
            } else {
                return $this->response($user->clouds);
            }
        }
    }

    public function post_newclouds()
    {
        $clouds = Model_Cloud::query()->where('newcloud',1)->get();
        return $this->response($clouds);
    }

    public function post_delete()
    {
        $params = json_decode(file_get_contents('php://input'));
        $cloud = Model_Cloud::find($params->cloudid);
        $cloud->delete();
        return $this->response(true);
    }

    public function post_newVersion()
    {
        $params = json_decode(file_get_contents('php://input'));
        // Get Current Cloud
        // Creat New Cloud
        // Relate new cloud to old cloud, update old cloud version with new cloud id
        // Foreach drop, create new drops
        // Assign new drops to new cloud
        // Foreach droplet, create new droplets
        // Assign new droplets to each new drop
    }

    public function post_update()
    {
        $params = json_decode(file_get_contents('php://input'));
        // Should be given an object with appropriate fields
        $cloudObj       = $params->cloudObj;
        $cloud          = Model_Cloud::find($cloudObj->id);
        $cloud->title   = $cloudObj->title;
        $cloud->body    = $cloudObj->body;
        $cloud->goal    = $cloudObj->goal;
        $cloud->status  = intval($cloudObj->status);
        $cloud->private  = intval($cloudObj->private);
        $cloud->version  = $cloudObj->version;
        $cloud->inappropriate  = intval($cloudObj->inappropriate);
        $cloud->newcloud  = intval($cloudObj->newcloud);
        return $this->response($cloud->save());
    }

    public function post_verifyNumberOfDrops()
    {
         if(Auth::check())
        {
            $return = true;
            $params = json_decode(file_get_contents('php://input'));
            $cloud = Model_Cloud::query()->related('drops')->where('id',$params->cloudid)->get_one();

            if(!empty($cloud->drops)){
                switch (count($cloud->drops)){
                    case 10:
                        $return = false;
                        break;
                }
            } else {
                $return = true;
            }

            return $this->response($return);
        } else {

            return $this->response(false);
        }
    }

    public function post_addDrop()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop           = Model_Drop::find($params->dropid);
        $cloud          = Model_Cloud::find($params->cloudid);
        $cloud->drops[$drop['id']] = $drop;
        $cloud->save();
        return $this->response($drop);
    }

    public function post_removeDrop()
    {
        $params = json_decode(file_get_contents('php://input'));
        $drop           = Model_Drop::find($params->dropid);
        $cloud          = Model_Cloud::find($params->cloudid);
        if(!empty($drop->clouds)){
            unset($drop->clouds[$cloud['id']]);
            $drop->save();
        }
        return $this->response(true);
    }

}
<?php

class Controller_Tags extends Controller_Rest
{


    public function post_getAll()
    {
        return $this->response(Model_Tag::query()->related('clouds')->get());
    }

    public function post_get($tagid)
    {
        return $this->response(Model_Tag::query()->related("clouds")->where('id',$tagid)->get());
    }
    public function post_add()
    {
        $params             = json_decode(file_get_contents('php://input'));
        $tag = Model_Tag::query()->where('name',$params->tagName)->get_one();
        if($tag == null){
            $tag = Model_Tag::forge(array('name'=>$params->tagName));
            $tag->save();
        }
        return $this->response($tag);
    }
    public function get_remove($tagid)
    {
        if(!Auth::check())
        {
            return $this->response(false);
        } else {
            $tag = Model_Tag::find($tagid);
            $tag->delete();
            return $this->response(true);
        }
    }
    public function post_addCloud()
    {
        $params             = json_decode(file_get_contents('php://input'));
        $cloud = Model_Cloud::find($params->cloudid);
        $tag = Model_Tag::find($params->tagid);
        $cloud->tags[$tag->id] = $tag;
        $cloud->save();
        return $this->response(true);
    }
    public function post_removeCloud()
    {
        $params             = json_decode(file_get_contents('php://input'));
        $cloud = Model_Cloud::find($params->cloudid);
        $tag = Model_Tag::find($params->tagid);
        if(!empty($cloud->tags)){
            unset($tag->clouds[$cloud->id]);
            $tag->save();
            return $this->response($tag);
        } else {
            return $this->resonse(false);
        }

    }
}
<?php

class Controller_Messages extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Messages &raquo; Index';
		$this->template->content = View::forge('messages/index', $data);
	}

}

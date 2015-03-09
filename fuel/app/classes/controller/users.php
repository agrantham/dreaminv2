<?php

use \Auth;
use \Input;
use \Stripe;

class Controller_Users extends Controller_Rest
{



    public function post_getAll()
    {
        $users = Model_User::find('all');
        $users = Model_User::query()->related('clouds')->related('clouds.tags')->get();

        foreach($users as $key=>$user){
            if($user->group_id != 3){
                unset($users[$key]);
            } else {
                $metadata = new stdClass();
                if(!isset($user->userimg) || $user->userimg == null || empty($user->userimg) || $user->userimg == 'default'){
                    if(isset($user->gender)){
                        if($user->gender == 'male'){
                            $metadata->userimg = "assets/img/boy.png";
                        } else {
                            $metadata->userimg = "assets/img/girl.png";
                        }
                    } else {
                        $metadata->userimg = "assets/img/boy.png";
                    }
                } else {
                    $metadata->userimg = $user->userimg;
                }
                // need to push all the metadata into an accessible area for angular
                foreach($user->metadata as $metakey=>$field){
                    $metadata->$field['key'] = $field->value;
                }
                $user->metadata  = $metadata;
                if(empty($user->clouds)){
                    $user->clouds[0] = new stdClass();
                    $user->clouds[0]->body = "Currently no dreams, Get Dreamin!";
                    $user->clouds[0]->title = "Dream 1: Needs Dreams";
                    $user->clouds[0]->status = 0;
                    $user->clouds[0]->id = false;
                } else {
                    foreach($user->clouds as $cloud){
                        if($cloud->private == '1' || $cloud->private == 1){
                            unset($users[$key]);
                        }
                    }
                }
                unset($user->password, $user->login_hash);
            }
        }

        return $this->response($users);
    }

    public function post_getUser()
    {
        $params = json_decode(file_get_contents('php://input'));
        $groups = $group = Auth::get_groups();
        if($group[0][1]->id == 5 || $group[0][1]->id == 6){
            $user = Model_User::query()->related('clouds')->related('clouds.tags')->related('clouds.drops')->related("clouds.drops.droplets")->where('id',$params->userid)->get_one();
            $metadata = new stdClass();
            foreach($user->metadata as $key=>$field){
                $metadata->$field['key'] = $field->value;
            }
            $user->metadata  = $metadata;
            return $this->response($user);
        } else {
            return $this->response(false);
        }
    }

    public function post_updategroup()
    {
        $params = json_decode(file_get_contents('php://input'));
        $groups = $group = Auth::get_groups();
        if($group[0][1]->id == 5 || $group[0][1]->id == 6){
            $user = Model_User::find($params->userid);
            $user->group_id = $params->groupid;
            if($user->save()){
                return $this->response(true);
            } else {
                return $this->response(false);
            }
        } else {
            return $this->response(false);
        }
    }

    public function post_getAllAdmin()
    {
        $groups = $group = Auth::get_groups();
        if($group[0][1]->id == 5 || $group[0][1]->id == 6){
            $users = Model_User::find('all');
            $users = Model_User::query()->related('clouds')->get();

            foreach($users as $key=>$user){

                $metadata = new stdClass();
                foreach($user->metadata as $key=>$field){
                    $metadata->$field['key'] = $field->value;
                }
                $user->metadata  = $metadata;

                unset($user->password, $user->login_hash);

            }
            return $this->response($users);
        } else {
            return $this->response(false);
        }

    }

    public function post_checkPlanDreams()
    {
        if(Auth::check())
        {
            $return = true;
            $tmp = Auth::get_user_id();
            $user = Model_User::query()->related('metadata')->related('clouds')->where('id',$tmp[1])->get_one();
            $metadata = new stdClass();
            foreach($user->metadata as $key=>$field){
                $metadata->$field['key'] = $field->value;
            }
            if(isset($metadata->plan)){
                switch ($metadata->plan){
                    default:
                        $return = false;
                        break;
                    case "beta-egg":
                    case "Egg":
                        if(count($user->clouds) >= 1){
                            $return = false;
                        }
                        break;
                    case "beta-fledging":
                    case "Fledgling":
                        if(count($user->clouds) >= 3){
                            $return = false;
                        }
                        break;
                    case "beta-flying-penguin":
                    case "Flying Penguin":
                        if(count($user->clouds) >= 5){
                            $return = false;
                        }
                        break;
                }
            } else {
                    $return = false;
                }
            return $this->response($return);
        } else {
            return $this->response(false);
        }
    }

    public function post_login()
    {
        $params = json_decode(file_get_contents('php://input'));
        if(Auth::check())
        {
            $tmp = Auth::get_user_id();
            $user = Model_User::query()->related('metadata')->related('clouds')->related('clouds.tags')->related('clouds.drops')->related('clouds.drops.droplets')->where('id',$tmp[1])->get_one();
            if($user->group_id === 1){
                return $this->repsonse(false);
            }
        } else {
            if(isset($params->username) && isset($params->password)){
                if($user = Auth::validate_user($params->username,$params->password)){
                    if($user->group_id !== 1){
                        Auth::force_login($user->id);
                        $user = Model_User::query()->related('metadata')->related('clouds')->related('clouds.tags')->related('clouds.drops')->related('clouds.drops.droplets')->where('id',$user->id)->get_one();
                    } else {
                        return $this->response(false);
                    }
                } else {
                    return $this->response(false);
                }
            } else {
                return $this->response(false);
            }
        }
        $metadata = new stdClass();
        foreach($user->metadata as $field){
            $metadata->$field['key'] = $field['value'];
        }
        $user->metadata = $metadata;
        unset($user->login_hash,$user->password);
        $group = Auth::get_groups();
        if($group){
            switch ($group[0][1]->id) {
                case 3:
                    $location = 'profile';
                    break;
                case 4:
                    $location = 'moderator';
                    break;
                case 5:
                    $location = 'admin';
                    break;
                case 6:
                    $location = 'ironman';
                    break;
                case 2:
                case 1:
                default:
                    $location = 'home';
            }
        }
        return $this->response(
            array(
                'user'=>$user,
                'location' => $location
            )
        );

    }



    public function post_logout()
    {
        Auth::dont_remember_me();
        Auth::logout();
        return $this->response(true);
    }

    public function post_update()
    {
        $params = json_decode(file_get_contents('php://input'));
        $customer = $params->userObj;
        $user = Auth::update_user(array(
            'firstname' => $customer->metadata->firstname,
            'lastname'  => $customer->metadata->lastname,
            'email'     => $customer->email,
            'addressone'=> $customer->metadata->addressone,
            'addresstwo'=> $customer->metadata->addresstwo,
            'state'     => $customer->metadata->state,
            'city'      => $customer->metadata->city,
            'zip'       => $customer->metadata->zip
        ));
        if($user){
            return $this->response(true);
        } else {
            return $this->response(false);
        }
    }

    public function post_add()
    {
        $params = json_decode(file_get_contents('php://input'));
        $customer = $params->newCustomer;

        $customer->firstname  = (!isset($customer->firstname)   ? $customer->firstname      : 'default' );
        $customer->lastname   = (!isset($customer->lastname)    ? $customer->lastname       : 'default' );
        $customer->addressone = (!isset($customer->addressone)  ? $customer->addressone     : 'default' );
        $customer->addresstwo = (!isset($customer->addresstwo)  ? $customer->addresstwo     : 'default' );
        $customer->city       = (!isset($customer->city)        ? $customer->city           : 'default' );
        $customer->state      = (!isset($customer->state)       ? $customer->state          : 'default' );
        $customer->zip        = (!isset($customer->zip)         ? $customer->zip            : 'default' );
        $customer->phonenumber= (!isset($customer->phonenumber) ? $customer->phonenumber    : 'default' );
        $customer->gender     = (!isset($customer->gender)      ? $customer->gender         : 'default' );
        $customer->stripe_id  = (!isset($customer->stripe_id)   ? $customer->stripe_id      : 'default' );
        $customer->plan       = (!isset($customer->plan)        ? $customer->plan           : 'default' );

        $userid = Auth::create_user(
                $customer->username,
                $customer->passwordone,
                $customer->email,
                3,
                array(
                    'firstname'             => $customer->firstname,
                    'lastname'              => $customer->lastname,
                    'addressone'            => $customer->addressone,
                    'addresstwo'            => $customer->addresstwo,
                    'city'                  => $customer->city,
                    'state'                 => $customer->state,
                    'zip'                   => $customer->zip,
                    'phonenumber'           => $customer->phonenumber,
                    'gender'                => $customer->gender,
                    'customer_stripe'       => $params->stripe_id,
                    'plan'                  => $customer->plan
                )
            );
        return $this->response($userid);
    }

    public function post_updatecard()
    {
        $result = false;
        $params = json_decode(file_get_contents('php://input'));
        $tmp = Auth::get_user_id();
        $user = Model_User::query()->related('metadata')->where('id',$tmp[1])->get_one();
        $metadata = new stdClass();
        foreach($user->metadata as $field){
            $metadata->$field['key'] = $field['value'];
        }
        $user->metadata = $metadata;

        if(isset($user->metadata->stripe_id)){
            $stripe = new Stripe_Payment();
            try
            {
                $customer = $stripe->get_customer($user->metadata->stripe_id);
                if($customer){
                    $customer->card = $params->token;
                    $customer->save();
                    $result = true;
                }
            }
            catch(Exception $e)
            {
                $result = false;
            }
        }
        return $this->response(array('result'=>$result));
    }

    public function post_delete()
    {
        $result = Auth_User::delete_user(Input::post('username'));
        return $this->response($result);
    }

    public function post_addCloud()
    {
        $params = json_decode(file_get_contents('php://input'));
        $cloud = Model_Cloud::find($params->cloudid);
        $userid = $params->userid;
        $user = Model_User::find($userid);
        if($user){
            $user->clouds[$cloud['id']] = $cloud;
        }
        return $this->response(true);
    }

    public function post_removeCloud()
    {
        $params = json_decode(file_get_contents('php://input'));
        // Get related object
        // from within the object, unset the parent relation by id
        // save object
        $cloud = Model_Cloud::find($params->cloudid);
        if(!empty($cloud->users)){
            $tmp = Auth::get_user_id();
            unset($cloud->users[$tmp[1]]);
            $cloud->save();
        }
        return $this->response(true);
    }

    public function post_updatepassword()
    {
        $params = json_decode(file_get_contents('php://input'));
        if(Auth::change_password($params->creds->oldpassword,$params->creds->newpasswordone)){
            return $this->response(true);
        } else {
            return $this->response(false);
        }
    }

    public function post_resetpassword()
    {
        $result = false;
        $params = json_decode(file_get_contents('php://input'));
        if($user = Model_User::query()->where('username',$params->username)->get_one()){
            if($user->group_id == 3){
                $result = true;
                $message = "Password has been reset, please check your email for new password.";
                // Email settings will need to go here:
                //
                //
                //
            } else {
                $message = "You do not have the right permission settings to reset your password, please contact an administrator.";
            }
            // user exists, move forward to change password
        } else {
            $message = "The username you entered does not exist in our system.";
        }
        return $this->response(array(
            'result' => $result,
            'message' => $message
        ));

    }

    public function action_subscribe()
    {
        $params = json_decode(file_get_contents('php://input'));

        $stripe = new Stripe_Payment();
        try
        {
            $customer = $stripe->new_customer($params->token,$params->email,$params->plan);
            $result = true;
        }
        catch(Exception $e)
        {
            $customer = null;
            $result = false;
        }
        return $this->response(array(
                'customer' => $customer,
                'result' => $result
            ));

    }

    public function action_singlecharge()
    {
        $params = json_decode(file_get_contents('php://input'));
        $stripe = new Stripe_Payment();
        try {
            $charge = $stripe->process($params->token, $params->amount,$params->email);
            $result = true;
        }
        catch(Exception $e){
            $result = false;
            $charge = null;
        }
        return $this->response(array('charge'=>$charge,'result'=>$result));
    }

    public function action_getplans()
    {
        $return = array();
        $stripe = new Stripe_Payment();
        $plans = $stripe->getPlans();

        foreach($plans['data'] as $key=>$plan){
            $tmp = new stdClass();
            $tmp->id = $plan['id'];
            $tmp->amount = $plan['amount'];
            $tmp->name = $plan['name'];
            $return[$key] = $tmp;
        }
        $this->response(array('plans'=>$return));

    }

}
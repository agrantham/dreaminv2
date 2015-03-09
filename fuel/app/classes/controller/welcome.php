<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

use \UUID;

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{

	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		// Notes on current logins
		// ['slambert':'slambert', 'new':'rancher21@', 'moderator':'moderator', 'ironman':'ironman' ]
		//$user = Model_User::query()->related('metadata')->where('username','new')->get_one();
		// $email_data = array('name'=>'Austin');
		// $email = Email::forge();

		// $email->from('steven@getdreamin.com', "Steven Dreamin");
		// $email->to('agrantham@algidious.com', "Austin Grantham");
		// $email->subject("you have successfully signed up!");
		// $email->html_body(\View::forge('email/email-sign-up',$email_data));

		// $email->send();

		// echo "done";
		// exit;

		//$mailchimp = new Mailchimp();
		// $lists = $mailchimp->lists->getList();
		// echo "<pre>";
		// print_r($lists);
		// exit;

		// $campaign = $mailchimp->campaigns->create(
		// 									"regular",
		// 										array(
		// 											'list_id'=>'a18b0f5bd2',
		// 											'subject' => "This is testing email",
		// 											'from_email' => "steven@getdreamin.com",
		// 											'from_name' => "Steven at The dreamcubator",
		// 											'to_name' => 'Ehh we\'ll see!',
		// 											'template_id'=>20789
		// 										),
		// 							array(
		// 								"<h1>Truly just testing right here</h1>",
		// 								array("testing_content"=>"This is really just a test, dont get too excited")
		// 							)
		// 						);
		// echo "<hr>";
		// print_r($campaign);
		// echo "<pre>";
		// $result = $mailchimp->campaigns->send($campaign['id']);

		// print_r($result);
		// // $result = $mailchimp->campaigns->send($lists['data'][1]['id']);
		// // print_r($result);
		// exit;

		// Auth::logout();
		// exit;
		// echo "<pre>";
		// $user = Model_User::find('all');
		// print_r($user);
		// echo "<hr>";
		// foreach($user as $te){
		// 	if(!empty($te->clouds)){
		// 		echo $te->id;
		// 		print_r($te->clouds);

		// 	} else {
		// 		//echo "nope";
		// 	}

		// }
		// exit;
		// print_r($cloud);
		// exit;

		// //$user = Model_User::find('all');
		// print_r($user->id);
		// exit;
		// $cloud[1]->users[$user->id] = $user;
		// $cloud[1]->save();
		// echo "done";
		// exit;
		// $user = Model_Cloud::query()
		// ->related('users')
		// ->where('id',1)
		// ->get_one();
		// echo "<pre>";
		// print_r($user);
		// exit;

		// $cloud = Model_Cloud::find(3);

		// $user->clouds[$cloud['id']] = $cloud;
		// $user->save();
		// echo "done";
		// exit;
		// echo "<pre>";
		// //$cloud = Model_Cloud::find(3);

		// $result = Auth::create_user(
		//     'slambert',
		//     'slambert',
		//     'slambert@algidious.com',
		//     5,
		//     array(
		//         'firstname' => 'Steven',
		//         'lastname' => 'Lambert',
		//         'addressone' => '7103 South Durango',
		//         'addresstwo' => 'Unit 206',
		//         'city' => 'Las Vegas',
		//         'state' => 'Nevada',
		//         'country' => 'USA',
		//         'zip' => '89113',
		//         'planname' => 'Fledging',
		//         'status' => 'active',
		//         'user_group' => 'standard',
		//         'extrafield' => 'extra field',
		//     )
		// );
		// echo 'done';
		// exit;
		//  $user = Model_User::find(2);

		// // $user->clouds[$cloud['id']] = $cloud;
		// // $user->save();
		// // //$cloud->save();
		// // print_r($user);
		// print_r($user);
		// echo "<hr>";
		// print_r($user->clouds);
		// //print_r($user->clouds);
		// echo "done";
		// exit;

		// // $result = Model_User::forge(array(
		// // 	    'username'=>'austin',
		// // 	    'password'=>'rancher22@',
		// // 	    'group'=>1,
		// // 	    'email'=>'agrantham@gmail.com',
		// // 	    'last_login' => time(),
		// // 	    'login_hash'=> 'akdsjfklasjdlkfj',
		// // 	    'profile_fields' =>   serialize(array(
		// // 	        'firstname' => 'Austin',
		// // 	        'lastname' => 'Grantham',
		// // 	        'addressone' => '7103 South Durango',
		// // 	        'addresstwo' => 'Unit 206',
		// // 	        'city' => 'Las Vegas',
		// // 	        'state' => 'Nevada',
		// // 	        'country' => 'USA',
		// // 	        'zip' => '89113',
		// // 	        'planname' => 'Fledging',
		// // 	        'status' => 'active',
		// // 	        'user_group' => 'standard',
		// // 	        'extrafield' => 'extra field',
		// // 	    )),
		// // 	    'created_at' => time(),
		// // 	    'updated_at' => time()
		// //     )
		// // );
		// $user = Model_User::find(2);


		// $cloud->users[$user['id']] = $user;
		// $cloud->save();

		// echo "done";
		// exit;

// 		$cloud = Model_Cloud::forge(array(
// 					'title' => "Fly over the rainbow",
// 					'body' => "the goal is to find both ends of the rainbow, find the pot of gold, murdger the little garden gnome keeping guard, and then be rich",
// 					'status' => 0,
// 					'goal' => time()
// 			));

// 		$user = Auth::validate_user('agrantham','rancher21@');
// echo "<pre>";
// 		print_r($user);
// 		$cloud->users[$user['id']] = $user;

// 		$cloud->save();

// 		echo 'complete';
// 		exit;
		// $cloud = Model_Cloud::find(1);
		// echo "<pre>";
		// print_r($cloud);
		// echo "<hr>";
		// print_r($cloud->drops);


		// echo "complete";
		// exit;

		// echo "<pre>";
		// print_r(unserialize('a:4:{i:0;O:8:"stdClass":5:{s:4:"uuid";s:36:"ff7fe08f-1d9e-47b8-a0da-1ba657a819dd";s:8:"dropName";s:22:"Get together paperwork";s:6:"status";i:0;s:3:"url";s:99:"http://www.getdreamin.algidiousdesign.com/dreamcubator/#!drops/ff7fe08f-1d9e-47b8-a0da-1ba657a819dd";s:8:"droplets";a:1:{i:0;O:8:"stdClass":4:{s:4:"uuid";s:17:"skldjf-sdklfj-sdf";s:4:"name";s:47:"Have a fun time researching what you love to do";s:6:"create";i:23423;s:6:"status";i:0;}}}i:1;O:8:"stdClass":5:{s:4:"uuid";s:36:"f63483a1-e9bf-43fb-80c6-107f87cbe944";s:8:"dropName";s:16:"Prep your future";s:6:"status";i:0;s:3:"url";s:99:"http://www.getdreamin.algidiousdesign.com/dreamcubator/#!drops/f63483a1-e9bf-43fb-80c6-107f87cbe944";s:8:"droplets";a:2:{i:0;O:8:"stdClass":4:{s:4:"uuid";s:17:"skldjf-sdklfj-sdf";s:4:"name";s:54:"Nothing is going to stop you from reaching your dreams";s:6:"create";i:23423;s:6:"status";i:0;}i:1;O:8:"stdClass":4:{s:4:"uuid";s:17:"skldjf-sdklfj-sdf";s:4:"name";s:27:"We may have to go to Africa";s:6:"create";i:23423;s:6:"status";i:0;}}}i:2;O:8:"stdClass":5:{s:4:"uuid";s:36:"28e445fd-de35-4dba-a604-bcbfad7e40c1";s:8:"dropName";s:2:"No";s:6:"status";i:0;s:3:"url";s:99:"http://www.getdreamin.algidiousdesign.com/dreamcubator/#!drops/28e445fd-de35-4dba-a604-bcbfad7e40c1";s:8:"droplets";a:1:{i:0;O:8:"stdClass":4:{s:4:"uuid";s:17:"skldjf-sdklfj-sdf";s:4:"name";s:47:"Have a fun time researching what you love to do";s:6:"create";i:23423;s:6:"status";i:0;}}}i:3;O:8:"stdClass":5:{s:4:"uuid";s:36:"b31cb78e-c5b7-417a-812b-af6d4da86240";s:8:"dropName";s:35:"lets get ready to ruuummmmblleee!!!";s:6:"status";i:0;s:3:"url";s:99:"http://www.getdreamin.algidiousdesign.com/dreamcubator/#!drops/b31cb78e-c5b7-417a-812b-af6d4da86240";s:8:"droplets";a:2:{i:0;O:8:"stdClass":4:{s:4:"uuid";s:17:"skldjf-sdklfj-sdf";s:4:"name";s:54:"Nothing is going to stop you from reaching your dreams";s:6:"create";i:23423;s:6:"status";i:0;}i:1;O:8:"stdClass":4:{s:4:"uuid";s:17:"skldjf-sdklfj-sdf";s:4:"name";s:27:"We may have to go to Africa";s:6:"create";i:23423;s:6:"status";i:0;}}}}'));
		// exit;

		// $result = Auth::create_user(
		//     'personnumber6',
		//     'godgodgod',
		//     'agrantham@personsix.com',
		//     3,
		//     array(
		//         'firstname' => 'Person',
		//         'lastname' => 'Six',
		//         'addressone' => '7103 South Durango',
		//         'addresstwo' => 'Unit 206',
		//         'city' => 'Las Vegas',
		//         'state' => 'Nevada',
		//         'country' => 'USA',
		//         'zip' => '89113',
		//         'planname' => 'Fledging',
		//         'status' => 'active',
		//         'user_group' => 'standard',
		//         'extrafield' => 'extra field',
		//     )
		// );
		// print_r($result);
		// exit;
		return Response::forge(View::forge('welcome/index'));
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(Presenter::forge('welcome/hello'));
	}

	public function action_setfields(){
		var_dump( Auth::update_user( array(
			'gender' => 'female',
			'userimg' => 'default'

			),'bprovo'));

	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}

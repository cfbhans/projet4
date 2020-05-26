<?php
namespace App\Controller\Frontend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;


/**
* Class UserController
*
* Used to recover model classes to send it into the frontoffice users views
*  
*/
class UserController extends Controller
{
	/**
	 * UserController
	 * Used to go to home view
	 */	
	public function home() {
		$this->render('frontend/home', ['']);
	}

	/**
	 * UserController
	 * Used to go to author view
	 */
	public function author() {
		$this->render('frontend/author', ['']);
	}

	/**
	 * UserController
	 * Used to go to contact view
	 */
	public function contact() {
		$this->render('frontend/contact', ['']);
	}

	public function connection() {
		$this->render('frontend/connection', ['']);
	}

	/**
	 * UserController
	 * Used to create a registration
	 */
	public function create() {
		$this->render('frontend/register', ['']);
	}

	/**
	 * UserController
	 * Used to register a registration
	 */
	public function store() {
		$user = new User();

		$data = [
			'email'             => $this->purify($_POST['email']),
			'password'          => $_POST['password'],
			'confirmPassword'   => $_POST['confirmPassword']
		];

		if(!$user->verifyRegister($data)){
			if($user->hasErrors()){
				return $this->render('frontend/register',['']);
			}
		}

		$user->hydrate($user, $data);

		$user->create();

		$this->render('frontend/connection',['']);
	}

	/**
	 * UserController
	 * Used to connect
	 */
	public function connect() {
		$user = new User();

		$email      = $this->purify($_POST['emailConnect']);
		$password   = $_POST['passwordConnect'];

		if(!$user->verifyConnect($email, $password)) {
			if($user->hasErrors()) {
				return $this->render('frontend/connection',['']);
			}
		};

		$data = $user->get($email);

		$user->hydrate($user, $data);

		$user->connect();

		$this->render('backend/administration',['']);
	}

}
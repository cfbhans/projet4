<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;


/**
* Class UserController
*
* Used to recover model classes to send it into the backoffice users views
*  
*/
class UserController extends Controller
{
	/**
     * UserController construct
     * Used to verify connection when visitor is in administration
     */
	public function __construct(){
		if(!isset($_SESSION['connected'])) {
			header('Location: /');
		}
	}

	/**
     * UserController construct
     * Used to manage user administrator
     */
	public function admin() {
		if (isset($_SESSION['connected'])){
			$this->render('backend/administration', ['']);
		}
	}

	/**
     * UserController construct
     * Used to list registered users
     */
	public function list(){
		$users = (new User)->unregister();

		$this->render('backend/userAdmin', [
			'users' => $users
		]);
	}
	
	/**
     * UserController construct
     * Used to logout
     */
	public function logout(){
		if (isset($_SESSION['connected'])) {
			$_SESSION = array();
			session_destroy();
		}
		
		Helper::redirect(" ");
	}

	/**
     * UserController construct
     * Used to give administration rights
     */
	public function setAdmin($id){
		$users = new User();

		$users->switchAdmin($id, true);

		Helper::redirect('users/user');	
	}
	
	/**
     * UserController construct
     * Used to remove administration rights
     */
	public function unsetAdmin($id){
		$users = new User();

		$users->switchAdmin($id, false);

		Helper::redirect('users/user');
	}

	/**
     * ChapterController delete
     * Used to delete an user
     */
	 public function delete($id){
		$user = (new User)->find($id);
		$user->delete($id);
		
		Helper::redirect('users/user');
	}
}
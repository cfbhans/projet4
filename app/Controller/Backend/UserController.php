<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

/**
 * user controller
 */
class UserController extends Controller
{

    /*Gestion des administrateurs*/
	public function admin() {
		if (isset($_SESSION['connected'])){
			$this->render('backend/administration', ['']);
		}
	}

    /*listes des utilisateurs*/
	public function list(){
		$users = (new User)->unregistered();

		$this->render('backend/userAdmin', [
			'users' => $users
		]);
	}
    /* deconnexion */
	public function logout(){
		if (isset($_SESSION['connected'])) {
		   	$_SESSION = array();
    		session_destroy();
    	}
    	
    	Helper::redirect(" ");
    }


    /* administrateur */
    public function setAdmin($id){
    	$users = new User();

    	$users->switchAdmin($id, true);

    	Helper::redirect('users/user');
    	
    }

    /*suppression des accessibilités d'administrateur*/
    public function unsetAdmin($id){
        $users = new User();

        $users->switchAdmin($id, false);

        Helper::redirect('users/user');
    }
}
<?php
namespace App\Controller\Frontend;

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
	
    public function home() {
        $this->render('frontend/home', ['']);
    }

    public function author() {
        $this->render('frontend/author', ['']);
    }

    public function contact() {
        $this->render('frontend/contact', ['']);
    }

    public function connection() {
        $this->render('frontend/connection', ['']);
    }

    public function create() {
        $this->render('frontend/register', ['']);
    }

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

        $user->create($user);

        $this->render('frontend/connection',['']);
    }

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

        $user->connected();


        $this->render('backend/administration',['']);
    }

}
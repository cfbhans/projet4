<?php
namespace App\Controller;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;

class FrontendController extends Controller
{
	public function __construct() {
		
	}

	public function linked($url){
		$helper = (new Helper)->link($url);
	}

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

	public function register() {
		$this->render('frontend/register', ['']);
	}

	public function listChapters() {
		$chapters = (new Chapter)->all();

		$this->render('frontend/listChapters',[
			'chapters' => $chapters,
		]);
	}

	public function chapter($id) {
		
		$chapter = (new Chapter)->find($id);

		$comments = (new Comment)->allComments($id);

		$this->render('frontend/showComments',[
			'chapter' => $chapter,
			'comments' => $comments
		]);
	}


	/**
     * Add a new comment and redirect to the chapter page
     * @param $id
     * @param $author
     * @param $comment
     */
	public function addComment($chapterId)	{
		$comment = new Comment();

		$data = [
			'chapterId'	=> $chapterId,
            'author'	=> $_REQUEST['author'], 
            'comment'	=> $_REQUEST['comment']
        ];

        $comment->hydrate($comment, $data);

        if($comment->hasErrors()) {
        	$this->chapter($chapterId);
        }

        $comment->save($comment);

        Helper::redirect('chapters/' . $chapterId);
	}

	/**
     * report the comment 
     * @param $id
     * @param $comment
     */
	public function reported($id) {
		$reported = (new Comment)->reported($id);

		 Helper::redirect('chapters/' . $_POST['chapterId']);
	}

	public function addUser() {
		$user = new User();

		$data = [
			'email'				=> $this->purify($_POST['email']),
			'password'			=> $_POST['password'],
			'confirmPassword'	=> $_POST['confirmPassword']
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

		$email 		= $this->purify($_POST['emailConnect']);
		$password 	= $this->purify($_POST['passwordConnect']);

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
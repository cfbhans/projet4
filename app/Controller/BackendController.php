<?php
namespace App\Controller;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;

/**
 * 
 */
class BackendController extends Controller
{
	public function __construct() {
		
	}

    /*======================================
                Chapters  
    =======================================*/


    /*======================================
                Comments  
    =======================================*/
    /* Gestion des commentaires signalés9*/
    public function manageComment(){
        $chapter = new Chapter();
        $comments = (new Comment)->allCommentsReported();

        $this->render('backend/manageComment',[
            'chapter' => $chapter,
            'comments' => $comments
        ]);
    }

    /*======================================
                Users  
    =======================================*/
    /*Gestion des administrateurs*/
	public function admin() {
		if (isset($_SESSION['connected'])){
			$this->render('backend/administration', ['']);
		}
	}

    /*listes des utilisateurs*/
	public function userList(){
		$users = (new User)->unregistered();

		$this->render('backend/userAdmin', [
			'users' => $users
		]);
	}

	public function logout(){
		if (isset($_SESSION['connected'])) {
		   	$_SESSION = array();
    		session_destroy();
    	}
    	
    	Helper::redirect(" ");
    }

	public function newChapter(){
		$this->render('backend/writeChapter', ['']);
	}

    public function addChapter() {
    	$chapter = new Chapter();

        if(isset($_POST['addChapter'])) {
        	$data = [
    			'title'		=> $this->purify($_POST['newPostTitle']),
    			'content'	=> $this->purify($_POST['newPostContent'])
        	];

        	$chapter->hydrate($chapter, $data);

        	$chapter->createChapter($chapter);

        	 Helper::redirect('chapters');
        }
    }

    public function modifyChapter($id) {
        $chapter = (new Chapter)->find($id);

        $this->render('backend/modifChapter', [
            'chapter'  => $chapter
        ]);
    }

    public function updateChapter($id){
        $chapter = new Chapter();

        if(isset($_POST['updateChapter'])){
            $data = [
                'title'     => $this->purify($_POST['updateTitle']),
                'content'   => $this->purify($_POST['updateContent'])
            ];


            $chapter->hydrate($chapter, $data);

            $chapter->updated($chapter, $id);

            Helper::redirect('chapters/' . $id);
        }
    }



    public function setAdmin($id){
    	$users = new User();

    	$users->switchAdmin($id, true);

    	Helper::redirect('users/user');
    	
    }

    public function unsetAdmin($id){
        $users = new User();

        $users->switchAdmin($id, false);

        Helper::redirect('users/user');
    }

    public function delete($id){
       $comment = new Comment();

       if(isset($_POST['deleteComment'])){

           $comment->delete($id);
       }
       Helper::redirect('comments/comment');

    }

    public function modifyComment($id){
        $comment = (new Comment)->find($id);
        $chapter = new Chapter();

        $this->render('backend/moderation', [
            'comment'  => $comment,
            'chapter'  => $chapter
        ]);
    }

    public function updateComment($id){
        $comment = new Comment();

            $data = [
                'author'    => $this->purify($_POST['upAuthor']),
                'comment'   => $this->purify($_POST['upComment']),
                'enum'      => 'approved',
                'isReported'=> 0
            ];


            $comment->hydrate($comment, $data);

            $comment->update($comment, $id);

            Helper::redirect('comments/comment');
    }


    public function confirm($id){
       $comment = new Comment();

        $comment->confirm($id);

        Helper::redirect('comments/comment');
    }

}

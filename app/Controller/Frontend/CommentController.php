<?php
namespace App\Controller\Frontend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

/**
* Class CommentController
*
* Used to recover model classes to send it into the frontoffice comments views
*  
*/
class CommentController extends Controller
{
	/**
     * CommentController
     * Used to create new comment
     */	
	public function create($chapterId)  {
		$comment = new Comment();

		$data = [
			'chapterId' => $chapterId,
			'author'    => $this->purify($_POST['author']), 
			'comment'   => $this->purify($_POST['comment'])
		];

		$comment->hydrate($data);

		$comment->save();

		Helper::redirect('chapters/' . $chapterId);
	}

	/**
     * CommentController
     * Used to report comment
     */
	public function report($id) {
		$report = (new Comment)->report($id);

		Helper::redirect('chapters/' . $_POST['chapterId'] . '#comments');
	}

}
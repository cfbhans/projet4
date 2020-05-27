<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;


/**
* Class CommentController
*
* Used to recover model classes to send it into the backoffice comments views
*  
*/
class CommentController extends Controller
{
	/**
     * CommentController construct
     * Used to verify connection when visitor is in administration
     */
	public function __construct(){
		if(!isset($_SESSION['connected'])) {
			header('Location: /');
		}
	}

	/**
     * CommentController construct
     * Used to edit comment
     */
	public function edit($id){
		$comment = (new Comment)->find($id);

		$this->render('backend/moderation', [
			'comment'  => $comment
		]);
	}

	/**
     * CommentController construct
     * Used to update a reported comment
     */
	public function update($id){
		$comment = new Comment();
		$chapterId = $comment->find($id)->getChapterId();

		$data = [
			'author'    => $this->purify($_POST['upAuthor']),
			'comment'   => $this->purify($_POST['upComment']),
			'enum'      => 'approved',
			'isReported'=> 0
		];
		
		$comment->hydrate($data);

		$comment->update($id);

		Helper::redirect('chapters/'. $chapterId);
	}

	/**
     * CommentController construct
     * Used to delete a reported comment
     */	
	public function delete($id){
		$comment = new Comment;
		$chapterId = $comment->find($id)->getChapterId();

		$comment->delete($id);

		Helper::redirect('chapters/'. $chapterId);
	}

	/**
     * CommentController construct
     * Used to confirm a reported comment
     */	
	public function confirm($id){
		$comment = new Comment();
		$chapterId = $comment->find($id)->getChapterId();

		$comment->confirm($id);

		Helper::redirect('chapters/'. $chapterId);
	}
}
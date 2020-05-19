<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

class CommentController extends Controller
{
	public function __construct(){
		if(!isset($_SESSION['connected'])) {
			header('Location: /');
		}
	}

	public function edit($id){
		$comment = (new Comment)->find($id);

		$this->render('backend/moderation', [
			'comment'  => $comment
		]);
	}

	public function update($id){
		$comment = new Comment();
		$chapterId = $comment->find($id)->getChapterId();

		$data = [
			'author'    => $this->purify($_POST['upAuthor']),
			'comment'   => $this->purify($_POST['upComment']),
			'enum'      => 'approved',
			'isReported'=> 0
		];
		
		$comment->hydrate($comment, $data);

		$comment->update($comment, $id);

		Helper::redirect('chapters/'. $chapterId);
	}
	
	public function delete($id){
		$comment = new Comment;
		$chapterId = $comment->find($id)->getChapterId();

		$comment->delete($id);

		Helper::redirect('chapters/'. $chapterId);
	}


	public function confirm($id){
		$comment = new Comment();
		$chapterId = $comment->find($id)->getChapterId();

		$comment->confirm($id);

		Helper::redirect('chapters/'. $chapterId);
	}
}
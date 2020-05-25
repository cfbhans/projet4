<?php
namespace App\Controller\Frontend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

/**
* Class ChapterController
*
* Used to recover model classes to send it into the frontoffice chapters views
*  
*/
class ChapterController extends Controller
{
	/**
     * ChapterController
     * Used to recover chapters
     */	
	public function index() {
		$chapters = (new Chapter)->all();
		
		$this->render('frontend/listChapters',[
			'chapters' => $chapters,
		]);
	}

	/**
     * ChapterController
     * Used to show chapters
     */	
	public function show($id) {
		
		$chapter = (new Chapter)->find($id);

		$comments = (new Comment)->allComments($id);

		$this->render('frontend/showComments',[
			'chapter' => $chapter,
			'comments' => $comments
		]);
	}
}
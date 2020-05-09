<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

/**
 * chapter controller
 */
class ChapterController extends Controller
{

	public function create(){
		$this->render('backend/writeChapter', ['']);
	}

	public function store() {
		$chapter = new Chapter();

			$data = [
				'title'     => $this->purify($_POST['newPostTitle']),
				'content'   => $_POST['newPostContent']
			];

			$chapter->hydrate($chapter, $data);

			$chapter->createChapter($chapter);

			Helper::redirect('chapters');
			 
	}

	public function edit($id) {
		$chapter = (new Chapter)->find($id);

		$this->render('backend/modifChapter', [
			'chapter'  => $chapter
		]);
	}

	public function update($id){
		$chapter = new Chapter();

		
			$data = [
				'title'     => $this->purify($_POST['updateTitle']),
				'content'   => $_POST['updateContent']
			];


			$chapter->hydrate($chapter, $data);

			$chapter->updated($chapter, $id);

			Helper::redirect('chapters/' . $id);
		
	}

	 public function delete($id){
	 	$chapter = (new Chapter)->find($id);
	 	$chapter->delete($id);
        
        Helper::redirect('chapters');
       
      }

	
}
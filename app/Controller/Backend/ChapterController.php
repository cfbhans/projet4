<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

/**
* Class ChapterController
*
* Used to recover model classes to send it into the backoffice chapters views
*  
*/
class ChapterController extends Controller
{
	/**
     * ChapterController construct
     * Used to verify connection when visitor is in administration
     */
	public function __construct(){
		if(!isset($_SESSION['connected'])) {
			header('Location: /');
		}
	}

	/**
     * ChapterController create
     * Used to create a new chapter
     */
	public function create(){
		$this->render('backend/writeChapter', ['']);
	}

	/**
     * ChapterController store
     * Used to store a new chapter
     */
	public function store() {
		$chapter = new Chapter();

		$data = [
			'title'     => $this->purify($_POST['newPostTitle']),
			'content'   => $_POST['newPostContent']
		];

		$chapter->hydrate($chapter, $data);

		$chapter->create();

		Helper::redirect('chapters');		 
	}

	/**
     * ChapterController edit
     * Used to edit a modify chapter
     */
	public function edit($id) {
		$chapter = (new Chapter)->find($id);

		$this->render('backend/modifChapter', [
			'chapter'  => $chapter
		]);
	}

	/**
     * ChapterController update
     * Used to store an updated chapter
     */
	public function update($id){
		$chapter = new Chapter();

		$data = [
			'title'     => $this->purify($_POST['updateTitle']),
			'content'   => $_POST['updateContent']
		];

		$chapter->hydrate($chapter, $data);

		$chapter->update($id);

		Helper::redirect('chapters/' . $id);
	}

	/**
     * ChapterController delete
     * Used to delete a chapter
     */
	 public function delete($id){
		$chapter = (new Chapter)->find($id);
		$chapter->delete($id);
		
		Helper::redirect('chapters');
	}

}
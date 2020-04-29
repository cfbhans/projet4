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

    public function newChapter(){
        $this->render('backend/writeChapter', ['']);
    }

    public function addChapter() {
        $chapter = new Chapter();
        if(isset($_POST['addChapter'])) {

            $data = [
                'title'     => $this->purify($_POST['newPostTitle']),
                'content'   => $_POST['newPostContent']
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
                'content'   => $_POST['updateContent']
            ];


            $chapter->hydrate($chapter, $data);

            $chapter->updated($chapter, $id);

            Helper::redirect('chapters/' . $id);
        }
    }
}
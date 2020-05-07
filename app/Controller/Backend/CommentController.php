<?php
namespace App\Controller\Backend;

use \App\Tools\Helper;
use \App\Model\Chapter;
use \App\Model\Comment;
use \App\Model\User;
use \App\Model\Admin;
use \App\Controller\Controller;

/**
 * Comment controller
 */
class CommentController extends Controller
{
	
    /* Gestion des commentaires signalés*/
    public function index(){
        $chapter = new Chapter();
        $comments = (new Comment)->allCommentsReported();

        $this->render('backend/manageComment',[
            'chapter' => $chapter,
            'comments' => $comments
        ]);
    }

    public function edit($id){
        $comment = (new Comment)->find($id);
        $chapter = new Chapter();

        $this->render('backend/moderation', [
            'comment'  => $comment,
            'chapter'  => $chapter
        ]);
    }

    public function update($id){
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
    
    public function delete($id){
        $comment = (new Comment)->find($id);

        $data [];
        var_dump($_POST['chapterId']);

        //$chapterId = comments->find($id);
        
        die();

        Helper::redirect('chapters/' . $_POST['chapterId']);
    }

    public function confirm($id){
       $comment = new Comment();

        $comment->confirm($id);

        var_dump();
        die();

        Helper::redirect('comments/comment');
    }

 }
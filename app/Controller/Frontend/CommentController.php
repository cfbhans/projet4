<?php
namespace App\Controller\Frontend;

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
	
    public function create($chapterId)  {
        $comment = new Comment();

        $data = [
            'chapterId' => $chapterId,
            'author'    => $this->purify($_POST['author']), 
            'comment'   => $this->purify($_POST['comment'])
        ];

        $comment->hydrate($comment, $data);

        $comment->save($comment);

        Helper::redirect('chapters/' . $chapterId);
    }

    public function report($id) {
        $report = (new Comment)->report($id);

        Helper::redirect('chapters/' . $_POST['chapterId'] . '#comments');
    }

 }
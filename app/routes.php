<?php

/*Home*/
$router->map( 'GET', '/', function() {
  	$controller = new App\Controller\Frontend\UserController();
	$controller->home();
});

/*Author*/
$router->map( 'GET', '/author', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->author();
});

/*Contact*/
$router->map( 'GET', '/contact', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->contact();
});

/*======================================
			Chapters  
=======================================*/
/*List of chapters*/
$router->map( 'GET', '/chapters', function() {
	//die('123');
	$controller = new App\Controller\Frontend\ChapterController();
	$controller->listChapters();
});

/*Chapter by id*/
$router->map( 'GET', '/chapters/[i:id]', function($id) {
	//die('123');
	$controller = new App\Controller\Frontend\ChapterController();
	$controller->chapter($id);
});

/*Add new chapter*/
$router->map( 'POST', '/chapters', function() {
	$controller = new App\Controller\Backend\ChapterController();
	$controller->addChapter();
});

/*map to add chapter page*/
$router->map('GET', '/chapters/create', function() { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->newChapter();
});

/*map to add chapter page*/
$router->map('GET', '/chapters/[i:id]/edit', function($id) { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->modifyChapter($id);
});

/*map to add chapter page*/
$router->map('POST', '/chapters/[i:id]', function($id) { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->updateChapter($id);
});

/*======================================
			Comments  
=======================================*/
/*add new comment*/
$router->map( 'POST', '/comments/create/[i:id]', function($id) {
	$controller = new App\Controller\Frontend\CommentController();
	$controller->addComment($id);
});

/*Reported comment*/
$router->map('GET', '/comments/comment', function() {
	$controller = new App\Controller\Backend\CommentController();
	$controller->manageComment();
});

/*reported comment*/
$router->map( 'POST', '/comments/[i:id]/report', function($id) {/*report*/
	$controller = new App\Controller\Frontend\CommentController();
	$controller->reported($id);
});

/*deleted comment*/
$router->map( 'POST', '/comments/[i:id]/delete', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->delete($id);
});

/*moderated comment*/
$router->map( 'GET', '/comments/[i:id]/edit', function($id) {/*edit*/
	$controller = new App\Controller\Backend\CommentController();
	$controller->modifyComment($id);
});

/*updated comment*/
$router->map('POST', '/comments/[i:id]/moderate', function($id) {/*moderate*/
	$controller = new App\Controller\Backend\CommentController();
	$controller->updateComment($id);
});

/*confirmed comment*/
$router->map( 'POST', '/comments/[i:id]/confirm', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->confirm($id);
});



/*======================================
			Users 
=======================================*/
/*Registration*/
$router->map('GET', '/users/create', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->register();
});

/*Register user*/
$router->map('POST', '/users', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->addUser();
});

/*Connection*/
$router->map('GET', '/users/connection', function() {
	$controller = new App\Controller\Frontend\USerController();
	$controller->connection();
});

/*logout*/
$router->map('GET', '/users/logout', function() {
	$controller = new App\Controller\Backend\UserController();
	$controller->logout();
});

/*path to the administration*/
$router->map('GET', '/users/administration', function() {
	$controller = new App\Controller\Backend\UserController();
	$controller->admin();
});

/*Connection to the administration*/
$router->map('POST', '/users/administration', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->connect();
});

/*List of users*/
$router->map('GET', '/users/user', function() { 
	$controller = new App\Controller\Backend\UserController();
	$controller->userList(); 
});

/*Modify admin users*/
$router->map( 'POST', '/users/[i:id]/set', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->setAdmin($id);
});

$router->map( 'POST', '/users/[i:id]/unset', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->unsetAdmin($id);
});

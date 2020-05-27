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
	$controller = new App\Controller\Frontend\ChapterController();
	$controller->index();
});

/*Chapter by id*/
$router->map( 'GET', '/chapters/[i:id]', function($id) {
	$controller = new App\Controller\Frontend\ChapterController();
	$controller->show($id);
});

/*Add new chapter*/
$router->map( 'POST', '/chapters', function() {
	$controller = new App\Controller\Backend\ChapterController();
	$controller->store();
});

/*map to create chapter page*/
$router->map('GET', '/chapters/create', function() { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->create();
});

/*map to edit chapter page*/
$router->map('GET', '/chapters/[i:id]/edit', function($id) { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->edit($id);
});

/*map to update chapter page*/
$router->map('POST', '/chapters/[i:id]', function($id) { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->update($id);
});

/*map to delete chapter page*/
$router->map( 'POST', '/chapters/[i:id]/delete', function($id) {
	$controller = new App\Controller\Backend\ChapterController();
	$controller->delete($id);
});

/*======================================
			Comments  
=======================================*/
/*add new comment*/
$router->map( 'POST', '/comments/create/[i:id]', function($id) {
	$controller = new App\Controller\Frontend\CommentController();
	$controller->create($id);
});

/*Reported comment*/
$router->map('GET', '/comments/comment', function() {
	$controller = new App\Controller\Backend\CommentController();
	$controller->index();
});

/*to report comment*/
$router->map( 'POST', '/comments/[i:id]/report', function($id) {/*report*/
	$controller = new App\Controller\Frontend\CommentController();
	$controller->report($id);
});

/*deleted comment*/
$router->map( 'POST', '/comments/[i:id]/delete', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->delete($id);
});

/*moderated comment*/
$router->map( 'GET', '/comments/[i:id]/edit', function($id) {/*edit*/
	$controller = new App\Controller\Backend\CommentController();
	$controller->edit($id);
});

/*moderation of comment*/
$router->map('POST', '/comments/[i:id]/moderate', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->update($id);
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
	$controller->create();
});

/*Register user*/
$router->map('POST', '/users', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->store();
});

/*Connection*/
$router->map('GET', '/users/connection', function() {
	$controller = new App\Controller\Frontend\UserController();
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
	$controller->list(); 
});

/*Modify admin users*/
$router->map( 'POST', '/users/[i:id]/set', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->setAdmin($id);
});

/*Modify admin users*/
$router->map( 'POST', '/users/[i:id]/unset', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->unsetAdmin($id);
});

/*map to delete user*/
$router->map( 'POST', '/users/[i:id]/delete', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->delete($id);
});

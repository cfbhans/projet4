<?php
$controller = new App\Controller\FrontendController();


/*Home*/
$router->map( 'GET', '/', function() {
  	$controller = new App\Controller\FrontendController();
	$controller->home();
});

/*Author*/
$router->map( 'GET', '/author', function() {
	$controller = new App\Controller\FrontendController();
	$controller->author();
});

/*Contact*/
$router->map( 'GET', '/contact', function() {
	$controller = new App\Controller\FrontendController();
	$controller->contact();
});

/*======================================
			Chapters  
=======================================*/
/*List of chapters*/
$router->map( 'GET', '/chapters', function() {
	$controller = new App\Controller\FrontendController();
	$controller->listChapters();
});

/*Chapter by id*/
$router->map( 'GET', '/chapters/[i:id]', function($id) {
	//die('123');
	$controller = new App\Controller\FrontendController();
	$controller->chapter($id);
});

/*Add new chapter*/
$router->map( 'POST', '/chapters', function() {
	$controller = new App\Controller\BackendController();
	$controller->addChapter();
});

/*map to add chapter page*/
$router->map('GET', '/chapters/create', function() { 
	$controller = new App\Controller\BackendController();
	$controller->newChapter();
});

/*map to add chapter page*/
$router->map('GET', '/chapters/[i:id]/edit', function($id) { 
	$controller = new App\Controller\BackendController();
	$controller->modifyChapter($id);
});

/*map to add chapter page*/
$router->map('POST', '/chapters/[i:id]', function($id) { 
	$controller = new App\Controller\BackendController();
	$controller->updateChapter($id);
});

/*======================================
			Comments  
=======================================*/
/*add new comment*/
$router->map( 'POST', '/comments/create/[i:id]', function($id) {
	$controller = new App\Controller\FrontendController();
	$controller->addComment($id);
});

/*Reported comment*/
$router->map('GET', '/comments/comment', function() {
	$controller = new App\Controller\BackendController();
	$controller->manageComment();
});

/*reported comment*/
$router->map( 'POST', '/comments/[i:id]/report', function($id) {/*report*/
	$controller = new App\Controller\FrontendController();
	$controller->reported($id);
});

/*deleted comment*/
$router->map( 'POST', '/comments/[i:id]/delete', function($id) {
	$controller = new App\Controller\BackendController();
	$controller->delete($id);
});

/*moderated comment*/
$router->map( 'GET', '/comments/[i:id]/edit', function($id) {/*edit*/
	$controller = new App\Controller\BackendController();
	$controller->modifyComment($id);
});

/*updated comment*/
$router->map('POST', '/comments/[i:id]/moderate', function($id) {/*moderate*/
	$controller = new App\Controller\BackendController();
	$controller->updateComment($id);
});

/*confirmed comment*/
$router->map( 'POST', '/comments/[i:id]/confirm', function($id) {
	$controller = new App\Controller\BackendController();
	$controller->confirm($id);
});



/*======================================
			Users 
=======================================*/
/*Registration*/
$router->map('GET', '/users/create', function() {
	$controller = new App\Controller\FrontendController();
	$controller->register();
});

/*Register user*/
$router->map('POST', '/users', function() {
	$controller = new App\Controller\FrontendController();
	$controller->addUser();
});

/*Connection*/
$router->map('GET', '/users/connection', function() {
	$controller = new App\Controller\FrontendController();
	$controller->connection();
});

/*logout*/
$router->map('GET', '/users/logout', function() {
	$controller = new App\Controller\BackendController();
	$controller->logout();
});

/*path to the administration*/
$router->map('GET', '/users/administration', function() {
	$controller = new App\Controller\BackendController();
	$controller->admin();
});

/*Connection to the administration*/
$router->map('POST', '/users/administration', function() {
	$controller = new App\Controller\FrontendController();
	$controller->connect();
});

/*List of users*/
$router->map('GET', '/users/user', function() { 
	$controller = new App\Controller\BackendController();
	$controller->userList(); 
});

/*Modify admin users*/
$router->map( 'POST', '/users/[i:id]/set', function($id) {
	$controller = new App\Controller\BackendController();
	$controller->setAdmin($id);
});

$router->map( 'POST', '/users/[i:id]/unset', function($id) {
	$controller = new App\Controller\BackendController();
	$controller->unsetAdmin($id);
});

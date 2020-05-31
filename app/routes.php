<?php
<<<<<<< HEAD
=======
$router->get('/posts', function(){ echo 'tous les articles';});
$router->get('/posts/:id', function($id){ echo 'Afficher l\'articles' . $id;});
$router->post('/posts/:id', function($id){ echo 'Afficher post de article' . $id;});

>>>>>>> 9515fa21b0f68464472814abbc0e4ce9420a513b
/*Home*/
$router->get('/', function() {
  	$controller = new App\Controller\Frontend\UserController();
	$controller->home();
});

/*Author*/
$router->get('/author', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->author();
});

/*Contact*/
$router->get('/contact', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->contact();
});

<<<<<<< HEAD
$router->get('chapters', function() {
=======
$router->get('/chapters', function() {
>>>>>>> 9515fa21b0f68464472814abbc0e4ce9420a513b
	$controller = new App\Controller\Frontend\ChapterController();
	$controller->index();

});
/*map to create chapter page*/
$router->get('chapters/create', function() { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->create();
});
<<<<<<< HEAD

=======
>>>>>>> 9515fa21b0f68464472814abbc0e4ce9420a513b
$router->get('chapters/:id', function($id) {
	$controller = new App\Controller\Frontend\ChapterController();
	$controller->show($id);
});

/*Add new chapter*/
$router->post('chapters', function() {
	$controller = new App\Controller\Backend\ChapterController();
	$controller->store();
});

<<<<<<< HEAD
=======
/*map to create chapter page*/
$router->get('/chapters/create', function() { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->create();
});

>>>>>>> 9515fa21b0f68464472814abbc0e4ce9420a513b
/*map to edit chapter page*/
$router->get('chapters/:id/edit', function($id) { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->edit($id);
});

/*map to update chapter page*/
$router->post('chapters/:id', function($id) { 
	$controller = new App\Controller\Backend\ChapterController();
	$controller->update($id);
});

/*map to delete chapter page*/
$router->post('chapters/:id/delete', function($id) {
	$controller = new App\Controller\Backend\ChapterController();
	$controller->delete($id);
});



/*======================================
			Comments  
=======================================*/
/*add new comment*/
$router->post('comments/create/:id', function($id) {
	$controller = new App\Controller\Frontend\CommentController();
	$controller->create($id);
});


/*to report comment*/
$router->post('comments/:id/report', function($id) {/*report*/
	$controller = new App\Controller\Frontend\CommentController();
	$controller->report($id);
});

/*Reported comment*/
$router->get('comments/comment', function() {
	$controller = new App\Controller\Backend\CommentController();
	$controller->index();
});

/*Reported comment*/
$router->get('comments/comment', function() {
	$controller = new App\Controller\Backend\CommentController();
	$controller->index();
});


/*deleted comment*/
$router->post('comments/:id/delete', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->delete($id);
});

/*moderated comment*/
$router->get('comments/:id/edit', function($id) {/*edit*/
	$controller = new App\Controller\Backend\CommentController();
	$controller->edit($id);
});

/*moderation of comment*/
$router->post('comments/:id/moderate', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->update($id);
});

/*confirmed comment*/
$router->post('comments/:id/confirm', function($id) {
	$controller = new App\Controller\Backend\CommentController();
	$controller->confirm($id);
});


/*======================================
			Users 
=======================================*/
/*Registration*/
$router->get('users/create', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->create();
});

/*Register user*/
$router->post('users', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->store();
});

/*Connection*/
$router->get('users/connection', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->connection();
});


/*Connection to the administration*/
$router->post('users/administration', function() {
	$controller = new App\Controller\Frontend\UserController();
	$controller->connect();
});

/*logout*/
$router->get('users/logout', function() {
	$controller = new App\Controller\Backend\UserController();
	$controller->logout();
});

/*path to the administration*/
$router->get('users/administration', function() {
	$controller = new App\Controller\Backend\UserController();
	$controller->admin();
});


/*List of users*/
$router->get('users/user', function() { 
	$controller = new App\Controller\Backend\UserController();
	$controller->list(); 
});

/*Modify admin users*/
$router->post('users/:id/set', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->setAdmin($id);
});

/*Modify admin users*/
$router->post('users/:id/unset', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->unsetAdmin($id);
});

/*map to delete user*/
$router->post('users/:id/delete', function($id) {
	$controller = new App\Controller\Backend\UserController();
	$controller->delete($id);
});


$router->run();
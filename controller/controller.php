<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/Session.php');

function listPosts() {
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/post-list.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/post-view.php');
}

function addComment($comment, $id) {
	$commentManager = new CommentManager();
	$commentManager->pushComment($comment, $id);
}

function loginVerify($name, $pass) {
	$session = new Session();
	$session->login($name, $pass);
}

function logout() {
	$_SESSION = array();
	session_destroy();
	header('Location: index.php');
}

function signaled($idComment, $idPost) {
	$commentManager = new CommentManager();
	$commentManager->signaledComment($idComment, $idPost);
}

?>
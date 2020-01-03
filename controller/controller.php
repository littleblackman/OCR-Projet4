<?php
// Chargement des classes
require_once('model/Manager.php');
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/Session.php');

function listPosts() {
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    if ($req === false) {
    	throw new Exception('Erreur : Impossible de récupérer la liste des posts !');
    } else {
    	require('view/post-list.php');
    }
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    if ($post === false) {
    	throw new Exception('Erreur : L\'identifiant de post n\'existe pas !');
    } else {
    	require('view/post-view.php');
    }
}

function addPost($title, $text) {
	$postManager = new PostManager();
	$newPost = $postManager->pushPost($title, $text);
}

function deletePost($id) {
	$postManager = new PostManager();
	$deletePost = $postManager->deletePost($id);
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

function goToAdmin() {
	$postManager = new PostManager();
	$commentManager = new CommentManager();

	$posts = $postManager->getPosts();
    $comments = $commentManager->getSignaledComments();

	require('view/admin.php');
}

?>
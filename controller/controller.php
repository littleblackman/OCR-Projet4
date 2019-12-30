<?php
// Chargement des classes
require_once('./model/PostManager.php');
// require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('./view/post-list.php');
}

function post() {
    $postManager = new PostManager();
    //$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    //$comments = $commentManager->getComments($_GET['id']);

    require('./view/post-view.php');
}
?>
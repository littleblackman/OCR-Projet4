<?php
	// Chargement des classes
	require_once('model/Manager.php');
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');
	require_once('model/Session.php');

	function listPosts() {
	    $postManager = new PostManager(); // Création d'un objet
	    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

	    if ($posts === false) {
	    	throw new Exception('Erreur SQL: Impossible de récupérer la liste des posts !');
	    } else {
	    	require('view/post-list.php');
	    }
	}

	function post() {
	    $postManager = new PostManager();
	    $commentManager = new CommentManager();

	    $post = $postManager->getPost($_GET['id']);
	    $comments = $commentManager->getComments($_GET['id']);

	    if (($post === false) || ($comments === false)) {
	    	throw new Exception('Erreur SQL: L\'identifiant de post n\'existe pas !');
	    } else {
	    	require('view/post-view.php');
	    }
	}

	function addPost($title, $text) {
		$postManager = new PostManager();
		$newPost = $postManager->pushPost($title, $text);

		if ($newPost === false) {
	    	throw new Exception('Erreur SQL: Impossible d\'ajouter le post !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}

	function deletePost($id) {
		$postManager = new PostManager();
		$deletePost = $postManager->deletePost($id);

		if ($deletePost === false) {
	    	throw new Exception('Erreur SQL: Impossible de supprimer le post !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}

	function addComment($comment, $id) {
		$commentManager = new CommentManager();
		$commentManager->pushComment($comment, $id);

		if ($commentManager === false) {
	    	throw new Exception('Erreur SQL: Impossible d\'ajouter le commentaire !');
	    } else {
	    	header('Location: index.php?action=view&id=' . $id . '');
	    }
	}

	function loginVerify($name, $pass) {
		$session = new Session();
		$session->login($name, $pass);

		if ($session === false) {
	    	throw new Exception('Erreur SQL: Impossible d\'accéder à vos données !');
	    } else {
			header('Location: index.php');
		}
	}

	function logout() {
		$_SESSION = array();
		session_destroy();
		header('Location: index.php');
	}

	function signaled($idComment, $idPost) {
		$commentManager = new CommentManager();
		$commentManager->signaledComment($idComment, $idPost);

		if ($commentManager === false) {
	    	throw new Exception('Erreur SQL: Impossible de signaler le commentaire !');
	    } else {
	    	header('Location: index.php?action=view&id=' . $idPost . '');
	    }

	}

	function goToAdmin() {
		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$posts = $postManager->getPosts();
	    $comments = $commentManager->getSignaledComments();

	    if (($posts === false) || ($comments === false)) {
	    	throw new Exception('Erreur SQL: L\'identifiant de post n\'existe pas !');
	    } else {
	    	require('view/admin.php');
	    }
	}
?>
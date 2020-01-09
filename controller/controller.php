<?php
	// Chargement des classes
	require_once('model/Manager.php');
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');
	require_once('model/Session.php');

	// DEMANDE CONFIRMATION
	function confirm($id) {
		$id_post = $id;
		require('view/confirm-view.php');
	}

	// LISTE DES POSTES
	function listPosts() {
	    $postManager = new VeyratAntoine\MyBlog\Model\PostManager();
	    $posts = $postManager->getPosts();
	    if ($posts === false) {
	    	throw new Exception('Erreur SQL: Impossible de récupérer la liste des posts !');
	    } else {
	    	require('view/post-list.php');
	    }
	}

	// LECTURE D'UN POST
	function post() {
	    $postManager = new \VeyratAntoine\MyBlog\Model\PostManager();
	    $commentManager = new \VeyratAntoine\MyBlog\Model\CommentManager();
	    $post = $postManager->getPost($_GET['id']);
	    $comments = $commentManager->getComments($_GET['id']);
	    if (($post === false) || ($comments === false)) {
	    	throw new Exception('Erreur SQL: L\'identifiant de post n\'existe pas !');
	    } else {
	    	require('view/post-view.php');
	    }
	}

	// CONNEXION
	function loginVerify($name, $pass) {
		$session = new \VeyratAntoine\MyBlog\Model\Session();
		$result = $session->login($name, $pass);
		if ($result === false) {
	    	throw new Exception('Erreur SQL: Impossible d\'accéder à vos données !');
	    } else {
		    $rId = $result['id'];
		    $rName = $result['name'];
		    $rPass = $result['password'];
		    $rStatus = $result['moderator'];
		    // Comparaison du mot de passe
			$isPasswordCorrect = password_verify($pass, $rPass);
			// Vérification du name
			if ($name != $rName) {
				throw new \Exception('Erreur : Identifiant non reconnu !');
			// Vérification du password
			} else {
				if ($isPasswordCorrect) {
					session_start();
					$_SESSION['id'] = $rId;
					$_SESSION['name'] = $rName;
					$_SESSION['status'] = $rStatus;
					header('Location: index.php');
				}else {
					throw new \Exception('Erreur : Mot de passe erroné !');
				}
			}
		}
	}


	// INSCRIPTION
	function subscribeVerify($name, $pass) {
		$session = new \VeyratAntoine\MyBlog\Model\Session();
		$result = $session->subscribe($name, $pass);
		if ($result != 0) {
			throw new \Exception('Erreur : Cet identifiant est déjà pris, veuillez en choisir un nouveau !');
		} else {
			$insert = $session->subscribeInsert($name, $pass);
			if ($insert === false) {
				throw new Exception('Erreur SQL: Impossible d\'enregistrer vos données !');
			} else {
				header('Location: index.php');
			}
		}
	}

	// DECONNEXION
	function logout() {
		$_SESSION = array();
		session_destroy();
		header('Location: index.php');
	}

	// AJOUT D'UN COMMENTAIRE
	function addComment($comment, $id) {
		$commentManager = new \VeyratAntoine\MyBlog\Model\CommentManager();
		$commentManager->pushComment($comment, $id);
		if ($commentManager === false) {
	    	throw new Exception('Erreur SQL: Impossible d\'ajouter le commentaire !');
	    } else {
	    	header('Location: index.php?action=view&id=' . $id . '');
	    }
	}
	
	// SIGNALEMENT
	function signaled($idComment, $idPost) {
		$commentManager = new \VeyratAntoine\MyBlog\Model\CommentManager();
		$commentManager->signaledComment($idComment, $idPost);
		if ($commentManager === false) {
	    	throw new Exception('Erreur SQL: Impossible de signaler le commentaire !');
	    } else {
	    	header('Location: index.php?action=view&id=' . $idPost . '');
	    }
	}

	// OUVERTURE ZONE ADMIN
	function goToAdmin() {
		$postManager = new \VeyratAntoine\MyBlog\Model\PostManager();
		$commentManager = new \VeyratAntoine\MyBlog\Model\CommentManager();
		$posts = $postManager->getPosts();
	    $comments = $commentManager->getSignaledComments();
	    if (($posts === false) || ($comments === false)) {
	    	throw new Exception('Erreur SQL: L\'identifiant de post n\'existe pas !');
	    } else {
	    	require('view/admin.php');
	    }
	}

	// AJOUT D'UN POST
	function addPost($title, $text) {
		$postManager = new \VeyratAntoine\MyBlog\Model\PostManager();
		$newPost = $postManager->pushPost($title, $text);
		if ($newPost === false) {
	    	throw new Exception('Erreur SQL: Impossible d\'ajouter le post !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}

	// OUVERTURE EDITEUR DE POST
	function openEditForm($id) {
		$postManager = new \VeyratAntoine\MyBlog\Model\PostManager();
		$post = $postManager->getPost($_GET['id']);
		if ($post === false) {
	    	throw new Exception('Erreur SQL: L\'identifiant de post n\'existe pas !');
	    } else {
			require('view/edit-view.php');
	    }
	}

	// EDIT UN POST
	function editPost($title, $text, $id) {
		$postManager = new \VeyratAntoine\MyBlog\Model\PostManager();
		$editPost = $postManager->editPost($title, $text, $id);
		if ($editPost === false) {
	    	throw new Exception('Erreur SQL: Impossible de modifier le post !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}

	// SUPPRESSION D'UN POST
	function deletePost($id) {
		$postManager = new \VeyratAntoine\MyBlog\Model\PostManager();
		$deletePost = $postManager->deletePost($id);
		if ($deletePost === false) {
	    	throw new Exception('Erreur SQL: Impossible de supprimer le post !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}

		// SUPPRESION D'UN COMMENTAIRE
	function deleteComment($id) {
		$commentManager = new \VeyratAntoine\MyBlog\Model\CommentManager();
		$delete = $commentManager->deleteComment($id);
		if ($delete === false) {
	    	throw new Exception('Erreur SQL: Impossible de supprimer le commentaire !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}

	// RESET D'UN COMMENTAIRE
	function resetComment($id) {
		$commentManager = new \VeyratAntoine\MyBlog\Model\CommentManager();
		$reset = $commentManager->resetComment($id);
		if ($reset === false) {
	    	throw new Exception('Erreur SQL: Impossible de reset le commentaire !');
	    } else {
	    	header('Location: index.php?action=admin');
	    }
	}
?>
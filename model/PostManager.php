<?php
namespace VeyratAntoine\MyBlog\Model;

class PostManager extends Manager {
	// Liste des posts
    public function getPosts() {
		$bdd = $this->dbConnect();
		$req = $bdd->query('SELECT * FROM post');

		return $req;
	}

	// Selection d'un post
	public function getPost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT * FROM post WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
	}

	// Ajout d'un post
	public function pushPost($title, $text) {
		$bdd = $this->dbConnect();
		$req_insert_post= $bdd->prepare('INSERT INTO post(title, text) VALUES (:title, :text)');
		$req_insert_post->execute(array(
			'title' => $title,
			'text' => $text
		));

		return $req_insert_post;
	}

	// Edit d'un post
	public function editPost($title, $text, $id) {
		$bdd = $this->dbConnect();
		$req_edit_post= $bdd->prepare('UPDATE post SET title= :title, text= :postText WHERE id= :idPost');
		$req_edit_post->execute(array(
			'title' => $title,
			'postText' => $text,
			'idPost' => $id
		));

		return $req_edit_post;
	}

	// Suppression d'un post
	public function deletePost($id) {
		$bdd = $this->dbConnect();
		$delete = $bdd->prepare('DELETE FROM post WHERE id = ?');
		$delete->execute(array($id));

		return $delete;
	}

}
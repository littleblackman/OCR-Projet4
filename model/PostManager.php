<?php
class PostManager extends Manager {
	// RECUPERER LA LISTE DES POSTS
    public function getPosts() {
		$bdd = $this->dbConnect();
		$req = $bdd->query('SELECT * FROM post');

		return $req;
	}

	// RECUPERER UN POST
	public function getPost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT * FROM post WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
	}

	// AJOUTER UN POST
	public function pushPost($title, $text) {
		$bdd = $this->dbConnect();
		$req_insert_post= $bdd->prepare('INSERT INTO post(title, text) VALUES (:title, :text)');
		$req_insert_post->execute(array(
			'title' => $title,
			'text' => $text
		));

		return $req_insert_post;
	}

	// SUPPRIMER UN POST
	public function deletePost($id) {
		$bdd = $this->dbConnect();
		$delete = $bdd->prepare('DELETE FROM post WHERE id = ?');
		$delete->execute(array($id));

		return $delete;
	}

}
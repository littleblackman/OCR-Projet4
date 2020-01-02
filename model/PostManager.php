<?php
class PostManager {
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

		header('Location: index.php?admin');
	}

	// SUPPRIMER UN POST
	public function deletePost($id) {
		$bdd = $this->dbConnect();
		$delete = $bdd->prepare('DELETE FROM post WHERE id = ?');
		$delete->execute(array($id));

		header('Location: index.php?admin');
	}

	// CONNEXION A LA BDD
	private function dbConnect() {
		$bdd = new PDO('mysql:host=localhost; dbname=myblog; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		    return $bdd;
    }
}
<?php
class PostManager {
    public function getPosts() {
		$bdd = $this->dbConnect();
		$req = $bdd->query('SELECT * FROM post');

		return $req;
	}

	public function getPost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT * FROM post WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
	}

	private function dbConnect() {
		$bdd = new PDO('mysql:host=localhost; dbname=myblog; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		    return $bdd;
    }
}
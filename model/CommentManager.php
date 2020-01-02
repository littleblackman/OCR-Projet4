<?php
class CommentManager {
    // RECUPERER LA LISTE DES COMMENTAIRES LIES AU POST
	public function getComments($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('
        	SELECT c.text text_com, c.id id_com, m.name name_com
        	FROM comments c
        	INNER JOIN members m
        	ON c.id_member = m.id
        	WHERE id_post = ? AND signaled = 0
        ');
        $req->execute(array($postId));

        return $req;
	}

    // OBTENIR LA LISTES DES COMMENTAIRES SIGNALES
    public function getSignaledComments() {
        $bdd = $this->dbConnect();
        $req = $bdd->query('
            SELECT c.text text_com, c.id id_com, m.name name_com
            FROM comments c
            INNER JOIN members m
            ON c.id_member = m.id
            WHERE  signaled = 0');

        return $req;
    }

    // AJOUTER UN COMMENTAIRE
    public function pushComment($comment, $id) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO comments (text, id_member, id_post) VALUES (:comment, :idm, :idp)');
		$req->execute(array(
			'comment' => $comment,
			'idm' => $_SESSION['id'],
			'idp' => $id
		));
		header('Location: index.php?action=view&id=' . $id . '');
	}

    // EFFECTUER UN SIGNALEMENT
	public function signaledComment($idComment, $idPost) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('
        	UPDATE comments 
        	SET signaled = true 
        	WHERE id = ?
        ');
		$req->execute(array($idComment));
		header('Location: index.php?action=view&id=' . $idPost . '');
	}

    // CONNEXION A LA BDD
	private function dbConnect() {
		$bdd = new PDO('mysql:host=localhost; dbname=myblog; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		    return $bdd;
    }

}
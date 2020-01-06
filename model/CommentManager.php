<?php
namespace VeyratAntoine\MyBlog\Model;

class CommentManager extends Manager {
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
            WHERE  signaled = 1');

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
		
        return $req;
	}

        // SUPPRIMER UN COMMENTAIRE
    public function deleteComment($id) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));
        
        return $req;
    }

        // RESET UN COMMENTAIRE
    public function resetComment($id) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE comments SET signaled= :signal WHERE id= :id');
        $req->execute(array(
            'signal' => 0, 
            'id' => $id
        ));
        
        return $req;
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
		
        return $req;
	}

}
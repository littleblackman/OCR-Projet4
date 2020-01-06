<?php
namespace VeyratAntoine\MyBlog\Model;

class CommentManager extends Manager {
    // Liste des commentaires
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

    // Liste des commentaires signalés
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

    // Ajout d'un commentaire
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

        // Suppression d'un commentaire
    public function deleteComment($id) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));
        
        return $req;
    }

        // Reset d'un commentaire
    public function resetComment($id) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE comments SET signaled= :signal WHERE id= :id');
        $req->execute(array(
            'signal' => 0, 
            'id' => $id
        ));
        
        return $req;
    }

    // Effectuer un signalement de commentaire
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
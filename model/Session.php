<?php
namespace VeyratAntoine\MyBlog\Model;

class Session extends Manager {

	// Connexion
    public function login($name, $pass) {
		$bdd = $this->dbConnect();
		$req = $bdd->prepare('SELECT * FROM members WHERE name = :name');
		$req->execute(array('name' => $name));
		$resultat = $req->fetch();

		return $resultat;	
	}

	// Inscription
	public function subscribe($name, $pass) {
		$bdd = $this->dbConnect();
		$verify = $bdd->prepare('SELECT COUNT(id) FROM members WHERE name = :name');
        $verify->execute(array('name' => $name)); 
        $result = $verify->fetchColumn();

        return $result;
	}
		// Inscription
	public function subscribeInsert($name, $pass) {
		$bdd = $this->dbConnect();
		// Hachage
		$pass_hache = password_hash($pass, PASSWORD_DEFAULT);
		// Insertion
		$req = $bdd->prepare('INSERT INTO members(name, password) VALUES(:name, :pass)');
		$req->execute(array(
			'name' => $_POST['subscribe_name'],
			'pass' => $pass_hache));
			
		return $req;
	}
}
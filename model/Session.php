<?php
namespace VeyratAntoine\MyBlog\Model;

class Session extends Manager {

	// Connexion
    public function login($name, $pass) {
		$bdd = $this->dbConnect();
		$req = $bdd->prepare('SELECT * FROM members WHERE name = :name');
		$req->execute(array('name' => $name));
		$resultat = $req->fetch();
		// Comparaison du mot de passe
		$isPasswordCorrect = password_verify($pass, $resultat['password']);
		// Vérification du name
		if ($name != $resultat['name']) {
			throw new \Exception('Erreur : Identifiant non reconnu !');
		// Vérification du password
		} else {
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['name'] = $resultat['name'];
				$_SESSION['status'] = $resultat['moderator'];
					
				return $resultat;
			}else {
				throw new \Exception('Erreur : Mot de passe erroné !');
			}
		}
	}

	// Inscription
	public function subscribe($name, $pass) {
		$bdd = $this->dbConnect();
		$verify = $bdd->prepare('SELECT COUNT(id) FROM members WHERE name = :name');
        $verify->execute(array('name' => $name));
        $result = $verify->fetchColumn();
        if ($result == false) {
			// Hachage
			$pass_hache = password_hash($pass, PASSWORD_DEFAULT);
			// Insertion
			$req = $bdd->prepare('INSERT INTO members(name, password) VALUES(:name, :pass)');
			$req->execute(array(
			    'name' => $_POST['subscribe_name'],
			    'pass' => $pass_hache));
			
			return $req;
		} else {
			throw new \Exception('Erreur : Cet identifiant est déjà pris, veuillez en choisir un nouveau !');
		}
	}
}
<?php
namespace VeyratAntoine\MyBlog\Model;

class Session extends Manager {

	// EFFECTUER UNE CONNEXION
    public function login($name, $pass) {
		$bdd = $this->dbConnect();
		$req = $bdd->prepare('SELECT * FROM members WHERE name = :name');
		$req->execute(array('name' => $name));
		$resultat = $req->fetch();

	// Comparaison du mot de passe
		$isPasswordCorrect = password_verify($pass, $resultat['password']);
		if (!$resultat) {
			throw new Exception('Erreur : Mauvais identifiant et/ou mot de passe !');
		} else {
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['name'] = $resultat['name'];
				$_SESSION['status'] = $resultat['moderator'];
				
				return $resultat;
			}else {
				throw new Exception('Erreur : Mot de passe erroné !');
			}
		}

	}

	public function subscribe($name, $pass) {
		$bdd = $this->dbConnect();

		// Hachage du mot de passe
		$pass_hache = password_hash($pass, PASSWORD_DEFAULT);

		// Insertion
		$req = $bdd->prepare('INSERT INTO members(name, password) VALUES(:name, :pass)');
		$req->execute(array(
		    'name' => $_POST['subscribe_name'],
		    'pass' => $pass_hache));
		return $req;
	}
}
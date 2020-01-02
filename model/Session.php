<?php
class Session {

	// EFFECTUER UNE CONNEXION
    public function login($name, $pass) {
		$bdd = $this->dbConnect();
		$req = $bdd->prepare('SELECT * FROM members WHERE name = :name');
		$req->execute(array('name' => $name));
		$resultat = $req->fetch();

		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($pass, $resultat['password']);

		if (!$resultat) {
		    echo 'Mauvais identifiant ou mot de passe !';
		    echo '<a href="index.php"> Retourner à l\'accueil</a>';
		} else {
		    if ($isPasswordCorrect) {
		        session_start();
		        $_SESSION['id'] = $resultat['id'];
		        $_SESSION['name'] = $resultat['name'];
		        $_SESSION['status'] = $resultat['moderator'];
		        header('Location: index.php');
		    }else {
		        echo 'Mauvais identifiant ou mot de passe !';
		        echo '<a href="index.php"> Retourner à l\'accueil</a>';
		    }
		}
	}

	private function dbConnect() {
		$bdd = new PDO('mysql:host=localhost; dbname=myblog; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $bdd;
	}
}
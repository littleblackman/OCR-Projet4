<?php
namespace VeyratAntoine\MyBlog\Model;

class Manager {
    // Connexion à la BDD
	protected function dbConnect() {
		$bdd = new \PDO('mysql:host=localhost; dbname=myblog; charset=utf8', 'root', '');
		
		return $bdd;
    }
}
<header class="row vertical-align">
	<div class="title col-lg-8">
		<h1><a href="index.php" style="text-decoration:none; color:white;">Billet simple pour l'Alaska</a></h1>
	</div>
	<div class="menu col-lg-4">
		<?php 
			if(isset($_SESSION['id'])) {
				if ($_SESSION['status'] == true) {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p>
					<a href="index.php" class="white" style="text-decoration:none;"><i class="fas fa-home"></i>Home</a>
					<a href="index.php?action=admin" class="white" style="text-decoration:none;">Administration</a>
					<a href="index.php?action=logout" class="white" style="text-decoration:none;">Déconnexion</a>';
				} else {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p>
					<a href="index.php" class="white" style="text-decoration:none;"><i class="fas fa-home"></i>Home</a>
					<a href="index.php?action=logout" class="white" style="text-decoration:none;">Déconnexion</a>';
				}
			} else {
				echo 
					'<a href="index.php" class="white" style="text-decoration:none;"><i class="fas fa-home"></i>Home</a>
					<a href="index.php?action=subscribe" class="white" style="text-decoration:none;">Inscription</a>
					<a href="index.php?action=login" class="white" style="text-decoration:none;">Connexion</a>';
			}
		?>
	</div>
</header>


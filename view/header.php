<header class="row vertical-align">
	<div class="title col-lg-8">
		<h1>Billet simple pour l'Alaska</h1>
	</div>
	<div class="menu col-lg-4">
		<?php 
			if(isset($_SESSION['id'])) {
				if ($_SESSION['status'] == true) {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p>
					<form method="POST" action="index.php"><label class="white"><input type="submit" style="display: none"/><i class="fas fa-home"></i>Home</label></form>
					<a href="index.php?action=admin" class="white">Administration</a>
					<a href="index.php?action=logout" class="white">Déconnexion</a>';
				} else {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p>
					<form method="POST" action="index.php"><label class="white"><input type="submit" style="display: none"/><i class="fas fa-home"></i>Home</label></form>
					<a href="index.php?action=logout" class="white">Déconnexion</a>';
				}
			} else {
				echo 
					'<form method="POST" action="index.php"><label class="white"><input type="submit" style="display: none"/><i class="fas fa-home"></i>Home</label></form>
					<form method="POST" action="index.php?subscribe&load"><label class="white"><input type="submit" style="display: none"/>Inscription</label></form>
					<a href="index.php?action=login" class="white">Connexion</a>';
			}
		?>
	</div>
</header>


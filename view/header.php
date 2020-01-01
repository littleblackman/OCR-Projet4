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
					<form method="POST" action="index.php?admin"><label class="white"><input type="submit" style="display: none"/>Administration</label></form>
					<form method="POST" action="index.php?logout"><label class="white"><input type="submit" style="display: none"/>Déconnexion</label></form>';
				} else {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p>
					<form method="POST" action="index.php"><label class="white"><input type="submit" style="display: none"/><i class="fas fa-home"></i>Home</label></form>
					<form method="POST" action="index.php?logout"><label class="white"><input type="submit" style="display: none"/>Déconnexion</label></form>';
				}
			} else {
				echo 
					'<form method="POST" action="index.php"><label class="white"><input type="submit" style="display: none"/><i class="fas fa-home"></i>Home</label></form>
					<form method="POST" action="index.php?subscribe&load"><label class="white"><input type="submit" style="display: none"/>Inscription</label></form>
					<form method="POST" action="index.php?login"><label class="white"><input type="submit" style="display: none"/>Connexion</label></form>';
			}
		?>
	</div>
</header>


<header class="row vertical-align">
	<div class="title col-lg-8">
		<h1>Billet simple pour l'Alaska</h1>
	</div>
	<div class="menu col-lg-4">
		<?php 
			session_start();
			if(isset($_SESSION['id'])) {
				if ($_SESSION['status'] == true) {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p>
					<a href="/index.php" class="lien-menu" style="text-decoration: none; color:white"><i class="fas fa-home"></i> Home </a> <a href="/admin/admin.php" class="lien-menu" style="text-decoration: none; color:white">Administration</a> <a href="/member/logout_script.php" class="lien-menu" style="text-decoration: none; color:white">Déconnexion</a>';
				} else {
					echo '<p>Bienvenue, ' . $_SESSION['name'] . ' !</p><a href="/index.php" class="lien-menu" style="text-decoration: none; color:white"><i class="fas fa-home"></i> Home </a> <a href="/member/logout_script.php" class="lien-menu" style="text-decoration: none; color:white">Déconnexion</a>';
				}
			} else {
				echo 
					'<a href="/index.php" class="lien-menu" style="text-decoration: none; color:white"><i class="fas fa-home"></i> Home </a> 
					<a href="/subscribe.php" class="lien-menu" style="text-decoration: none; color:white">Inscription</a> <a href="/login.php" class="lien-menu" style="text-decoration: none; color:white">Connexion</a>';
			}
		?>
	</div>
</header>


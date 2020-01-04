<?php 
	ob_start(); 
?>

<center><h3>CONNEXION</h3></center>
	<section id="login" class="row justify-content-md-center">
		<div class="login">
			<form action="index.php?action=login&amp;verify" method="post" class="login">
				<div class="login">
					<label for="login_name">Pseudo</label>
					<input type="text" name="login_name" id="login_name" required>
				</div>
				<div class="login">
					<label for="login_pass">Password</label>
					<input type="password" name="login_pass" id="login_pass" required>
				</div>
				<div class="login">
					<input type="submit" value="Se connecter">
				</div>
			</form>
		</div>
	</section>
<hr>

<?php 
	$content = ob_get_clean();
	require('template.php'); 
?>
<?php ob_start(); ?>

<section id="post-content" class="row justify-content-md-center">
			<?php
				$title = $post['title'];
				$text = $post['text'];
				echo '<h6>';
				echo $title;
				echo '</h6><p>';
				echo $text;
				echo '</p>';
			?>
</section>
<hr>
<section id="comment-content" class="container">
	<div class="comment-title row justify-content-md-center">
		<h6>Commentaires</h6>
	</div>
	<!-- Espace commentaire -->
	<div class="comment-zone row justify-content-md-center">
		<form action="" method="post" class="form-coment">
			<div class="form-comment">
				<label for="comment">Ajouter un commentaire : </label><br>
				<textarea name="comentaire" id="comment" required></textarea>
			</div>
			<div class="form-comment">
				<input type="submit" value="Envoyer">
			</div>
		</form>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
<?php ob_start(); ?>	
<section id="update-post" class="coll-sm-12 justify-content-md-center">
	<h3>Modifier un chapitre</h3><br>
	<form action="index.php?action=admin&edit&ok&id=<?php echo $post['id'] ?>" method="post" class="update-post">
		<div class="update-post">
			<label for="new_title_post">TITRE :</label>
			<input type="text" name="new_title_post" id="new_title_post" value="<?php echo $post['title']; ?>" required>
		</div>
		<div class="update-post">
			<label for="new_text_post"></label><br>
			<textarea name="new_text_post" id="new_text_post" rows="10" cols="50" required><?php echo $post['text']; ?></textarea>
		</div>
		<div class="update-post">
			<input type="submit" value="Modifier">
		</div>
	</form>
	<script>
		tinymce.init({
			selector: '#new_text_post'
		});
    </script>
</section>
<?php 
	$content = ob_get_clean();
	require('template.php');
?>
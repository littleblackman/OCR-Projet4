<?php ob_start(); ?>
<section id="post-content-admin" class="row justify-content-md-center">
	<h3>ADMINISTRATION</h3>
	<?php
		foreach ($posts as $post) {
			$title = $post['title'];
			$text = $post['text'];
			echo '<div class="ticket"><h5>';
			echo $title;
			echo '</h5><p>';
			if (strlen($text) >= 100) {
				echo substr($text, 0, 100) . '...</p><br>';
			} else {
				echo $text . '</p><br>';
			}
			echo '<a href="index.php?action=admin&edit&id=' . $post['id'] . '" class="white">Edit </a>';
			echo '<a href="index.php?action=admin&delete&id=' . $post['id'] . '" class="white">Delete</a>';
			echo '</div>';
		}
	?>
</section>
<hr>
<section id="make-new-post" class="coll-sm-12 justify-content-md-center">
	<h3>Ajouter un chapitre</h3><br>
	<form action="index.php?action=admin&add" method="post" class="form-post">
		<div class="form-post">
			<label for="new_title_post">TITRE :</label>
			<input type="text" name="title_post" id="title_post" required>
		</div>
		<div class="form-post">
			<label for="new_text_post"></label><br>
			<textarea name="text_post" id="text_post" rows="10" cols="50" required>Rédigez ici ...	</textarea>
		</div>
		<div class="form-post">
			<input type="submit" value="Ajouter">
		</div>
	</form>
	<script>
		tinymce.init({
			selector: '#text_post'
		});
   	</script>
</section>
<hr>
<section id="signaled-comment-admin" class="coll justify-content-md-center">	
	<h3>Modération des commentaires</h3><br>
	<?php
		foreach ($comments as $comment) {     
		 	$text = $comment['text_com'];
		    $id_com = $comment['id_com'];
		    $member = $comment['name_com'];
		    echo 
		        '<div class="comment">
		        	<h6>' . $member . '</h6>
		        	<p>' . $text . '</p>
		        	<a href="index.php?action=admin&commentDelete&id=' . $id_com . '" style="text-decoration:none; color:red;">Supprimer</a>
		        	<a href="index.php?action=admin&commentReset&id=' . $id_com . '" style="text-decoration:none; color:blue;">Retirer le signalement</a>
		        </div>'
		    ;
		}
   	?>
</section>
<hr>
<?php 
	$content = ob_get_clean();
	require('template.php'); 
?>

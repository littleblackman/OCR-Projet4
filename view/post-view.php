<?php 
	ob_start(); 
?>
<section id="post-content" class="row justify-content-md-center">
			<?php
				$title = $post['title'];
				$text = $post['text'];
				$id_post = $post['id'];
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
	<div class="comments justify-content-md-center">
		<?php
		 	while ($comment = $comments->fetch()) {
	        	$text = $comment['text_com'];
	        	$member = $comment['name_com'];
	        	echo 
	        		'<div class="comment"><h6>' . $member . '</h6>
	        		<p>' . $text . '</p>
	        		<a href="index.php?action=signaled&id-com=' . $comment['id_com'] . '&id=' . $id_post . '" style="text-decoration:none">Signaler</a></div>'
	        	;
	       	}
	    ?>
	</div>
	<div class="row justify-content-md-center">
		<?php
			if (isset($_SESSION['id'])) {
				echo
					'<form action="/index.php?action=addComment&amp;id=' . $id_post . '" method="post" class="form-coment">
						<div class="form-comment">
							<label for="comment">Ajouter un commentaire : </label><br>
							<textarea name="comment" id="comment" required></textarea>
						</div>
						<div class="form-comment">
							<input type="submit" value="Envoyer">
						</div>
					</form>'
				;	
				} else {
					echo 'Connectez-vous pour rédiger un commentaire !'; 
				}
		?>
	</div>
</section>
<hr>

<?php 
	$content = ob_get_clean();
	require('template.php'); 
?>

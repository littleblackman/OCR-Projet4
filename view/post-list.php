<?php ob_start(); ?>
<section id="presentation-content" class="row justify-content-md-center">
            <div class="presentation">
                <img src="public/img/avatar.jpg" alt="Jean-Forteroche" width="150px" class="img-biographie">
                <div class="biographie">
                    <h3>Biographie</h3>
                    <p>"Auxerunt haec vulgi sordidioris audaciam, quod cum ingravesceret penuria commeatuum, famis et furoris inpulsu Eubuli cuiusdam inter suos clari domum ambitiosam ignibus subditis inflammavit rectoremque ut sibi iudicio imperiali addictum calcibus incessens et pugnis conculcans seminecem laniatu miserando discerpsit. post cuius lacrimosum interitum in unius exitio quisque imaginem periculi sui considerans documento recenti similia formidabat."</p>
                    <p>Jean Forteroche</p>
                </div>
            </div>
</section>
<section id="post-content" class="row justify-content-md-center">
			<?php
				foreach ($posts as $post) {
					$title = $post['title'];
					$text = $post['text'];
					echo '<div class="ticket"><h5>';
					echo $title;
					echo '</h5><p>';
					if (strlen($text) >= 250) {
						echo substr($text, 0, 250) . '...</p>';
						echo '<a href="index.php?action=view&amp;id=' . $post['id'] . '" class="white">Lire la suite</a>';
					} else {
						echo $text;
					}
					echo '</div>';
				}
			?>
</section>

<?php 
	$content = ob_get_clean();
	require('template.php'); 
?>

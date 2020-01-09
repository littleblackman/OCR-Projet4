<?php ob_start(); ?>
<section id="presentation-content" class="row justify-content-md-center">
    <div class="presentation">
        <img src="public/img/avatar.jpg" alt="Jean-Forteroche" class="img-biographie">
        <div class="biographie">
            <h3>Biographie</h3>
            <p>"L'écriture représente une superbe passion sans frais à mes yeux, de ce fait, je vous partage avec joie quelques lignes de mon aventure frigorifiée, à l'autre bout du monde: en Alaska ! 
            Vous découvrirez au travers des chapitres une chronologie envoutante, et je suis certain de vous partager quelques frissons. J'espère de tout coeur que ces chapitres vous transporteront et vous emmèneront là où s'est déroulé le meilleur jour de ma vie. Je serais honoré de recevoir vos critiques positives et/ou négatives. Bonne lecture !"</p>
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
				echo '<a href="index.php?action=view&amp;id=' . $post['id'] . '" class="white">Lire la suite</a>';
			}
			echo '</div>';
		}
	?>
</section>
<?php 
	$content = ob_get_clean();
	require('template.php'); 
?>

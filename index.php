<?php
require('controller/controller.php');

if (isset($_GET['action'])) {

    // Lire un chapitre
    if ($_GET['action'] == 'view') {
        if ((isset($_GET['id'])) && ($_GET['id'] > 0)) {
            post();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

}

else {
    listPosts();
}
 
?>
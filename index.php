<?php
require('controller/controller.php');
session_start();

// VERIFICATION SI $_GET
if (!empty($_GET)) {
    // VERIFICATION SI $_GET => ACTION
    if (isset($_GET['action'])) {

        // Ouvrir un post et ses commentaires
        if ($_GET['action'] == 'view') {
            if ((isset($_GET['id'])) && ($_GET['id'] > 0)) {
                post();
            } else {
                echo 'Erreur : aucun identifiant de billet envoyé';
                echo '<a href="index.php"> Retourner à l\'accueil</a>';
            }
        }

        // Ajouter un commentaire
        else if ($_GET['action'] == 'addComment') {
            if (isset($_SESSION['id'])) {
                if ((!empty($_POST['comment'])) && (isset($_GET['id']))) {
                    addComment($_POST['comment'], $_GET['id']);
                } else {
                    echo 'Erreur : tous les champs ne sont pas remplis !';
                    echo '<a href="index.php"> Retourner à l\'accueil</a>';
                }
            } else {
                echo 'Erreur : Vous devez être connecté !';
                echo '<a href="index.php"> Retourner à l\'accueil</a>';
            }
        }

        // LOGIN
        else if ($_GET['action'] == 'login') {
            if (isset($_SESSION['id'])) {
                echo 'Vous êtes déjà connecté !';
            } else {
                // login-view
                if (isset($_GET['verify'])) {
                    if ((isset($_POST['login_name'])) && (isset($_POST['login_pass']))) {
                        loginVerify(($_POST['login_name']),($_POST['login_pass']));
                    }
                    else {
                        echo 'Erreur : tous les champs ne sont pas remplis !';
                        echo '<a href="index.php"> Retourner à l\'accueil</a>';
                    }
                } else {
                    require('view/login-view.php');
                }
            }
        }

         // LOGOUT
        else if ($_GET['action'] == 'logout') {
            if (isset($_SESSION['id'])) {
                logout();
            } else {
                echo 'Vous n\'êtes pas connecté !';
                echo '<a href="index.php"> Retourner à l\'accueil</a>';
            }
        }

        // ADMINISTRATION
        else if ($_GET['action'] == 'admin') {
            if (isset($_SESSION['id'])) {
                if ($_SESSION['status'] == '1') {
                    if (isset($_GET['add'])) {
                        addPost($_POST['title_post'], $_POST['text_post']);
                    } else if (isset($_GET['delete'])) {
                        deletePost($_GET['id']);
                    } else if (isset($_GET['edit'])) {
                        echo 'edit';
                    } else {
                        goToAdmin();
                    }
                } else {
                    echo 'Vous n\'êtes pas administrateur !';
                    echo '<a href="index.php"> Retourner à l\'accueil</a>';
                }
            } else {
                echo 'Vous devez être connecté !';
                echo '<a href="index.php"> Retourner à l\'accueil</a>';
            }
        }

        // SIGNALEMENT
        else if ($_GET['action'] == 'signaled') {
            if (isset($_SESSION['id'])) {
                if ((($_GET['signaled']) >= 1) && (isset($_GET['id'])) && (($_GET['id']) >= 1)) {
                    signaled($_GET['signaled'], $_GET['id']);
                } else {
                    echo 'Désolé, une erreur s\'est produite.';
                    echo '<a href="index.php"> Retourner à l\'accueil</a>';            
                }
            } else {
                echo 'Vous devez être connecté pour signaler un commentaire !';
                echo '<a href="index.php"> Retourner à l\'accueil</a>';
            }
        }

    } else {
        echo 'Erreur : La page recherché n\'éxiste pas !';
        echo '<a href="index.php"> Retourner à l\'accueil</a>';
    }
} else {
    listPosts();
}
 
?>
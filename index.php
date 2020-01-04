<?php
    require('controller/controller.php');
    session_start();

    try {
        // VERIFICATION SI $_GET
        if (!empty($_GET)) {
            // VERIFICATION SI $_GET => ACTION
            if (isset($_GET['action'])) {

                // Ouvrir un post et ses commentaires
                if ($_GET['action'] == 'view') {
                    if ((isset($_GET['id'])) && ($_GET['id'] > 0)) {
                        post();
                    } else {
                        throw new Exception('Erreur : aucun identifiant de billet envoyé'); 
                    }
                }

                // Ajouter un commentaire
                else if ($_GET['action'] == 'addComment') {
                    if (isset($_SESSION['id'])) {
                        if ((!empty($_POST['comment'])) && (isset($_GET['id']))) {
                            addComment($_POST['comment'], $_GET['id']);
                        } else {
                            throw new Exception('Erreur : tous les champs ne sont pas remplis !');  
                        }
                    } else {
                        throw new Exception('Erreur : Vous n\'êtes pas connecté !');  
                    }
                }

                // LOGIN
                else if ($_GET['action'] == 'login') {
                    if (isset($_SESSION['id'])) {
                        throw new Exception('Erreur : Vous êtes déjà connecté !');
                    } else {
                        // login-view
                        if (isset($_GET['verify'])) {
                            if ((isset($_POST['login_name'])) && (isset($_POST['login_pass']))) {
                                loginVerify(($_POST['login_name']),($_POST['login_pass']));
                            }
                            else {
                                throw new Exception('Erreur : tous les champs ne sont pas remplis !');
                            }
                        } else {
                            require('view/login-view.php');
                        }
                    }
                }

                // SUBSCRIBE
                else if ($_GET['action'] == 'subscribe') {
                    if (isset($_SESSION['id'])) {
                        throw new Exception('Erreur : Vous êtes déjà connecté !');
                    } else {
                        if (isset($_GET['verify'])) {
                            if ((isset($_POST['subscribe_name'])) && (isset($_POST['subscribe_pass']))) {
                                subscribeVerify(($_POST['subscribe_name']),($_POST['subscribe_pass']));
                            }
                            else {
                                throw new Exception('Erreur : tous les champs ne sont pas remplis a!');
                            }
                        } else {
                            require('view/subscribe-view.php');
                        }
                    }
                }

                 // LOGOUT
                else if ($_GET['action'] == 'logout') {
                    if (isset($_SESSION['id'])) {
                        logout();
                    } else {
                        throw new Exception('Erreur : Vous n\'êtes pas connecté !');
                    }
                }

                // ADMINISTRATION
                else if ($_GET['action'] == 'admin') {
                    if (isset($_SESSION['id'])) {
                        if ($_SESSION['status'] == '1') {
                            if (isset($_GET['add'])) {
                                addPost($_POST['title_post'], $_POST['text_post']);
                            } else if (isset($_GET['delete'])) {
                                if (isset($_GET['confirm'])) {
                                    deletePost($_GET['id']);                                   
                                } else {
                                    confirm($_GET['id']);
                                }
                            } else if (isset($_GET['edit'])) {
                                if (isset($_GET['ok'])) {
                                    editPost($_POST['new_title_post'], $_POST['new_text_post']);
                                } else {
                                    openEditForm($_GET['id']);
                                }
                            } else {
                                goToAdmin();
                            }
                        } else {
                            throw new Exception('Erreur : Vous n\'êtes pas administrateur !');
                        }
                    } else {
                        throw new Exception('Erreur : Vous n\'êtes pas connecté !');  
                    }
                }

                // SIGNALEMENT
                else if ($_GET['action'] == 'signaled') {
                    if (isset($_SESSION['id'])) {
                        if ((($_GET['id-com']) >= 1) && (isset($_GET['id'])) && (($_GET['id']) >= 1)) {
                            signaled($_GET['id-com'], $_GET['id']);
                        } else {
                            throw new Exception('Erreur : Désolé, une erreur s\'est produite.');           
                        }
                    } else {
                        throw new Exception('Erreur : Vous devez être connecté pour signaler un commentaire !');  
                    }
                }

            } else {
                throw new Exception('Erreur : La page recherché n\'existe pas !');  
            }
        } else {
            listPosts();
        }
    } catch(Exception $e) {
        $errorMessage = $e->getMessage();
        require('view/error-view.php');
    }
?>
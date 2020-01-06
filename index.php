<?php
    require('controller/controller.php');
    session_start();
    try {
        // VERIFICATION SI GET ?
        if (!empty($_GET)) {
            // VERIFICATION SI ACTION ?
            if (isset($_GET['action'])) {

                // LECTURE POST + COMMENTS
                if ($_GET['action'] == 'view') {
                    if ((isset($_GET['id'])) && ($_GET['id'] > 0)) {
                        post();
                    } else {
                        throw new Exception('Erreur : aucun identifiant de billet envoyé'); 
                    }
                }

                // LOGIN
                else if ($_GET['action'] == 'login') {
                    if (isset($_SESSION['id'])) {
                        throw new Exception('Erreur : Vous êtes déjà connecté !');
                    } else {
                        if (isset($_GET['verify'])) {
                            if ((isset($_POST['login_name'])) && (isset($_POST['login_pass']))) {
                                loginVerify(htmlspecialchars(($_POST['login_name'])),htmlspecialchars(($_POST['login_pass'])));
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
                                subscribeVerify(htmlspecialchars(($_POST['subscribe_name'])),htmlspecialchars(($_POST['subscribe_pass'])));
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
                                addPost(htmlspecialchars($_POST['title_post']), htmlspecialchars($_POST['text_post']));
                            } else if (isset($_GET['delete'])) {
                                if (isset($_GET['confirm'])) {
                                    deletePost(htmlspecialchars($_GET['id']));                                   
                                } else {
                                    confirm(htmlspecialchars($_GET['id']));
                                }
                            } else if (isset($_GET['edit'])) {
                                if (isset($_GET['ok'])) {
                                    editPost(htmlspecialchars($_POST['new_title_post']), htmlspecialchars($_POST['new_text_post']), htmlspecialchars($_GET['id']));
                                } else {
                                    openEditForm(htmlspecialchars($_GET['id']));
                                }
                            } else if (isset($_GET['commentDelete'])) {
                                deleteComment(htmlspecialchars($_GET['id']));                                   
                            } else if (isset($_GET['commentReset'])){
                                resetComment(htmlspecialchars($_GET['id']));
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

                // AJOUT COMMENTAIRE
                else if ($_GET['action'] == 'addComment') {
                    if (isset($_SESSION['id'])) {
                        if ((!empty($_POST['comment'])) && (isset($_GET['id']))) {
                            addComment(htmlspecialchars($_POST['comment']), htmlspecialchars($_GET['id']));
                        } else {
                            throw new Exception('Erreur : tous les champs ne sont pas remplis !');  
                        }
                    } else {
                        throw new Exception('Erreur : Vous n\'êtes pas connecté !');  
                    }
                }

                // SIGNALEMENT
                else if ($_GET['action'] == 'signaled') {
                    if (isset($_SESSION['id'])) {
                        if ((($_GET['id-com']) >= 1) && (isset($_GET['id'])) && (($_GET['id']) >= 1)) {
                            signaled(htmlspecialchars($_GET['id-com']), htmlspecialchars($_GET['id']));
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
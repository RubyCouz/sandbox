<?php
$url = "http://" . $_SERVER['HTTP_HOST'] . "." . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Sandbox</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url('assets/css/materialize.min.css') ?>">
        <link rel="icon" href="<?= base_url('assets/img/icons/favicon.ico') ?>" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/monokai.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <script src="<?= base_url('assets/js/jquery-3.3.1.js') ?>"></script>
    </head>

    <body>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="<?= site_url('Produits/home') ?>" class="brand-logo"><img src="<?= base_url('/assets/img/sandbox_logo.png') ?>" title="Logo de la SandBox" alt="image d'un bac à sable" class="logo"></a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="<?= site_url('Produits/home_user') ?>">Catalogue</a></li>
                        <li><a href="<?= site_url('Produits/sendMail') ?>">Contact</a></li>
                        <?php
                        if ($this->session->userdata('id') !== null)
                        {
                            ?>
                            <li><a class="dropdown-trigger btn" href="#" data-target="dropdown_user"><?= $this->session->userdata('login') ?></a></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><a class="modal-trigger" href="#signin">Inscription/Connexion</a></li>
                            <?php
                        }
                        if ($url != 'http://localhost./ci/index.php/Produits/cart')
                        {
                            ?>
                            <li>
                                <a class="dropdown-trigger" href="#" data-target="dropdown_cart"><i class="material-icons">shopping_cart</i></a>
                            </li>
                            <?php
                        }
                        ?>                        
                    </ul>
                </div>
            </nav>
            <!-- menu mobil -->
            <ul class="sidenav" id="mobile-demo">
                <li><a href="<?= site_url('Produits/home_user') ?>">Catalogue</a></li>
                <li><a href="<?= site_url('Client/signin_form') ?>">Inscription/Connexion</a></li>
                <li><a href="<?= site_url('Produits/sendMail') ?>">Contact</a></li>
            </ul>
            <!-- dropdown panier -->
            <div class="dropdown-content cart" id="dropdown_cart">
                <?php
                $this->load->view('cart')
                ?>


            </div>
            <!-- dropdown user -->
            <ul id="dropdown_user" class="dropdown-content">
                <?php
                if ($this->session->userdata('role') == 1)
                {
                    //dropdown menu admin
                    ?>
                    <li><a href = "<?= site_url('Produits/home_user') ?>">Liste des produits</a></li>
                    <li><a href = "<?= site_url('Produits/addProduct') ?>">Ajouter un produit</a></li>
                    <li><a href = "<?= site_url('Client/list_user') ?>">Liste des utilisateurs</a></li>
                    <li><a href = "<?= site_url('Client/add_user') ?>">Ajouter un  utilisateurs</a></li>
                    <li class = "divider" tabindex = "-1"></li>
                    <li><a href = "<?= site_url('Client/user_profil') ?>">Mon profil</a></li>
                    <li><a href = "<?= site_url('Client/sign_out') ?>" class="waves-effect waves-light btn">Se déconnecter</a></li>
                    <?php
                }
                else
                {
                    //dropdown menu client
                    ?>
                    <li><a href = "<?= site_url('Client/user_profil') ?>">Mon profil</a></li>
                    <li><a href = "<?= site_url('Produits/user_cart') ?>">Mon pannier</a></li>
                    <li class = "divider" tabindex = "-1"></li>
                    <li><a href = "<?= site_url('Client/sign_out') ?>" class="waves-effect waves-light btn">Se déconnecter</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div id="signin" class="modal">
            <div class="modal-content">
                <h4>Se connecter</h4>
                <?php
                echo form_open('Client/user_check');
                ?>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="login_user" type="text" name="login_user" value="<?= set_value('login_user') != NULL ? set_value('login_user') : '' ?>">
                        <label for="login_user" >Pseudo :</label>  
                        <span id="missingLogin" class="error"><?= form_error('login_user') != null ? form_error('login_user') : '' ?></span>
                    </div>
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password_user" value="<?= set_value('password_user') != NULL ? set_value('password_user') : '' ?>">
                        <label for="password">Mot de passe :</label>
                        <span id="missingPassword" class="error"><?= form_error('password_user') != null ? form_error('password_user') : '' ?></span>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <label>
                                <input type="checkbox" checked="checked" disabled="disabled">
                                <span>Restez connecter</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 center-align">
                        <input type="submit" name="second" id="log" class="waves-effect waves-light btn" value="se connecter">
                    </div>
                </div>
                <?php
                echo form_close()
                ?>
                <div class="row">
                    <div class="col s12 right-align">
                        <a href="<?= site_url('Client/signin_form') ?>">Vous n'êtes pas encore inscrit? Venez par ici !!!</a>
                    </div>
                </div>
            </div>
        </div>
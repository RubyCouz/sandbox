<div class="container">
    <div class="row">
        <div class="col s12">
            <h1>Formulaire d'inscription</h1>
            <?php
            echo form_open('Client/check_userform');
            ?>
            <div class="row">
                <div class="input-field col s6">
                    <input id="firstname" type="text" name="firstname_user" class="white-text" value="<?= set_value('firstname_user') != NULL ? set_value('firstname_user') : '' ?>">
                    <label for="firstname" >Prénom :</label>  
                    <span id="missingFirstname" class="error"><?= form_error('firstname_user') != null ? form_error('firstname_user') : '' ?></span>
                </div>
                <div class="input-field col s6">
                    <input id="lastname" type="text" class="white-text" name="lastname_user" value="<?= set_value('lastname_user') != NULL ? set_value('lastname_user') : '' ?>">
                    <label for="lastname">Nom :</label>
                    <span id="missingLastname" class="error"><?= form_error('lastname_user') != null ? form_error('lastname_user') : '' ?></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="login" type="text" class="white-text" name="login_user" value="<?= set_value('login_user') != NULL ? set_value('login_user') : '' ?>">
                    <label for="login">Pseudo :</label>
                    <span id="missingLog" class="error"><?= form_error('login_user') != null ? form_error('login_user') : '' ?></span>
                </div>
                <div class="input-field col s6">
                    <input id="mail" type="email" class="white-text" name="mail_user" value="<?= set_value('mail_user') != NULL ? set_value('mail_user') : '' ?>">
                    <label for="mail">Adresse mail :</label>
                    <span id="missingMail" class="error"><?= form_error('mail_user') != null ? form_error('mail_user') : '' ?></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="password1" type="password" class="white-text" name="password_user" value="<?= set_value('password_user') != NULL ? set_value('password_user') : '' ?>">
                    <label for="password1">Mot de passe :</label>
                    <span id="missingPassword1" class="error"><?= form_error('password_user') != null ? form_error('password_user') : '' ?></span>
                </div>
                <div class="input-field col s6">
                    <input id="passwordVerif" type="password" class="white-text" name="passwordVerif_user" value="<?= set_value('passwordVerif_user') != NULL ? set_value('passwordVerif_user') : '' ?>">
                    <label for="passwordVerif">Confirmer votre mot de passe :</label>
                    <span id="missingPasswordVerif" class="error"><?= form_error('passwordVerif_user') != null ? form_error('passwordVerif_user') : '' ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center-align">
                    <span id="errorPassword" class="error"><?= form_error('passwordVerif_user') != null ? form_error('passwordVerif_user') : '' ?></span>
                </div>
            </div>
            <div class="row center-align">
                <div class="col s6">
                    <input type="submit" id="validate"  class="waves-effect waves-light btn white-text" value="Confirmer l'inscription">
                </div>
                <div class="col s6">
                    <a href="<?= site_url('Produits/home') ?>" class="waves-effect waves-light btn red darken-4" title="Retour à l'accueil">Retour à l'accueil</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
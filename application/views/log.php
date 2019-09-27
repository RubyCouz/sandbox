<div class="container-fluid">
    <div class="row">
        <div class="col s4 offset-s4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Connexion</span>

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
                    </div>
                    <div class="row">
                        <div class="col s6 offset-s6">
                            <input type="submit" name="second" id="log" class="waves-effect waves-light btn" value="se connecter">
                        </div>
                    </div>
                    <?php
                    echo form_close()
                    ?>
                </div>       
            </div>
        </div>
    </div>
</div>
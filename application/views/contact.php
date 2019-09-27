<div class="container">
    <div class="row">
        <div class="col s12">
            <h1>Contactez-nous !!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <?= form_open() ?>
            <div class="row">
                <div class="input-field col s6">
                    <input id="mail" name="mail" type="email">
                    <label for="mail">Adresse mail :</label>
                </div>
                <div class="input-field col s6">
                    <input id="subject" name="subject" type="text">
                    <label for="subject">Sujet :</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="content" name="content" class="materialize-textarea"></textarea>
                    <label for="content">Message : </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 center-align">
                    <input id="send" type="submit" class="waves-effect waves-light btn">
                </div>
            </div>
        </div>
    </div>
</div>

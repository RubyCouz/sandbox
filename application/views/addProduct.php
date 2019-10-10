
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card light-green lighten-5">
                <div class="card-content">
                    <span class="card-title">Ajout d'un produit</span>
                    <?= form_open_multipart() ?>
                    <div class="row">
                        <div class="col s6" id="prev">
                            <img src="" alt="image" title="preview de l'image du produit" class="pic2">
                        </div>
                        <div class="col s6">
                            <div class="row">
                                <div class="input-field col s12">
                                    <select name="pro_cat_id" id="categories">
                                        <option value="" disabled selected>Choisissez une catégorie</option>
                                        <?php
                                        foreach ($categoriesList as $cat)
                                        {
                                            ?>
                                            <option value="<?= $cat->cat_id ?>" <?= set_value('pro_cat_id') == $cat->cat_id ? 'selected' : '' ?>><?= $cat->cat_nom ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="categories">Catégorie</label>
                                    <?php
                                    if (form_error('pro_cat_id') != NULL)
                                    {
                                        ?>
                                        <span class="new badge"><?= form_error('pro_cat_id') ?></span>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="addRef" type="text" name="pro_ref" class="" value="<?= set_value('pro_ref') != NULL ? set_value('pro_ref') : '' ?>">
                                    <label for="addRef">Référence</label>
                                    <span class="error" id="errorRef"></span>
                                    <?php
                                    if (form_error('pro_ref') != NULL)
                                    {
                                        ?>
                                        <span class="new badge"><?= form_error('pro_ref') ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="addLabel" type="text" name="pro_libelle" class="" value="<?= set_value('pro_libelle') != NULL ? set_value('pro_libelle') : '' ?>">
                                    <label for="addLabel">Libellé</label>
                                    <span class="error" id="errorLabel"></span>
                                    <?php
                                    if (form_error('pro_libelle') != NULL)
                                    {
                                        ?>
                                        <span class="new badge"><?= form_error('pro_libelle') ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>                                                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="addColor" type="text" name="pro_couleur" class="" value="<?= set_value('pro_couleur') != NULL ? set_value('pro_couleur') : '' ?>">
                            <label for="addColor">Couleur</label>
                            <span class="error" id="errorColor"></span>
                            <?php
                            if (form_error('pro_couleur') != NULL)
                            {
                                ?>
                                <span class="new badge"><?= form_error('pro_couleur') ?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col s6">
                            <div class="input-field">
                                <input id="addStock" type="text" name="pro_stock" class="" value="<?= set_value('pro_stock') != NULL ? set_value('pro_stock') : '' ?>">
                                <label for="addStock">Stock</label>
                                <span class="error" id="errorStock"></span>
                                <?php
                                if (form_error('pro_stock') != NULL)
                                {
                                    ?>
                                    <span class="new badge"><?= form_error('pro_stock') ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col s6">
                            <div class="input-field">
                                <input id="addPrice" type="text" name="pro_prix" class="" value="<?= set_value('pro_prix') != NULL ? set_value('pro_prix') : '' ?>">
                                <label for="addPrice">Prix</label>
                                <span class="error" id="errorPrice"></span>
                                <?php
                                if (form_error('pro_prix') != NULL)
                                {
                                    ?>
                                    <span class="new badge"><?= form_error('pro_prix') ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col s6">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Insérer une photo</span>
                                    <input type="file" name="pro_photo" id="upload">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" id="addFile">
                                </div>
                                <span class="info">Au format .gif, .jpg, .jpeg, .pjpeg ou .png</span>
                                <span class="error" id="errorFile"></span>
                            </div>
                            <?php
                            if (isset($error) && $error != '')
                            {
                                ?>
                                <span class="new badge"><?= $error ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <textarea id="addDescription" class="materialize-textarea" name="pro_description"><?= set_value('pro_description') != NULL ? set_value('pro_description') : '' ?></textarea>
                                <label for="addDescription">Description</label>
                                <span class="error" id="errorDesc"></span>
                                <?php
                                if (form_error('pro_description') != NULL)
                                {
                                    ?>
                                    <span class="new badge"><?= form_error('pro_description') ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row valign-wrapper left-align">
                        <div class="col s2 radio">
                            <p>Produit bloqué :</p>
                        </div>
                        <div class="col s1 radio">
                            <label>
                                <input name="pro_bloque" type="radio" value="1" <?= set_value('pro_bloque') == 1 ? 'checked' : '' ?>>
                                <span>Oui</span>
                            </label>
                        </div>
                        <div class="col s1 radio">
                            <label>
                                <input name="pro_bloque" type="radio" value="2" <?= set_value('pro_bloque') == 2 ? 'checked' : '' ?>>
                                <span>Non</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6 center-align">
                            <input type="submit" value="Ajouter le produit" class="waves-effect waves-light btn">
                        </div>
                        <div class="col s6 center-align">
                            <a href="<?= site_url('Produits/home_user') ?>" title="Lien vers le catalogue" class="waves-effect waves-light btn cyan accent-4">Retour au catalogue</a>
                        </div>
                    </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div> 
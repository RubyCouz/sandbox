<?php
include 'header.php';
include '../controler/productControler.php';
?>
<div class="uk-container">
    <?php
    if (isset($_POST['submit']))
    {
        if (count($formError) == 0)
        {
            ?>
            <p>
                Produit modifié !!
            </p>
            <a href="allProduct.php" title="Retour à la liste de produit" class="uk-button uk-button-secondary">Retour à la liste de produit</a>
            <?php
        }
        else
        {
            ?>
            <p>
                Oups! Une erreur est survenue !!
            </p>
            <a href="allProduct.php" title="Retour à la liste de produit" class="uk-button uk-button-secondary">Retour à la liste de produit</a>

            <?php
        }
    }
    else if (isset($_POST['delete']))
    {
        ?>
        <p>
            Produit supprimé !!
        </p>
        <a href="allProduct.php" title="Retour à la liste de produit" class="uk-button uk-button-secondary">Retour à la liste de produit</a>
        <?php
    }
    else
    {
        ?>
        <form method="POST" action="#" enctype="multipart/form-data">
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">Détail du produit <?= $product->pro_libelle ?></legend>

                <div class="uk-child-width-1-2 uk-text-center" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body">
                            <img src="../assets/img/<?= $product->pro_id . '.' . $product->pro_photo ?>" />
                        </div>
                    </div>
                    <div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="id">Id</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="id" type="text" name="id" placeholder="Some text..." value="<?= $product->pro_id ?>" disabled />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <select class="uk-select">
                                <?php
                                foreach ($isObjectResult as $cat)
                                {
                                    ?>
                                    <option value="<?= $cat->cat_id ?>" <?= $cat->cat_id == $product->pro_cat_id ? 'selected' : '' ?>><?= $cat->cat_nom ?></option>
        <?php
    }
    ?>
                            </select>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="cat">Catégorie</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="cat" type="text" name="cat" placeholder="Some text..." value="<?= $product->pro_cat_id ?>" disabled/>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="ref">Référence</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="ref" type="text" name="ref" placeholder="Some text..." value="<?= $product->pro_ref ?>" />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="color">Couleur</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="color" type="text" name="color" placeholder="Some text..." value="<?= $product->pro_couleur ?>" />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="label">Libellé</label> /
                            <div class="uk-form-controls">
                                <input class="uk-input" id="label" type="text" name="label" placeholder="Some text..." value="<?= $product->pro_libelle ?>" />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="price">Prix</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="price" type="text" name="price" placeholder="Some text..." value="<?= $product->pro_prix ?>" />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="stock">Stock</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="stock" type="text" name="stock" placeholder="Some text..." value="<?= $product->pro_stock ?>" />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div uk-form-custom="target: true">
                                <input type="file" name="file" >
                                <input class="uk-input uk-form-width-medium" type="text" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="description">Description</label>
                    <textarea class="uk-textarea" rows="5" id="description" placeholder="Textarea" name="description" value=""><?= $product->pro_description ?></textarea>
                </div>
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label>Produit bloqué :</label>
                    <label><input class="uk-radio" type="radio" name="radio2" value="1" <?= $product->pro_bloque == 1 ? 'checked' : '' ?>> Oui</label>
                    <label><input class="uk-radio" type="radio" name="radio2" value="2" <?= ($product->pro_bloque == NULL) || ($product->pro_bloque == 2) ? 'checked' : '' ?>> Non</label>
                </div>
                <div class="uk-margin">
                    <p>Date d'ajout : <?= $product->pro_d_ajout ?></p>
                </div>
                <div class="uk-margin">
                    <p>Date de modification : <?= $product->pro_d_modif ?></p>
                </div>
            </fieldset>
            <input type="submit" name="submit" value="Modifier le produit" class="uk-button uk-button-secondary" />
            <input type="submit" name="delete" id="delete" class="uk-button uk-button-danger" value="Effacer le produit" />
        </form>
    <?php
}
?>
</div>



<?php
include 'footer.php';
?>
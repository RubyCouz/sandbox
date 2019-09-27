<?php
include 'header.php';
include '../controler/productFormController.php';
?>
<div class="uk-container">
    <?php
    if (isset($_POST['submit']) && count($formError) == 0)
    {
        ?>
        <p>Produit ajouté au catalogue avec succès !!</p>
        <?php
    }
    else if (isset($_POST['submit']) && count($formError) > 0)
    {
        ?>
        <p><?= $formError['error'] ?></p>
        <?php
    }
    else
    {
        ?>
        <form method="POST" action="#" enctype="multipart/form-data">
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">Ajouter un produit</legend>

                <div class="uk-child-width-1-2 uk-text-center" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body">
                            <img src="" />
                        </div>
                    </div>
                    <div>
                        <div class="uk-margin">
                            <label for="categories"></label>
                            <select class="uk-select" id="categories" name="categories">
                                <option disabled selected>Choisissez une catégorie</option>
                                <?php
                                foreach ($isObjectResult as $cat)
                                {
                                    ?>
                                    <option value="<?= $cat->cat_id ?>"><?= $cat->cat_nom ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="ref">Référence</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="ref" type="text" name="ref" placeholder="Indiquez une référence"  />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="color">Couleur</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="color" type="text" name="color" placeholder="Indiquez une couleur"  />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="label">Libellé</label> /
                            <div class="uk-form-controls">
                                <input class="uk-input" id="label" type="text" name="label" placeholder="Libellé" />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="price">Prix</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="price" type="text" name="price" placeholder="Prix"  />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="stock">Stock</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="stock" type="text" name="stock" placeholder="Quantité en stock"  />
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div uk-form-custom="target: true">
                                <input type="file" name="file" >
                                <input class="uk-input uk-form-width-medium" type="text" placeholder="Insérez une image" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="description">Description</label>
                    <textarea class="uk-textarea" rows="5" id="description" placeholder="Description" name="description" ></textarea>
                </div>
                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label>Produit bloqué :</label>
                    <label><input class="uk-radio" type="radio" name="radio2" value="1"> Oui</label>
                    <label><input class="uk-radio" type="radio" name="radio2" value="2"> Non</label>
                </div>
            </fieldset>
            <input type="submit" name="submit" value="Ajouter le produit" class="uk-button uk-button-secondary" />
        </form>
    </div> 
    <?php
    include 'footer.php';
}
?>

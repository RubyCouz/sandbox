
<div class="container">
    <h1>Vue Client</h1>
    <div class="row">       
        <div class="col s12">
            <a href="allProduct.php" class="waves-effect waves-light btn" title="Lien vers l'affichage des produits sur une vue client">Voir la vue admin</a>
        </div>
    </div>
    <div class="row">
        <?php
        foreach ($productList as $element)
        {
            ?>
            <div class="col s3">
                <div class="card sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator pic" src="../../assets/img/<?= $element->pro_id . '.' . $element->pro_photo ?>" alt="Photo d'illustration" title="Photo de <?= $element->pro_libelle ?>">
                    </div>
                    <div class="card-content cardClient">
                        <span class="card-title activator grey-text text-darken-4"><?= $element->pro_libelle ?><i class="material-icons right">more_vert</i></span>
                        <p><a href="#"><?= $element->pro_prix ?> €</a></p>
                    </div>
                    <div class="card-action">
                        <a href="#">Ajouter au panier</a>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><?= $element->pro_libelle ?><i class="material-icons right">close</i></span>
                        <p><?= $element->pro_description ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
include '../footer.php';
?>
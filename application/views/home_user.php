
<div class="container">
    <div class="row">
        <?php
        var_dump($this->session->userdata('role'));
        if ($this->session->userdata('role') != 1)
        {
            ?>
            <h1>Nos produits</h1>
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
        }
        else
        {
            ?>
            <h1>Liste des produits</h1>
            <a href="<?= site_url('Produits/addProduct') ?>" class="waves-effect waves-light btn" title="Lien vers ajout d'un produit" target="_blank">Ajouter un produit</a>
            <table class="stripped highlight centered responsive-table table">
                <thead>
                <th>Photo</th>
                <th>Id</th>
                <th>Catégorie</th>
                <th>Référence</th>
                <th>Libellé</th>
                <th>Couleur</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Ajout</th>
                <th>Modif</th>
                <th>Bloqué</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($productList as $row)
                    {
                        ?>
                        <tr>
                            <td>
                                <img src="<?= base_url('assets/img/' . $row->pro_id . '.' . $row->pro_photo) ?>" alt="Photo d'illustration" title="Photo de <?= $row->pro_libelle ?>" class="pic">
                            </td>
                            <td><?= $row->pro_id ?></td>
                            <td><?= $row->pro_cat_id ?></td>
                            <td><?= $row->pro_ref ?></td>
                            <td><?= $row->pro_libelle ?></td>
                            <td><?= $row->pro_couleur ?></td>
                            <td><?= $row->pro_description ?></td>
                            <td><?= $row->pro_prix ?></td>
                            <td><?= $row->pro_stock ?></td>
                            <td><?= $row->pro_d_ajout ?></td>
                            <td><?= $row->pro_d_modif ?></td>
                            <td><?= $row->pro_bloque == 1 ? 'Oui' : 'Non' ?></td>
                            <td><a href="<?= site_url('Produits/update') . '/' . $row->pro_id ?>" title="Lien vers la fiche produit" class="waves-effect waves-light btn">Fiche Produit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>    
            <a href="<?= site_url('Produits/addProduct') ?>" class="waves-effect waves-light btn" title="Lien vers ajout d'un produit" target="_blank">Ajouter un produit</a>
        </div> 
        <?php
    }
    ?>
</div>
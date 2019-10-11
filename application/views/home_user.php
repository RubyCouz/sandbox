
<div class="container">
    <div class="row">
        <?php
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
                            <img class="activator pic" src="<?= base_url('assets/img/' . $element->pro_id . '.' . $element->pro_photo)?>" alt="Photo d'illustration" title="Photo de <?= $element->pro_libelle ?>">
                        </div>
                        <div class="card-content cardClient">
                            <span class="card-title activator grey-text text-darken-4"><?= $element->pro_libelle ?><i class="material-icons right">more_vert</i></span>
                            <p><a href="#"><?= $element->pro_prix ?> €</a></p>
                        </div>
                        <div class="card-action">
                            <?php echo form_open(); ?>
                            <input type="hidden" name="pro_qte" id="pro_qte<?= $element->pro_id ?>" value="1">
                            <input type="hidden" name="pro_prix" id="pro_prix<?= $element->pro_id ?>" value="<?= $element->pro_prix ?>">
                            <input type="hidden" name="pro_id" id="pro_id" value="<?= $element->pro_id ?>">
                            <input type="hidden" name="pro_libelle" id="pro_libelle<?= $element->pro_id ?>" value="<?= $element->pro_libelle ?>">
                            <input type="hidden" name="pro_photo" id="pro_photo<?= $element->pro_id ?>" value="<?= $element->pro_photo ?>">
                            <div class="right-align">
                                <button class="waves-effect waves-light btn addProduct" type="button" id="addProduct" value="<?= $element->pro_id ?>">
                                    <i class="material-icons">add_shopping_cart</i>
                                </button> 

                            </div>
                            </form>                           
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
            <div class="row">
                <div class="col s12 center-align">
                    <!-- pagination -->
                    
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <?php
        }
        else
        {
            ?>
            <h1>Liste des produits</h1>
            <a href="<?= site_url('Produits/addProduct') ?>" class="waves-effect waves-light btn" title="Lien vers ajout d'un produit">Ajouter un produit</a>
            
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
                            <td><?= $row->add_date ?></td>
                            <td><?= $row->update_date ?></td>
                            <td><?= $row->pro_bloque == 1 ? 'Oui' : 'Non' ?></td>
                            <td><a href="<?= site_url('Produits/update') . '/' . $row->pro_id ?>" title="Lien vers la fiche produit" class="waves-effect waves-light btn">Fiche Produit</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>    
            <div class="row">
                <div class="col s12 center-align">
                    <!-- pagination -->
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <a href="<?= site_url('Produits/addProduct') ?>" class="waves-effect waves-light btn" title="Lien vers ajout d'un produit">Ajouter un produit</a>
                </div>
            </div>
        </div> 
        <?php
    }
    ?>
</div>
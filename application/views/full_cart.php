
<div class="row">
    <div class="col s12 white-text">
        <?php
        if ($this->session->cart !== null)
        {
            $total = 0;
            ?>
            <div class="row">
                <div class="col s3">
                    <p>Produits</p>
                </div>
                <div class="col s3">
                    <p>Quantité</p>
                </div>
                <div class="col s3">
                    <p>total</p>
                </div>
            </div>
            <?php
            foreach ($this->session->cart as $prod)
            {
                ?>
                <div class="row" id="<?= $prod['pro_id'] ?>">
                    <div class="col s3">
                        <p><?= $prod['pro_libelle'] ?></p>
                    </div>
                    <div class="col s1">
                        <p><?= $prod['pro_qte'] ?></p>
                    </div>
                    <div class="col s2">
                        <form class="row">
                            <input type="hidden" name="pro_qte" id="qte" value="<?= $prod['pro_qte'] ?>">
                            <input type="hidden" name="pro_id" id="id" value="<?= $prod['pro_id'] ?>">
                            <div class="col s12 modify">
                                <button type="button" class="addProduct waves-effect waves-light btn tiny material-icons" value="<?= $prod['pro_id'] ?>">add</button>
                            </div>
                            <div class="col s12 modify">
                                <button type="button" class="removeProduct waves-effect waves-light btn tiny material-icons" value="<?= $prod['pro_id'] ?>">remove</button>
                            </div>
                        </form>
                    </div>
                    <div class="col s3">
                        <p><?= str_replace('.', ',', ($prod['pro_qte'] * $prod['pro_prix'])); ?> <sup>€</sup></p>
                    </div>
                    <div class="col s3">                                       
                        <button class="waves-effect waves-light btn red delProd" id="delProduct" value="<?= $prod['pro_id'] ?>">Supprimer</button> 
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row">
                <div class="col s6">
                    <p>Total de votre commande : </p>
                </div>
                <div class="col s6">
                    <p>
                        <?php
                        foreach ($this->session->cart as $prod)
                        {
                            $total += $prod['pro_qte'] * $prod['pro_prix'];
                        }
                        echo $total . ' ';
                        ?>
                        €
                    </p>
                </div>
            </div>
            <form action="<?= site_url('Produits/cart') ?>" method="post">
                <div class="row">
                    <div class="col s12 center-align">
                        <input type="submit" id="validCart" class="waves-effect waves-light btn" value="Commander">
                    </div>
                </div>
            </form>
            <?php
        }
        else
        {
            ?>
            <div class="row">
                <div class="col s12 center-align">
                    <p class="cart_warning">Ton panier est vide. ACHETE !!! VITE !!!</p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<script src="<?= base_url('/assets/js/ajax_full_cart.js') ?>"></script>
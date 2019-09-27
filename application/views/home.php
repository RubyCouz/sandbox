<div class="container">
    <div class="row">
        <div class="col s12 center-align">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Bienvenue au SandBox !!!</span>
                    <p>
                        En tant que simple visiteur vous aurez accès à une simple vue visiteur (catalogue).
                    </p>
                    <p>
                        Vous avez la possibilité de vous inscrire, et ainsi passer sur une vue client, avec l'ajout d'un panier
                    </p>
                    <p>
                        Enfin si vous voulez avoir un apperçu d'une vue administrateur, vous pouvez vous connecter avec les identifiants suivants:
                    </p>
                    <ul>
                        <li>Login : admin</li>
                        <li>MDP : admin</li>
                    </ul>

                </div>
                <div class="card-action">
                    <a href="<?= site_url('Produits/home_user') ?>">Visiter la SandBox</a>
                    <a href="<?= site_url('Client/signin_form') ?>">S'inscrire à la SandBox</a>
                    <a href="<?= site_url('Client/log_user') ?>">Se Connecter à la SandBox</a>
                </div>
            </div>
        </div>
    </div>
</div>


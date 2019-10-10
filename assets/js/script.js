
var str = location.pathname;
var url = str.split('/');
url = '/' + url[1] + '/' + url[2] + '/';
$(document).ready(function () {
// -------------------------------------------------------------------------
// js fonctionnement du site
// -------------------------------------------------------------------------

// Navbar
    $('.sidenav').sidenav();
    // effet sur la navbar et sur la barre des tabs (transparentes => opaques)
    $(window).scroll(function () {
        if ($(window).scrollTop() > 50) {
            $('nav').css('background', 'rgb(226, 155, 31)');
        } else {
            $('nav').css('background', 'rgba(0,0,0,0.2)');
        }
    });
    // collapsible
    $('.collapsible').collapsible();
    // tabs
    $('.tabs').tabs();
    //Dropdown
    $('.dropdown-trigger').dropdown({
        hover: true,
        inDuration: 450,
        outDuration: 450,
        constrainWidth: false,
        alignment: 'left',
        coverTrigger: false,
        closeOnClick: false
    });
// material box
    $('.materialboxed').materialbox();
    //modal
    $('.modal').modal();
// select
    $('select').formSelect();




    /**
     * Vérification formulaire inscription AJAX
     */

    var namePattern = /^[a-zA-Z\-éèêëàâäùüûôöîï]+$/;
    var mailPattern = /^[a-zA-Z0-9.!#$%&’*?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var passwordPattern = /^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/;
    var loginPattern = /^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/;

    // champs login => vérification de la présence du pseud dans la bdd
    $('#login').keyup(function () { //  sélecction du champs login et définition de l'évènement
        var login = $(this).val(); // récupération de la valeur du champs login
        $.post(url + 'Client/if_client_exists', {// envoie des données récupérées vers le contrôleur en post
            login_user: login // définition des données à anvoiyées
        }, function (data) {
            if (data) { // si présence d'une réponse du contrôleur
                $('#missingLog').html(data); // affichage d'un message
                $('#login').addClass('invalid');
                $('#login').removeClass('valid');
            } else {
                $('#missingLog').html(''); // on efface le message
                $('#login').addClass('valid');
                $('#login').removeClass('invalid');
            }
        },
                'HTML'); // type de données transmise
    });
// champs prénom
    $('#firstname').keyup(function () {
        var firstname = $(this).val();
        if (firstname === '') {
            $('#missingFirstname').html('Le champs "Prénom" n\'est pas renseigné');
            $('#firstname').addClass('invalid');
            $('#firstname').removeClass('valid');
        } else if (namePattern.test(firstname) === false) {
            $('#missingFirstname').html('Le champs "Prénom" n\'est pas valide');
            $('#firstname').addClass('invalid');
            $('#firstname').removeClass('valid');
        } else {
            $('#missingFirstname').html('');
            $('#firstname').addClass('valid');
            $('#firstname').removeClass('invalid');
        }
    });
    // champs nom
    $('#lastname').keyup(function () {
        var lastname = $(this).val();
        if (lastname === '') {
            $('#missingLastname').html('Le champs "Nom" n\'est pas renseigné');
            $('#lastname').addClass('invalid');
            $('#lastname').removeClass('valid');
        } else if (namePattern.test(lastname) === false) {
            $('#missingLastname').html('Le champs "Nom" n\'est pas valide');
            $('#lastname').addClass('invalid');
            $('#lastname').removeClass('valid');
        } else {
            $('#missingLastname').html('');
            $('#lastname').addClass('valid');
            $('#lastname').removeClass('invalid');
        }
    });
    // champs mail
    $('#mail').keyup(function () {
        var mail = $(this).val();
        if (mail === '') {
            $('#missingMail').html('Le champs "Email" n\'est pas renseigné');
            $('#mail').addClass('invalid');
            $('#mail').removeClass('valid');
        } else if (mailPattern.test(mail) === false) {
            $('#missingMail').html('Le champs "Email" n\'est pas valide');
            $('#mail').addClass('invalid');
            $('#mail').removeClass('valid');
        } else {
            $('#missingMail').html('');
            $('#mail').addClass('valid');
            $('#mail').removeClass('invalid');
        }
    });
    // champs mot de passe
    $('#password1').keyup(function () {
        var password = $(this).val();
        var passwordVerif = $('#passwordVerif').val();
        console.log('mdp : ' + password);
        if (password === '') {
            $('#missingPassword1').html('Le champs "Mot de passe" n\'est pas renseigné');
            $('#password1').addClass('invalid');
            $('#password1').removeClass('valid');
        } else if (passwordPattern.test(password) === false) {
            $('#missingPassword1').html('Le champs "Mot de passe" n\'est pas valide');
            $('#password1').addClass('invalid');
            $('#password1').removeClass('valid');
        } else {
            $('#missingPassword1').html('');
            $('#password1').addClass('valid');
            $('#password1').removeClass('invalid');
        }
        if (password !== passwordVerif) {
            $('#errorPassword').html('Les mots de passe doivent être identiques');
            $('#passwordVerif').addClass('invalid');
            $('#passwordVerif').removeClass('valid');
        }
    });

    // champs vérification mdp
    $('#passwordVerif').keyup(function () {
        var passwordVerif = $(this).val();
        var password = $('#password1').val();
        console.log('mdp verif :' + passwordVerif);
        if (passwordVerif === '') {
            $('#missingPasswordVerif').html('Le champs "Vérification du mot de passe" n\'est pas renseigné');
            $('#passwordVerif').addClass('invalid');
            $('#passwordVerif').removeClass('valid');
        } else if (passwordPattern.test(passwordVerif) === false) {
            $('#missingPasswordVerif').html('Le champs "Vérification du mot de passe" n\'est pas valide');
            $('#passwordVerif').addClass('invalid');
            $('#passwordVerif').removeClass('valid');
        } else {
            $('#missingPasswordVerif').html('');
            $('#passwordVerif').addClass('valid');
            $('#passwordVerif').removeClass('invalid');
        }
        // vérification égalité des mots de passe
        if (password !== passwordVerif) {
            $('#errorPassword').html('Les mots de passe doivent être identiques');
            $('#passwordVerif').addClass('invalid');
            $('#passwordVerif').removeClass('valid');
        } else {
            $('#errorPassword').html('');
            $('#passwordVerif').addClass('valid');
            $('#passwordVerif').removeClass('invalid');
        }

    });

    // champs login connexion
    $('#login_user').keyup(function () {
        var login_user = $(this).val();
        if (login_user === '') {
            $('#missingLogin').html('Le champs "Pseudo" n\'est pas renseigné');
            $('#login_user').addClass('invalid');
            $('#login_user').removeClass('valid');
        } else if (loginPattern.test(login_user) === false) {
            $('#missingLogin').html('Le champs "Pseudo" n\'est pas valide');
            $('#login_user').addClass('invalid');
            $('#login_user').removeClass('valid');
        } else {
            $('#missingLogin').html('');
            $('#login_user').addClass('valid');
            $('#login_user').removeClass('invalid');
        }
    });

    /**
     * Vérification du formulaire jarditou ajout produit
     */
    var textValid = /^[a-zA-Z\-\déèàçùëüïô äâêûîô#&]+$/;
    var numberValid = /^[\d]*[.]?[\d]{1,2}$/;
    var picValid = /^[a-z0-9\_\-]*[.]((jpeg)|(png)|(jpg)|(gif))$/;
    $('#addRef').keyup(function () {
        if ($('#addRef').val() == '') {
            $('#addRef').removeClass('invalid');
            $('#addRef').addClass('invalid');
            $('#errorRef').html('Saisie manquante');

        } else if (textValid.test($('#addRef').val()) == false) {
            $('#addRef').removeClass('valid');
            $('#addRef').addClass('invalid');
            $('#errorRef').html('Saisie incorrect');
        } else {
            $('#addRef').removeClass('invalid');
            $('#addRef').addClass('valid');
            $('#errorRef').html('');
        }
    });
    $('#addLabel').keyup(function () {
        if ($('#addLabel').val() == '') {
            $('#addLabel').removeClass('invalid');
            $('#addLabel').addClass('invalid');
            $('#errorLabel').html('Saisie manquante');

        } else if (textValid.test($('#addLabel').val()) == false) {
            $('#addLabel').removeClass('valid');
            $('#addLabel').addClass('invalid');
            $('#errorLabel').html('Saisie incorrect');
        } else {
            $('#addLabel').removeClass('invalid');
            $('#addLabel').addClass('valid');
            $('#errorLabel').html('');
        }
    });
    $('#addColor').keyup(function () {
        if ($('#addColor').val() == '') {
            $('#addColor').removeClass('invalid');
            $('#addColor').addClass('invalid');
            $('#errorColor').html('Saisie manquante');

        } else if (textValid.test($('#addColor').val()) == false) {
            $('#addColor').removeClass('valid');
            $('#addColor').addClass('invalid');
            $('#errorColor').html('Saisie incorrect');
        } else {
            $('#addColor').removeClass('invalid');
            $('#addColor').addClass('valid');
            $('#errorColor').html('');
        }
    });
    $('#addStock').keyup(function () {
        if ($('#addStock').val() == '') {
            $('#addStock').removeClass('invalid');
            $('#addStock').addClass('invalid');
            $('#errorStock').html('Saisie manquante');

        } else if (numberValid.test($('#addStock').val()) == false) {
            $('#addStock').removeClass('valid');
            $('#addStock').addClass('invalid');
            $('#errorStock').html('Saisie incorrect');
        } else {
            $('#addStock').removeClass('invalid');
            $('#addStock').addClass('valid');
            $('#errorStock').html('');
        }
    });
    $('#addPrice').keyup(function () {
        if ($('#addPprice').val() == '') {
            $('#addPprice').removeClass('invalid');
            $('#addPprice').addClass('invalid');
            $('#errorPrice').html('Saisie manquante');

        } else if (numberValid.test($('#addPprice').val()) == false) {
            $('#addPprice').removeClass('valid');
            $('#addPprice').addClass('invalid');
            $('#errorPrice').html('Saisie incorrect');
        } else {
            $('#addPprice').removeClass('invalid');
            $('#addPprice').addClass('valid');
            $('#errorPrice').html('');
        }
    });
    $('#description').keyup(function () {
        if ($('#description').val() == '') {
            $('#description').removeClass('invalid');
            $('#description').addClass('invalid');
            $('#errorDesc').html('Saisie manquante');

        } else if (textValid.test($('#description').val()) == false) {
            $('#description').removeClass('valid');
            $('#description').addClass('invalid');
            $('#errorDesc').html('Saisie incorrect');
        } else {
            $('#description').removeClass('invalid');
            $('#description').addClass('valid');
            $('#errorDesc').html('');
        }
    });

    $('#addFile').change(function () {
        if ($('#addFile').val() == '') {
            $('#addFile').removeClass('invalid');
            $('#addFile').addClass('invalid');
            $('#errorFile').html('Fichier  manquant');
        } else if (picValid.test($('#addFile').val()) == false) {
            $('#addFile').removeClass('valid');
            $('#addFile').addClass('invalid');
            $('#errorFile').html('Mauvais format de fichier');
        } else {
            $('#addFile').removeClass('invalid');
            $('#addFile').addClass('valid');
            $('#errorFile').html('');
        }
    });
    
    $('#addDescription').change(function () {
        if ($('#addDescription').val() == '') {
            $('#addDescription').removeClass('invalid');
            $('#addDescription').addClass('invalid');
            $('#errorDesc').html('DEscription manquante');
        } else if (textValid.test($('#addDescription').val()) == false) {
            $('#addDescription').removeClass('valid');
            $('#addDescription').addClass('invalid');
            $('#errorDesc').html('Description non valide');
        } else {
            $('#addDescription').removeClass('invalid');
            $('#addDescription').addClass('valid');
            $('#errorDesc').html('');
        }
    });

    /**
     * Ajax ajout produit panier 
     */

    $('.addProduct').click(function () {
        var pro_id = $(this).val();
        var pro_qte = $('#pro_qte' + pro_id).val();
        var pro_prix = $('#pro_prix' + pro_id).val();
        var pro_libelle = $('#pro_libelle' + pro_id).val();
        console.log('id : ' + pro_id);
        console.log('qte : ' + pro_qte);
        console.log('prix : ' + pro_prix);
        console.log('libelle : ' + pro_libelle);
        $.post(url + 'Produits/add_product_in_cart', {// envoie des données récupérées vers le contrôleur en post
            pro_qte: pro_qte, // définition des données à envoyées
            pro_prix: pro_prix,
            pro_id: pro_id,
            pro_libelle: pro_libelle
        }, function (data) {
            if (data) { // si présence d'une réponse du contrôleur
                $('#dropdown_cart').html(data);
            } else {
                alert('nope');
            }
        },
                'HTML'); // type de données transmise
    });

});
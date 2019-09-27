
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
            $('nav').css('background', 'rgb(16, 165, 48)');
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
        coverTrigger: false
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

    // champs login
    $('#login').keyup(function () { //  sélecction du champs login et définition de l'évènement
        var login = $(this).val(); // récupération de la valeur du champs login
        $.post(url + 'Client/if_client_exists', {// envoie des données récupérées vers le contrôleur en post
            login_user: login // définition des données à anvoiyées
        }, function (data) {
            if (data) { // si présence d'une réponse du contrôleur
                $('#missingLogin').html(data); // affichage d'un message
                $('#login').addClass('invalid');
                $('#login').removeClass('valid');
            } else {
                $('#missingLogin').html(''); // on efface le message
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
    $('#password').keyup(function () {
        var password = $(this).val();
        var passwordVerif = $('#passwordVerif').val();
        if (password === '') {
            $('#missingPassword').html('Le champs "Mot de passe" n\'est pas renseigné');
            $('#password').addClass('invalid');
            $('#password').removeClass('valid');
        } else if (passwordPattern.test(password) === false) {
            $('#missingPassword').html('Le champs "Mot de passe" n\'est pas valide');
            $('#password').addClass('invalid');
            $('#password').removeClass('valid');
        } else {
            $('#missingPassword').html('');
            $('#password').addClass('valid');
            $('#password').removeClass('invalid');
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
        var password = $('#password').val();
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
    $('#ref').blur(function () {
        if ($('#ref').val() == '') {
            $('#ref').removeClass('invalid');
            $('#ref').addClass('invalid');
            $('#errorRef').html('Saisie manquante');

        } else if (textValid.test($('#ref').val()) == false) {
            $('#ref').removeClass('valid');
            $('#ref').addClass('invalid');
            $('#errorRef').html('Saisie incorrect');
        } else {
            $('#ref').removeClass('invalid');
            $('#ref').addClass('valid');
            $('#errorRef').html('');
        }
    });
    $('#label').blur(function () {
        if ($('#label').val() == '') {
            $('#label').removeClass('invalid');
            $('#label').addClass('invalid');
            $('#errorLabel').html('Saisie manquante');

        } else if (textValid.test($('#label').val()) == false) {
            $('#label').removeClass('valid');
            $('#label').addClass('invalid');
            $('#errorLabel').html('Saisie incorrect');
        } else {
            $('#label').removeClass('invalid');
            $('#label').addClass('valid');
            $('#errorLabel').html('');
        }
    });
    $('#color').blur(function () {
        if ($('#color').val() == '') {
            $('#color').removeClass('invalid');
            $('#color').addClass('invalid');
            $('#errorColor').html('Saisie manquante');

        } else if (textValid.test($('#color').val()) == false) {
            $('#color').removeClass('valid');
            $('#color').addClass('invalid');
            $('#errorColor').html('Saisie incorrect');
        } else {
            $('#color').removeClass('invalid');
            $('#color').addClass('valid');
            $('#errorColor').html('');
        }
    });
    $('#stock').blur(function () {
        if ($('#stock').val() == '') {
            $('#stock').removeClass('invalid');
            $('#stock').addClass('invalid');
            $('#errorStock').html('Saisie manquante');

        } else if (numberValid.test($('#stock').val()) == false) {
            $('#stock').removeClass('valid');
            $('#stock').addClass('invalid');
            $('#errorStock').html('Saisie incorrect');
        } else {
            $('#stock').removeClass('invalid');
            $('#stock').addClass('valid');
            $('#errorStock').html('');
        }
    });
    $('#price').blur(function () {
        if ($('#price').val() == '') {
            $('#price').removeClass('invalid');
            $('#price').addClass('invalid');
            $('#errorPrice').html('Saisie manquante');

        } else if (numberValid.test($('#price').val()) == false) {
            $('#price').removeClass('valid');
            $('#price').addClass('invalid');
            $('#errorPrice').html('Saisie incorrect');
        } else {
            $('#price').removeClass('invalid');
            $('#price').addClass('valid');
            $('#errorPrice').html('');
        }
    });
    $('#description').blur(function () {
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
    if ($('#file').val() == '') {
        $('#file').removeClass('invalid');
        $('#descrifileption').addClass('valid');
        $('#errorDesc').html('');
    }


    $('#file').change(function () {
        if ($('#file').val() == '') {
            $('#file').removeClass('invalid');
            $('#file').addClass('invalid');
            $('#errorFile').html('Fichier  manquant');
        } else if (picValid.test($('#file').val()) == false) {
            $('#file').removeClass('valid');
            $('#file').addClass('invalid');
            $('#errorFile').html('Mauvais format de fichier');
        } else {
            $('#file').removeClass('invalid');
            $('#file').addClass('valid');
            $('#errorFile').html('');
        }
    });
}
);
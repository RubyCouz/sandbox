var str = location.pathname;
var url = str.split('/');
url = '/' + url[1] + '/' + url[2] + '/';
$(document).ready(function () {
    /**
     * AJAX suppression d'un produit du panier
     */

    $('.del').click(function () {
        var del = $(this).val();
        $.post(url + 'Produits/del_product_in_cart', {
            del: del
        }, function (data) {
            if (data) {
                $('#dropdown_cart').html(data);
            } else {
                alert('NOOOOOOOOOOOOOOON !!!!!!!!!');
            }
        });
    });
    /**
     * incrémentation produit panier
     */
    $('.add').click(function () {
        var add = $(this).val();
        $.post(url + 'Produits/increase_product', {
            add: add
        }, function (data) {
            if (data) {
                $('#dropdown_cart').html(data);
            } else {
                alert('NOOOOOOOOOOOOOOON !!!!!!!!!');
            }
        });
    });
    
    /**
     * décrémentation produit panier
     */
    $('.remove').click(function () {
        var remove = $(this).val();
        var id = $('#id').val;
        $.post(url + 'Produits/decrease_product', {
            remove: remove
        }, function (data) {
            if (data) {
                $('#dropdown_cart').html(data);
            } else {
                alert('NOOOOOOOOOOOOOOON !!!!!!!!!');
            }
        });
    });
    
});


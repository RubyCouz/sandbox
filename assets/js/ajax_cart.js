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
});
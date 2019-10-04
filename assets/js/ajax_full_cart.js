var str = location.pathname;
var url = str.split('/');
url = '/' + url[1] + '/' + url[2] + '/';
$(document).ready(function () {

    /**
     * AJAX suppresion d'un produit du panier
     */
    $('.delProd').click(function () {
        var del = $(this).val();
        $.post(url + 'Produits/del_product_in_full_cart', {
            del: del
        }, function (data) {
            if (data) {
                $('#cart').html(data);
            } else {
alert('NOOOOOOOOOOOOOOON !!!!!!!!!');
            }
        });
    });
});
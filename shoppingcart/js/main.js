/**
* Eventhandler for buy buttons
*/

$(document).ready(function () {
    'use strict';
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    // Fill the shop with items
    if (sPage === 'shop-frontpage.php') {
        $(this).addShop();
    }

    if (sPage === 'checkout-page.php') {
        $(this).gotoCheckout();
    }
});

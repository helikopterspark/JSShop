# JSShop
jQuery plugin and PHP/CSS code for a simple web shop template

This jQuery plugin and the accompanying PHP files can be used as the basis for a simple web shop.

## Usage
Include the file jquery.jsshop.js and call the functions like this from your main.js file:

```
if (sPage === 'shop-frontpage.php') {
    $(this).addShop();
}
if (sPage === 'checkout-page.php') {
    $(this).gotoCheckout();
}
```

### Dependencies
* jQuery - put jquery.js in the js folder

* modernizr - put modernizr.js in the js folder

* [CForm](https://github.com/mosbth/cform/), a PHP class for creating, rendering and validating HTML forms. put cform-master in the shoppingcart folder.

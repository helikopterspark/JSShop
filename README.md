# JSShop
jQuery plugin and PHP/CSS code for a simple web shop template. Developed a part of JavaScript course DV1483 at Blekinge Tekniska Högskola.

This jQuery plugin and the accompanying PHP files can be used as the basis for a simple web shop.

See a working demo [here](http://www.student.bth.se/~carb14/javascript/kmom04/JSShop/shoppingcart/shop-frontpage.php)

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

* [CForm](https://github.com/mosbth/cform/), a PHP class for creating, rendering and validating HTML forms. put the cform-master folder (with contents) in the shoppingcart folder.

<!doctype html>
<html lang='en' class='no-js'>
<head>
    <meta charset='utf-8' />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js/modernizr.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.jsshop.js"></script>
    <title>A shopping cart using jQuery and Ajax</title>
</head>
<body>
    <div id="shop-container">
        <h1 class="heading1">The JS Shop</h1>
        <div id="shopping-cart">
            <h2>&#x1f6cd; Shopping cart</h2>
            <div id="cart-content">

            </div>
            <p>
                Items in cart: <span id="cart-quantity">0</span><br />
                Total: <span id="cart-sum">0</span><br />
            </p>
            <form>
                <input id="cart-clear" type="button" name="clear" value="Clear" />
                <input id="cart-checkout" type="button" name="checkout" value="Checkout" />
                <output id="cart-message"></output>
            </form>
        </div>
        <div id="shop-items-container">
            <table id="shop-items">
                <thead>
                    <tr>
                        <th>Image</th><th>Title</th><th>Price</th><th>Buy it</th>
                    </tr>
                </thead>
                <tbody id="shop-items-tbody">
                    <!-- Shop items are listed here -->
                </tbody>
            </table>
        </div>
    </div>
    <footer id='footer'>
    </footer>
</body>
</html>

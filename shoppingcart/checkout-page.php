<?php include('cc_form.php'); ?>
<!doctype html>
<html lang='en' class='no-js'>
<head>
    <meta charset='utf-8' />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.jsshop.js"></script>
    <title>A shopping cart using jQuery and Ajax</title>
</head>
<body>
    <div id="checkout-container">
        <h1>Checkout</h1>
        <p>
            <a href="shop-frontpage.php">&#8592; Back to shopping page</a>
        </p>
        <p id="sum-info" class="info">
            Your credit card will be charged: <span id="checkout-sum"></span>
        </p>
        <div id="payment-message"></div>
        <div id="cc-form">
            <?=$form->GetHTML(array('id' => 'form1', 'columns' => 2))?>
        </div>
    </div>
    <footer id='footer'>
    </footer>
</body>
</html>

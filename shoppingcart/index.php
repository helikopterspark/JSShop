<?php $title='A shopping cart using jQuery and Ajax'; include(__DIR__ . '/../template/header.php'); ?>

<div id='flash'>
    <h1>The JS Bookshop</h1>
    <div id="shopping-cart">
        <h2><img src="../img/icon-1001596_640.png" alt="cart" />Shopping cart</h2>
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

<?php $path=__DIR__; include(__DIR__ . '/../template/footer.php'); ?>

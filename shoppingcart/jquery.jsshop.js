/**
* Eventhandler for buy buttons
*/

(function($) {
    $.fn.addShop = function() {
        // Fill the shop with items
        $.ajax({
            type: 'get',
            url: 'shop.php',
            dataType: 'json',
            success: function(data) {
                var item, row, cell, img, buybutton;
                for (item in data.items) {
                    row = $('<tr></tr>');
                    $.each(data.items[item], function(key, val) {
                        switch (key) {
                            case 'id':
                            buybutton = $('<form></form>').append('<input id="' + val + '" class="buybutton" type="button" name="buy" value="Buy it" />')
                            break;
                            case 'image':
                            img = $('<img>').attr('src', val).attr('alt', data.items[item].title).addClass('item-image');
                            cell = $('<td></td>').append(img);
                            row.append(cell);
                            break;
                            case 'price':
                            cell = $('<td></td>').text(data.currency + val);
                            row.append(cell);
                            break;
                            default:
                            cell = $('<td></td>').text(val);
                            row.append(cell);
                            break;
                        }
                    })
                    cell = $('<td></td>').append(buybutton);
                    row.append(cell);
                    $('#shop-items-tbody').append(row);
                }
                $('#cart-content').removeClass().html(data.output);
                $('#cart-quantity').text(data.quantity);
                $('#cart-sum').text(data.currency + data.sum);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
            }
        });

        // Click on buy buttons, works with dynamically created buttons
        $(document).on('click', '.buybutton', function(event) {
            $.ajax({
                type: 'post',
                url: 'shop.php?do=buy',
                data: {id: $(this).attr('id')},
                dataType: 'json',
                success: function(data) {
                    $('#cart-content').removeClass().html(data.output).hide().fadeIn();
                    $('#cart-quantity').text(data.quantity);
                    $('#cart-sum').text(data.currency + data.sum);
                    $('#cart-message').clearQueue().stop().text('Cart updated').fadeIn('fast').fadeOut(3000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        });

        // Clear cart button
        $('#cart-clear').on('click', function(event) {
            $.ajax({
                type: 'get',
                url: 'shop.php?do=clear',
                data: null,
                dataType: 'json',
                success: function(data) {
                    $('#cart-content').removeClass().html(data.output);
                    $('#cart-quantity').text(data.quantity);
                    $('#cart-sum').text(data.currency + data.sum);
                    $('#cart-message').clearQueue().stop().text('Cart cleared').fadeIn('fast').fadeOut(3000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        });

        // Go to checkout
        $(document).on('click', '#cart-checkout', function() {
            window.location.href = 'checkout';
        });
    }

    $.fn.gotoCheckout = function() {

        $.ajax({
            type: 'post',
            url: 'checkout2.php',
            dataType: 'json',
            success: function(data) {
                $('#checkout-sum').text(data.currency + data.sum);
                console.log('Cart sum successfully retrieved');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                console.log(jqXHR);
            }
        });

        $('#form1').on('submit', function(event) {
            event.preventDefault();
            $('#payment-message').removeClass().addClass('info').html('<p>Processing payment, please wait and do NOT reload this page.</p>');

            $.ajax({
                type: 'post',
                url: 'checkout2.php?do=pay',
                data: $('#form1').serialize(),
                dataType: 'json',
                success: function(data) {
                    var errors = '';
                    $('#checkout-sum').text(data.currency + data.sum);

                    $.each(data.errors || [], function(index, error) {
                        errors += '<p>' + error.label + ' ' + error.message + '</p>';
                    });
                    $('#payment-message').html('<p>' + data.output + '</p>' + errors).removeClass().addClass(data.outputClass);
                    if (data.outputClass === 'success') {
                        $('#form1').hide();
                        $('#sum-info').hide();
                    }
                    console.log(data.output);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Ajax request failed: ' + textStatus + ', ' + errorThrown);
                }
            });
        });
    }
})(jQuery);

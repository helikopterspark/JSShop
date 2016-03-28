/**
* Eventhandler for buy buttons
*/

$(document).ready(function () {
    'use strict';
    // Fill the shop with items
    $.getJSON("shop.php", function(result) {
        var item, row, cell, img, buybutton;
        for (item in result.items) {
            row = $('<tr></tr>');
            $.each(result.items[item], function(key, val) {
                switch (key) {
                    case 'id':
                    buybutton = $('<form></form>').append('<input id="' + val + '" class="buybutton" type="button" name="buy" value="Buy it" />')
                    break;
                    case 'image':
                    img = $('<img>').attr('src', val).attr('alt', result.items[item].title).addClass('item-image');
                    cell = $('<td></td>').append(img);
                    row.append(cell);
                    break;
                    case 'price':
                    cell = $('<td></td>').text(result.currency + val);
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
        $('#cart-content').removeClass().html(result.output);
        $('#cart-quantity').text(result.quantity);
        $('#cart-sum').text(result.currency + result.sum);
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
    $('#cart-checkout').click(function() {
        window.location.href = '../checkout/index.php';
    });
});

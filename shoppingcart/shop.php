<?php
// Create the session
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();

$currency = '€';
$cart = null;
$cartcontent = null;
$table = '<table><thead><tr><th>Item</th><th>Quantity</th><th>Sum</th></tr></thead><tbody>';

// Shop content, could be fetched from database
$items = [
    'item1' => ['id' => "1", 'image' => "../img/classic_red_book_cover_by_semireal_stock.jpg", 'title' => "JavaScript The Definitive Guide", 'price' => 17],
    'item2' => ['id' => "2", 'image' => "../img/classic_red_book_cover_by_semireal_stock.jpg", 'title' => "JavaScript The Good Parts", 'price' => 19],
    'item3' => ['id' => "3", 'image' => "../img/classic_red_book_cover_by_semireal_stock.jpg", 'title' => "jQuery Novice to Ninja", 'price' => 23],
    'item4' => ['id' => "4", 'image' => "../img/classic_red_book_cover_by_semireal_stock.jpg", 'title' => 'Pro HTML5 Programming', 'price' => 45]
];

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = ['sum' => 0, 'quantity' => 0, 'currency' => $currency, 'items' => [], 'content' => $table."<tr><td></td><td>Cart is empty</td><td></td></tr></tbody></table>"];
}

// Get incoming on what to do
$do = isset($_GET['do']) ? $_GET['do'] : null;

switch ($do) {
    // buy something
    case 'buy':
    $id = $_POST['id'];
    foreach ($items as $item) {
        if (in_array($id, $item)) {
            $cart['sum'] += $item['price'];
            $cart['quantity'] += 1;

            if (in_array_r($id, $cart['items'])) {
                for ($i=0; $i < count($cart['items']); $i++) {
                    if ($cart['items'][$i]['id'] === $id) {
                        $cart['items'][$i]['quantity'] += 1;
                        $cart['items'][$i]['sum'] += $item['price'];
                    }
                }
            } else {
                $cart['items'][] = ['id' => $id, 'quantity' => 1, 'sum' => $item['price'], 'title' => $item['title']];
            }
        }
    }

    foreach ($cart['items'] as $value) {
        $cartcontent .= '<tr>
        <td>'.$value['title'].'</td>
        <td>'.$value['quantity'].'</td>
        <td>'.$currency.$value['sum'].'</td>
        </tr>';
    }
    $cart['content'] = $table . $cartcontent . '</tbody></table>';
    $_SESSION['cart'] = $cart;

    header('Content-type: application/json');
    echo json_encode(array("output" => $cart['content'], "quantity" => $cart['quantity'], "sum" => $cart['sum'], "currency" => $cart['currency']));
    break;

    // clear cart from content
    case 'clear':
    $table .= "<tr><td></td><td>Cart is empty</td><td></td></tr></tbody></table>";
    unset($_SESSION['cart']);
    header('Content-type: application/json');
    echo json_encode(array("output" => $table, "quantity" => 0, "sum" => 0, "currency" => $currency));
    break;

    // load page
    default:
    header('Content-type: application/json');
    echo json_encode(array("items" => $items, "output" => $cart['content'], "quantity" => $cart['quantity'], "sum" => $cart['sum'], "currency" => $cart['currency']));
    break;
}

// Search multidimensional array
function in_array_r($item , $array){
    return preg_match('/"'.$item.'"/i' , json_encode($array));
}

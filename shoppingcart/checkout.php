<?php
// Create the session
error_reporting(-1);
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();

$do = isset($_GET['do']) ? $_GET['do'] : null;

switch ($do) {
    case 'pay':

    include('cc_form.php');
    $_POST['pay'] = true;

    $sum = $_SESSION['cart']['sum'];
    $currency = $_SESSION['cart']['currency'];
    $output = "The form is not submitted.";
    $outputClass = 'error';
    $errors = null;
    $status = $form->Check();
    if ($status === true) {
        $charge = $currency . $sum;
        $sum = 0;
        unset($_SESSION['cart']);
        $output = "The payment transaction was successful. Your credit card was charged " . $charge . ".";
        $outputClass = 'success';
    } elseif ($status === false) {
        $output = "The form contains errors.";
        $errors = $form->GetValidationErrors();
    }
    header('Content-type: application/json');
    echo json_encode(array("output" => $output, "outputClass" => $outputClass, "errors" => $errors, "sum" => $sum, "currency" => $currency));
    break;

    default:
    header('Content-type: application/json');
    echo json_encode( ( isset($_SESSION['cart']) ? array("sum" => $_SESSION['cart']['sum'], "currency" => $_SESSION['cart']['currency']) : array('sum'=>0, 'currency' => null) ) );
    break;
}

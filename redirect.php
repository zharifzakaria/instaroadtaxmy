<?php

require 'lib/API.php';
require 'lib/Connect.php';
require 'configuration.php';

include(ABS_PATH . '/connection/index.php'); //prod

use Billplz\Minisite\API;
use Billplz\Minisite\Connect;

$data = Connect::getXSignature($x_signature, 'bill_redirect');
$connect = new Connect($api_key);
$connect->setStaging($is_sandbox);
$billplz = new API($connect);
list($rheader, $rbody) = $billplz->toArray($billplz->getBill($data['id']));

if ($rbody['paid']) {
    /***********************************************/
    // Include tracking code here
    // Do something here if payment has been made
    /***********************************************/
    //get form data
    $bill_id = $rbody['id'];
    $collection_id = $rbody['collection_id'];
    $state = $rbody['state'];
    $amount = (float) $rbody['amount'] / 100;
    $due_at = $rbody['due_at'];
    $email = $rbody['email'];
    $phone_number = $rbody['mobile'];
    $vkey = $rbody['reference_2'];
    $name = $rbody['name'];
    $bill_url = $rbody['url'];
    $paid_at = $rbody['paid_at'];

    $bill_id = $mysqli->real_escape_string($bill_id);
    $collection_id = $mysqli->real_escape_string($collection_id);
    $state = $mysqli->real_escape_string($state);
    $amount = $mysqli->real_escape_string($amount);
    $due_at = $mysqli->real_escape_string($due_at);
    $email = $mysqli->real_escape_string($email);
    $phone_number = $mysqli->real_escape_string($phone_number);
    $vkey = $mysqli->real_escape_string($vkey);
    $name = $mysqli->real_escape_string($name);
    $bill_url = $mysqli->real_escape_string($bill_url);
    $paid_at = $mysqli->real_escape_string($paid_at);

    $insert = $mysqli->query("INSERT into paid_orders(bill_id, collection_id, status,amount, due_at, email, phone_number, vkey, name, bill_url, transaction_date ) VALUES ('$bill_id', '$collection_id', '$state', '$amount', '$due_at', '$email', '$phone_number', '$vkey', '$name', '$bill_url', '$paid_at')");
    $setOrderCreated = $mysqli->query('UPDATE `users` SET `status`= 3 WHERE `vkey` ="' . $rbody['reference_2'] . '"');

    if (!empty($successpath)) {
        header('Location: ' . $successpath . "?ref=" . $rbody['reference_2']);
    } else {
        header('Location: ' . $rbody['url']);
    }
} else {
    /*Do something here if payment has not been made*/
    header('Location: ' . $rbody['url']);
}

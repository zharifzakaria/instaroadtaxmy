<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod

if (isset($_POST['newInsuredAmount'])) {
    $newInsuredAmount = $mysqli->real_escape_string($_POST['newInsuredAmount']);
    $updateInsured = $mysqli->query('UPDATE `users` SET `status`= 2, `newSumInsured`='.$newInsuredAmount .' WHERE `vkey` ="' . $_POST['vkey'] . '"');

    if($updateInsured) {
        header('location: ../thankyou.php');
    } else header('location: rejected.php');

    // header('location: success.php');
}

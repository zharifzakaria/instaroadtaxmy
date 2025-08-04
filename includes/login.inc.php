<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../config.php'); //prod
include(ABS_PATH .'/connection/phpdotenv.php'); //prod

// Debug line removed for security
if ($_POST['pwd'] == $_ENV['ADMIN_PASSWORD'] && $_POST['emel'] == $_ENV['ADMIN_EMAIL']) {
    session_start();
    $_SESSION['email'] = $_ENV['ADMIN_EMAIL'];
    header('Location: ../admin');
} else header('Location: ../login');

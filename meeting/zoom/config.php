<?php
require_once 'vendor/autoload.php';
require_once "class-db.php";

if (!isset($_SESSION['id'])) {
    header("location:../../login/login.php");
    exit;
}

$company_id = $_SESSION['company_id'];

$db            = new DB();
$apiCredential = $db->getZoomApiCridential($company_id);

define('CLIENT_ID', $apiCredential['client_id']);
define('CLIENT_SECRET', $apiCredential['client_secret']);
define('REDIRECT_URI', $apiCredential['redirect_url']);
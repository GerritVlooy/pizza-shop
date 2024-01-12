<?php
// geenAccountController.php
declare(strict_types = 1);
require_once("bootstrap.php");

if(isset($_SESSION['login'])) {
    header('Location: index.php');
    die();
}

$checkbox = true;
$doorsturen = true;
require_once("registrerenController.php");
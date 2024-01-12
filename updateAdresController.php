<?php
// updateAdresController.php
declare(strict_types = 1);
require_once("bootstrap.php");
use App\Entities\Klant;

if(!isset($_SESSION['klant'])) {
    header("Location: homecontroller.php");
    die();
}

$updateGegevens = false;
$klantGegevens = unserialize($_SESSION['klant']);
$email = $klantGegevens->getEmail();
require_once("registrerenController.php");


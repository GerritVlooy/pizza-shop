<?php
// afrekenenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
require_once("winkelwagenController.php");

if(!isset($_SESSION['winkelwagen']) || empty($_SESSION['winkelwagen'])){
    header("Location: homecontroller.php");
    die();
}

if(!isset($_SESSION['klantId'])) {
    header("Location: optieController.php");
    die();
}

$title = "Afrekenen";
$view = "App/Presentation/afrekenen/index.php";
$winkelwagen = "App/Presentation/winkelwagen/index.php";

require_once "App/Presentation/template.php";

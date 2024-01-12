<?php
// afrekenenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
require_once("winkelwagenController.php");
use App\Entities\Klant;
use App\Entities\Adres;
use App\Entities\Woonplaats;

if(!isset($_SESSION['winkelwagen']) || empty($_SESSION['winkelwagen'])) {
    header("Location: homecontroller.php");
    die();
}

if(!isset($_SESSION['klant'])) {
    header("Location: optieController.php");
    die();
}

if(!isset($_SESSION['opmerkingen'])) {
    $_SESSION['opmerkingen'] = "";
}
$title = "Afrekenen";
$view = "App/Presentation/afrekenen/index.php";
$winkelwagen = "App/Presentation/winkelwagen/index.php";
$klantGegevens = unserialize($_SESSION['klant']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['opmerkingen']);
    $_SESSION['opmerkingen'] = $_POST['opmerkingen'];
}

$opmerkingen = $_SESSION['opmerkingen'];

require_once "App/Presentation/template.php";

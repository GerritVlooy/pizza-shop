<?php
// aanmeldenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
use App\Business\VeldControleService;
use App\Business\KlantService;

$title = "Aanmelden";
$view = "App/Presentation/account/index.php";

if (isset($_GET['uitloggen'])) {
    unset($_SESSION['login']);
}

if (isset($_SESSION['login'])) {
    $title = "Account";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['login'])) {
    $veldControleService = new VeldControleService();
    $bericht = $veldControleService->checkEmailWachtwoordVelden(
        $_POST['email'],
        $_POST['wachtwoord']
        );
    if(empty($bericht)) {
        $klantService = new KlantService();
        $bericht = $klantService->checkLogin(
            $_POST['email'],
            $_POST['wachtwoord']
        );
    if(empty($bericht)) {
        $bericht[] = "Aanmelden Succesvol!";
        $_SESSION['login'] = true;
    }
    }
}

require_once "App/Presentation/template.php";

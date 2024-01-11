<?php
// aanmeldenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
use App\Business\VeldControleService;
use App\Business\KlantService;

$title = "Aanmelden";
$view = "App/Presentation/account/index.php";
$email = "";

if(isset($_COOKIE['user_email'])) {
    $email = $_COOKIE['user_email'];
}

if (isset($_GET['uitloggen']) && isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    unset($_SESSION['klantId']);
    setcookie("user_email", "", time() - 1, "/");
}

if (isset($_SESSION['login'])) {
    $title = "Account";

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['login'])) {
    if(isset($_SESSION['klantId'])) {
        unset($_SESSION['klantId']);
    }
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
        $_SESSION['klantId'] = $klantService->getKlantId($_POST['email']);
        setcookie("user_email", $email, time() + 3600, "/");
    }
    }
}

if (isset($_SESSION['login']) && isset($_GET['opties'])) {
    header("Location: afrekenenController.php");
    die();
}

require_once "App/Presentation/template.php";

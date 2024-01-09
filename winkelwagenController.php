<?php
// winkelwagenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
use App\Business\WinkelwagenService;

$winkelwagenService = new WinkelwagenService();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toevoegenAanWinkelwagen'])) {

    $artikel = [
        'pizza' => $_POST['pizza'],
        'hoeveelheid' => $_POST['hoeveelheid'],
        'extras' => isset($_POST['extras']) ? $_POST['extras'] : [],
    ];

    if (!isset($_SESSION['winkelwagen'])) {
        $_SESSION['winkelwagen'] = [];
    }

    $_SESSION['winkelwagen'][] = $artikel;
}

if (isset($_GET['verwijder'])) {
    $verwijderIndex = $_GET['verwijder'];
    if (isset($_SESSION['winkelwagen'][$verwijderIndex])) {
        unset($_SESSION['winkelwagen'][$verwijderIndex]);
    }
}

if (isset($_GET['leegmaken'])) {
    unset($_SESSION['winkelwagen']);
}
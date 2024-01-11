<?php
// registratieVeldController.php
declare(strict_types = 1);

$voornaam = '';
$naam = '';
$straat = '';
$huisnummer = '';
$postcode = '';
$woonplaats = '';
$telefoonGSM = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $voornaam = isset($_POST['voornaam']) ? $_POST['voornaam'] : '';
    $naam = isset($_POST['naam']) ? $_POST['naam'] : '';
    $straat = isset($_POST['straat']) ? $_POST['straat'] : '';
    $huisnummer = isset($_POST['huisnummer']) ? $_POST['huisnummer'] : '';
    $postcode = isset($_POST['postcode']) ? (int) $_POST['postcode'] : '';
    $woonplaats = isset($_POST['woonplaats']) ? $_POST['woonplaats'] : '';
    $telefoonGSM = isset($_POST['telefoonGSM']) ? $_POST['telefoonGSM'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
}
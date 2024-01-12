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
    $voornaam = $_POST['voornaam'] ?? '';
    $naam = $_POST['naam'] ?? '';
    $straat = $_POST['straat'] ?? '';
    $huisnummer = $_POST['huisnummer'] ?? '';
    $postcode = (int)($_POST['postcode'] ?? '');
    $woonplaats = $_POST['woonplaats'] ?? '';
    $telefoonGSM = $_POST['telefoonGSM'] ?? '';
    $email = $_POST['email'] ?? '';
}

if (isset($_SESSION['klant'])) {
    $klantObject = unserialize($_SESSION['klant']);
    $voornaam = $voornaam ?: $klantObject->getVoornaam();
    $naam = $naam ?: $klantObject->getNaam();
    $straat = $straat ?: $klantObject->getAdres()->getStraat();
    $huisnummer = $huisnummer ?: $klantObject->getAdres()->getHuisnummer();
    $postcode = $postcode ?: $klantObject->getAdres()->getWoonplaats()->getPostcode();
    $woonplaats = $woonplaats ?: $klantObject->getAdres()->getWoonplaats()->getNaam();
    $telefoonGSM = $telefoonGSM ?: $klantObject->getTelefoonGSM();
    $email = $email ?: $klantObject->getEmail();
}
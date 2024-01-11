<?php
// registrerenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
require_once("registratieVeldController.php");
use App\Business\VeldControleService;
use App\Business\AdresService;
use App\Business\WoonplaatsService;
use App\Business\KlantService;

$title = "Registreren";
$view = "App/Presentation/registreren/index.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $woonplaatsService = new WoonplaatsService();
    $adresService = new AdresService();
    $klantService = new KlantService();
    $veldControleService = new VeldControleService();
    $naamTelefoonVelden = $veldControleService->checkNaamTelefoonVelden(
        $_POST['voornaam'],
        $_POST['naam'],
        $_POST['telefoonGSM']
    );

    $adresVelden = $veldControleService->checkAdresVelden(
        $_POST['straat'], 
        $_POST['huisnummer'], 
        (int) $_POST['postcode'], 
        $_POST['woonplaats']
    );

    $emailWachtwoordVelden = $veldControleService->checkEmailWachtwoordVelden(
        $_POST['email'],
        $_POST['wachtwoord']
    );

    $wachtwoordControle = $veldControleService->checkWachtwoorden(
        $_POST['wachtwoord'], 
        $_POST['wachtwoordCheck']);

    $bericht = array_merge($naamTelefoonVelden, $adresVelden, $emailWachtwoordVelden);
    
    if(empty($bericht)) {
        $woonplaatsCheck = $woonplaatsService->checkWoonplaats($_POST['woonplaats'], (int) $_POST['postcode']);
        $emailCheck = $klantService->checkEmail($_POST['email']);
        $bericht = array_merge($woonplaatsCheck, $emailCheck);
    }

    if(empty($bericht)) {
        $woonplaatsId = $woonplaatsService->getWoonplaatsId($_POST['woonplaats'], (int) $_POST['postcode']);
        if(($adresService->checkAdres($_POST['straat'], $_POST['huisnummer'], $woonplaatsId) === false)) {
            $adresService->createAdres($_POST['straat'], $_POST['huisnummer'], $woonplaatsId);
        }
        $klantService->createKlant(
            $_POST['voornaam'],
            $_POST['naam'],
            $_POST['email'],
            (int) $adresService->getAdresIdByParameters($_POST['straat'], $_POST['huisnummer'], $woonplaatsId),
            $_POST['telefoonGSM'],
            $_POST['wachtwoord']
        );
        $bericht[] = "Registratie Succesvol!";
    }
    
}

require_once "App/Presentation/template.php";
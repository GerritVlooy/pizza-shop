<?php
// registrerenController.php
declare(strict_types = 1);
require_once("bootstrap.php");
require_once("registratieVeldController.php");

use App\Business\VeldControleService;
use App\Business\AdresService;
use App\Business\WoonplaatsService;
use App\Business\KlantService;
use App\Entities\Klant;
use App\Entities\Adres;
use App\Entities\Woonplaats;

$title = "Registreren";
if(isset($checkbox) || isset($updateGegevens)) {
    $title = "Geef uw gegevens in";
}
$view = "App/Presentation/registreren/index.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $woonplaatsService = new WoonplaatsService();
    $adresService = new AdresService();
    $klantService = new KlantService();
    $veldControleService = new VeldControleService();
     
    $bericht = $veldControleService->checkAdresVelden(
        $_POST['straat'], 
        $_POST['huisnummer'], 
        (int) $_POST['postcode'], 
        $_POST['woonplaats']
    );

    if(!isset($_SESSION['klant']) || isset($updateGegevens)) {
        $naamTelefoonVelden = $veldControleService->checkNaamTelefoonVelden(
            $_POST['voornaam'],
            $_POST['naam'],
            $_POST['telefoonGSM']
        );
        $bericht = array_merge($bericht, $naamTelefoonVelden);    
    }
   
    if(isset($_POST['accountCheck']) && !isset($_SESSION['klant'])) {

        $emailWachtwoordVelden = $veldControleService->checkEmailWachtwoordVelden(
            $_POST['email'],
            $_POST['wachtwoord']
        );
    
        $wachtwoordControle = $veldControleService->checkWachtwoorden(
            $_POST['wachtwoord'], 
            $_POST['wachtwoordCheck']
        );
    
        $bericht = array_merge($bericht, $emailWachtwoordVelden, $wachtwoordControle);
    }

    if(empty($bericht)) {
        $bericht = $woonplaatsService->checkWoonplaats($_POST['woonplaats'], (int) $_POST['postcode']);
        if(isset($_POST['accountCheck']) && !isset($updateGegevens)) {
            $emailCheck = $klantService->checkEmail($_POST['email']);
            $bericht = array_merge($bericht, $emailCheck);
        }
    }

    if(empty($bericht)) {
        $woonplaatsId = $woonplaatsService->getWoonplaatsId($_POST['woonplaats'], (int) $_POST['postcode']);
          
        if(isset($_POST['accountCheck']) || isset($updateGegevens)) {
            if(($adresService->checkAdres($_POST['straat'], $_POST['huisnummer'], $woonplaatsId) === false)) {
            $adresService->createAdres($_POST['straat'], $_POST['huisnummer'], $woonplaatsId);
            }
            $adresId = (int) $adresService->getAdresIdByParameters($_POST['straat'], $_POST['huisnummer'], $woonplaatsId);
        }

        if(isset($_POST['accountCheck']) && !isset($updateGegevens)) {
            $klantId = $klantService->createKlant(
                $_POST['voornaam'],
                $_POST['naam'],
                $_POST['email'],
                $adresId,
                $_POST['telefoonGSM'],
                $_POST['wachtwoord']
            );
        }
    
        if(!isset($_POST['accountCheck'])) {
            if(isset($_SESSION['klant'])) {
                unset($_SESSION['klant']);
            }
            $_SESSION['klant'] = serialize($klantService->createKlantSession(
                $_POST['voornaam'],
                $_POST['naam'],
                $adresService->createAdresSession(
                    $_POST['straat'], 
                    $_POST['huisnummer'], 
                    $woonplaatsId),
                $_POST['telefoonGSM']
                )
            );            
        }

        if(isset($doorsturen)) {
            header("Location: afrekenenController.php");
            die();
        }

        if(!isset($updateGegevens)) {
            $bericht[] = "Succes! U kunt nu inloggen";
        }

        if(empty($bericht) && isset($updateGegevens)) {
            $bericht[] = "Succes: Gegevens bijgewerkt";
            $klantService->updateKlant($klantObject->getEmail(), $adresId);
            unset($_SESSION['klant']);
            $_SESSION['klant'] = serialize($klantService->getKlantByEmail($email));
        }
    }

}

require_once "App/Presentation/template.php";
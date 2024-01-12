<?php
// bestellingPlaatsenController.php
declare(strict_types = 1);
require_once("bootstrap.php");

use App\Business\BestellingService;
use App\Business\KlantService;
use App\Business\AdresService;
use App\Business\WoonplaatsService;
use Entities\Klant;
use Entities\Adres;
use Entities\Woonplaats;

if (
    !isset($_SESSION['klant']) ||
    !isset($_SESSION['winkelwagen']) ||
    empty($_SESSION['winkelwagen']) ||
    !isset($_GET['afrekenen'])
) {
    header("Location: homecontroller.php");
    die();
}

$klantGegevens = unserialize($_SESSION['klant']);

if(!isset($_SESSION['login'])) {
    $adresService = new AdresService();
    $woonplaatsService = new WoonplaatsService();
    $klantService = new KlantService();

    $woonplaatsId = $woonplaatsService->getWoonplaatsId(
        $klantGegevens->getAdres()->getWoonplaats()->getNaam(),
        (int) $klantGegevens->getAdres()->getWoonplaats()->getPostcode()
    );

    if($adresService->checkAdres(
        $klantGegevens->getAdres()->getStraat(),
        $klantGegevens->getAdres()->getHuisnummer(),
        (int)$woonplaatsId
        ) === false) {
            $adresService->createAdres(
                $klantGegevens->getAdres()->getStraat(),
                $klantGegevens->getAdres()->getHuisnummer(),
                (int)$woonplaatsId
            );
        }
    
    $klantId = $klantService->createKlant(
        $klantGegevens->getNaam(),
        $klantGegevens->getVoornaam(),
        null,
        $adresService->getAdresIdByParameters(
            $klantGegevens->getAdres()->getStraat(),
            $klantGegevens->getAdres()->getHuisnummer(),
            (int)$woonplaatsId
        ),
        $klantGegevens->getTelefoonGSM(),
        null
    );

    $klantGegevens->setId((int) $klantId);
}  

$bestellingService = new BestellingService();
$bestellingService->createOrder($_SESSION['winkelwagen'], $klantGegevens);
unset($_SESSION['winkelwagen']);

$title = "Bestelling geplaatst, alvast smakelijk!";
$view = "App/Presentation/bestelling/index.php";

require_once "App/Presentation/template.php";
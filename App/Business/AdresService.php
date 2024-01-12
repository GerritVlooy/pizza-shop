<?php
//App/Business/AdresService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\AdresDAO;
use App\Data\WoonplaatsDAO;
use App\Entities\Adres;

class AdresService {

    private AdresDAO $adresDAO;

    public function __construct()
    {
        $this->adresDAO = new AdresDAO();
    }

    public function checkAdres(string $straat, string $huisnummer, int $woonplaatsId): bool {
        if($this->adresDAO->getByParameters($straat, $huisnummer, $woonplaatsId) !== null) {
            return true;
        }
        return false;
    }

    public function createAdres(string $straat, string $huisnummer, int $woonplaatsId) {
        $this->adresDAO->create($straat, $huisnummer, $woonplaatsId);
    }

    public function getAdresIdByParameters(string $straat, string $huisnummer, int $woonplaatsId): int {
        $adres = $this->adresDAO->getByParameters($straat, $huisnummer, $woonplaatsId);
        return (int) $adres->getId();
    }

    public function createAdresSession(
        string $straat,
        string $huisnummer,
        int $woonplaatsId
    ): Adres {
        $woonplaatsDAO = new WoonplaatsDAO();
        $woonplaats = $woonplaatsDAO->getById($woonplaatsId);
        return new Adres(
            0,
            $straat,
            $huisnummer,
            $woonplaats
        );
    }
}
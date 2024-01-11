<?php
//App/Business/AdresService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\AdresDAO;
use App\Entities\Adres;

class AdresService {

    private AdresDAO $adresDAO;

    public function checkAdres(string $straat, string $huisnummer, int $woonplaatsId): bool {
        $this->adresDAO = new AdresDAO();
        if($this->adresDAO->getByParameters($straat, $huisnummer, $woonplaatsId) !== null) {
            return true;
        }
        return false;
    }

    public function createAdres(string $straat, string $huisnummer, int $woonplaatsId) {
        $this->adresDAO->create($straat, $huisnummer, $woonplaatsId);
    }

    public function getAdresIdByParameters(string $straat, string $huisnummer, int $woonplaatsId): int {
        $this->adresDAO = new AdresDAO();
        $adres = $this->adresDAO->getByParameters($straat, $huisnummer, $woonplaatsId);
        return (int) $adres->getId();
    }
}
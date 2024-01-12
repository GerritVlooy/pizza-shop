<?php
//App/Business/WoonplaatsService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\WoonplaatsDAO;
use App\Entities\Woonplaats;
use App\Exceptions\WoonplaatsBestaatNietException;

class WoonplaatsService {
    
    private WoonplaatsDAO $woonplaatsDAO;

    public function __construct()
    {
        $this->woonplaatsDAO = new WoonplaatsDAO();
    }
    
    public function checkWoonplaats(string $woonplaatsNaam, int $postcode): array {
        $foutBericht = [];

        try {
            $this->woonplaatsDAO->getByNaamAndPostcode($woonplaatsNaam, $postcode);
        } catch (WoonplaatsBestaatNietException $ex) {
        $foutBericht[] = "Fout: Levering buiten omstreeks Leuven niet mogelijk.";
        }

        return $foutBericht;
    }

    public function getWoonplaatsId(string $woonplaatsNaam, int $postcode): int {
        $woonplaats = $this->woonplaatsDAO->getByNaamAndPostcode($woonplaatsNaam, $postcode);
        return $woonplaats->getId();
    }
}
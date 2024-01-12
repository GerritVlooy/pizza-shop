<?php
// App/Data/PromotieKlantDAO.php
declare(strict_types=1);

namespace App\Data;

use PDO;
use App\Data\DBConfig;
use App\Entities\PromotieKlant;
use App\Entities\Klant;
use App\Entities\PromotiePizza;

class PromotieKlantDAO extends DBConfig
{
    private KlantDAO $klantDAO;
    private PromotiePizzaDAO $promotiePizzaDAO;

    public function __construct()
    {
        $this->klantDAO = new KlantDAO();
        $this->promotiePizzaDAO = new PromotiePizzaDAO();
    }

    public function getByKlantId(int $klantId): array
    {
        $sql = "SELECT promotie_klanten_id, promotie_id, klant_id
                FROM promotie_klanten
                WHERE klant_id = :klant_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME, parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);

        $lijst = [];
        $stmt->execute(array(':klant_id' => $klantId));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultSet as $rij) {
            $promotieId = (int) $rij['promotie_id'];
            $promotiePizza = $this->promotiePizzaDAO->getById($promotieId);
            $klant = $this->klantDAO->getById($klantId);

            $promotieKlant = new PromotieKlant(
                (int) $rij['promotie_klanten_id'],
                $promotiePizza,
                $klant
            );
            array_push($lijst, $promotieKlant);
        }

        $dbh = null;
        return $lijst;
    }
    
    public function getByKlandIdandPromotieId(int $klantId, int $promotieId): ?PromotieKlant
    {
        $sql = "SELECT promotie_klanten_id, promotie_id, klant_id
                FROM promotie_klanten
                WHERE klant_id = :klant_id
                AND ";
    }
}
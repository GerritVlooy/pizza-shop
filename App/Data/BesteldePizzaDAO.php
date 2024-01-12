<?php
// App/Data/BestellingDAO.php
declare(strict_types=1);

namespace App\Data;

use PDO;
use App\Data\DBConfig;
use App\Entities\BesteldePizza;
use App\Entities\Pizza;
use App\Entities\Bestelling;
use App\Entities\PromotieKlant;

class BesteldePizzaDAO extends DBConfig {

    public function create(int $bestellingId, int $pizzaId, ?int $promotieKlantenId, int $hoeveelheid): int
    {
        $sql = "INSERT INTO bestelde_pizzas (bestelling_id, pizza_id, promotie_klanten_id, hoeveelheid) 
                VALUES (:bestelling_id, :pizza_id, :promotie_klanten_id, :hoeveelheid)";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME, parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestelling_id' => $bestellingId,
            ':pizza_id' => $pizzaId,
            ':promotie_klanten_id' => $promotieKlantenId,
            ':hoeveelheid' => $hoeveelheid,
        ));

        $besteldePizzasId = $dbh->lastInsertId();

        $dbh = null;

        return (int) $besteldePizzasId;
    }
}
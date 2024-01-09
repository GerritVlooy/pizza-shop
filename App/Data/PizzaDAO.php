<?php
//App/Data/PizzaDAO.php
declare(strict_types = 1);
namespace App\Data;
use PDO;
use App\Data\DBConfig;
use App\Entities\Pizza;

class PizzaDAO extends DBConfig {

    public function getAllePizzas(): array {
        $sql = "SELECT pizza_id, pizza_naam, pizza_beschrijving, prijs FROM pizzas ORDER BY prijs";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
        parent::$DB_PASSWORD);

        $resultSet = $dbh->query($sql);
        $lijst = [];
        foreach ($resultSet as $rij) {
            $pizza = new Pizza((int) $rij["pizza_id"], $rij["pizza_naam"], $rij["pizza_beschrijving"], (float) $rij["prijs"]);
            array_push($lijst, $pizza);
        }
        $dbh = null;
        return $lijst;
    }

    public function getPizzaByNaam(string $pizzaNaam): ?Pizza {
        $sql = "SELECT pizza_id, pizza_naam, pizza_beschrijving, prijs FROM pizzas WHERE pizza_naam = :pizza_naam";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':pizza_naam' => $pizzaNaam));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rij === false) {
            return null;
        }
      
        $pizza = new Pizza((int) $rij["pizza_id"], $pizzaNaam, $rij["pizza_beschrijving"], (float) $rij["prijs"]);
        $dbh = null;
        return $pizza;
    }
}
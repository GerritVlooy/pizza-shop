<?php
// App/Data/PromotiePizzaDAO.php
declare(strict_types=1);

namespace App\Data;

use PDO;
use App\Data\DBConfig;
use App\Data\PizzaDAO;
use App\Entities\PromotiePizza;
use App\Entities\Pizza;

class PromotiePizzaDAO extends DBConfig
{
    private PizzaDAO $pizzaDAO;

    public function __construct()
    {
        $this->pizzaDAO = new PizzaDAO();
    }

    public function getById(int $promotieId): ?PromotiePizza
    {
        $sql = "SELECT pizza_id, promotie_prijs, promotie_id
                FROM promotie_pizzas
                WHERE promotie_id = :promotie_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME, parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':promotie_id' => $promotieId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rij === false) {
            return null;
        }

        $pizzaId = (int) $rij['pizza_id'];

        $pizza = $this->pizzaDAO->getPizzaById($pizzaId);

        $promotiePizza = new PromotiePizza(
            $promotieId,
            $pizza,
            (float) $rij['promotie_prijs']
        );

        $dbh = null;
        return $promotiePizza;
    }

    public function getByPizzaId(int $pizzaId): array
    {
        $sql = "SELECT pizza_id, promotie_prijs, promotie_id
                FROM promotie_pizzas
                WHERE pizza_id = :pizza_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME, parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $lijst = [];
        $stmt->execute(array(':klant_id' => $klantId));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($resultSet as $rij) {
            $pizza = $this->pizzaDAO->getPizzaById($pizzaId);

            $promotiePizza = new PromotiePizza(
                (int) $rij['promotie_id'],
                $pizza,
                (float) $rij['promotie_prijs']
            );
            array_push($lijst, $promotiePizza);
        }

        $dbh = null;
        return $lijst;
    }

    public function getByPizzaIdandKlantId(int $pizzaId, int $klantId): ?PromotiePizza 
    {
        $sql = "SELECT promotie_pizzas.promotie_id as promotie_id,
                promotie_pizzas.pizza_id AS pizza_id,
                promotie_pizzas.promotie_prijs as promotie_prijs,
                promotie_klanten.promotie_klanten_id,
                promotie_klanten.promotie_id,
                promotie_klanten.klant_id AS klant_id
                FROM promotie_pizzas
                INNER JOIN promotie_klanten
                ON promotie_pizzas.promotie_id = promotie_klanten.promotie_id
                WHERE promotie_pizzas.pizza_id = :pizza_id
                AND promotie_klanten.klant_id = :klant_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
        parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':pizza_id' => $pizzaId, 
            ':klant_id' => $klantId
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rij === false) {
            return null;
        }
        $pizza = $this->pizzaDAO->getPizzaById((int) $rij['pizza_id']);

        $promotiePizza = new PromotiePizza(
            (int) $rij['promotie_id'],
            $pizza,
            (float) $rij['promotie_prijs']
        );

        $dbh = null;
        return $promotiePizza;
    }
}
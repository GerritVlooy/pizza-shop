<?php
// App/Data/BesteldeIngredientDAO.php
declare(strict_types=1);

namespace App\Data;

use PDO;
use App\Data\DBConfig;
use App\Entities\BesteldeIngredient;
use App\Entities\Ingredient;
use App\Entities\BesteldePizza;

class BesteldeIngredientDAO extends DBConfig
{
    public function create(int $ingredientId, int $besteldePizzaId): int
    {
        $sql = "INSERT INTO bestelde_ingredienten (ingredient_id, bestelde_pizzas_id) VALUES (:ingredient_id, :bestelde_pizzas_id)";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME, parent::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':ingredient_id' => $ingredientId, ':bestelde_pizzas_id' => $besteldePizzaId));
        
        $besteldeIngredientenId = $dbh->lastInsertId();

        $dbh = null;

        return (int) $besteldeIngredientenId;
    }

}
<?php
//App/Data/IngredientDAO.php
declare(strict_types = 1);
namespace App\Data;
use PDO;
use App\Data\DBConfig;
use App\Entities\Ingredient;

class IngredientDAO extends DBConfig {

    public function getAlleIngredienten(): array {
        $sql = "SELECT ingredient_id, ingredient_naam, prijs FROM ingredienten ORDER BY ingredient_naam";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
        parent::$DB_PASSWORD);

        $resultSet = $dbh->query($sql);
        $lijst = [];
        foreach ($resultSet as $rij) {
            $ingredient = new Ingredient((int) $rij["ingredient_id"], $rij["ingredient_naam"], (float) $rij["prijs"]);
            array_push($lijst, $ingredient);
        }
        $dbh = null;
        return $lijst;
    }

    public function getIngredientByNaam(string $ingredientNaam): ?Ingredient {
        $sql = "SELECT ingredient_id, ingredient_naam, prijs FROM ingredienten WHERE ingredient_naam = :ingredient_naam";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':ingredient_naam', $ingredientNaam, PDO::PARAM_STR);
        $stmt->execute();

        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($rij === false) {
            return null;
        }
      
        $ingredient = new Ingredient((int) $rij["ingredient_id"], $ingredientNaam, (float) $rij["prijs"]);
        $dbh = null;
        return $ingredient;
    }
}
<?php
//App/Business/IngredientService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\IngredientDAO;
use App\Entities\Ingredient;

Class IngredientService {

    Private IngredientDAO $ingredientDAO;

    public function __construct() {
        $this->ingredientDAO = new IngredientDAO();
    }

    public function getIngredienten(): array {
        return $this->ingredientDAO->getAlleIngredienten();
    }

    public function getByNaam(string $ingredientNaam): Ingredient {
        return $this->ingredientDAO->getIngredientByNaam($ingredientNaam);
    }
}
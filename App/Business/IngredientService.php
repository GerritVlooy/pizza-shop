<?php
//App/Business/IngredientService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\IngredientDAO;
use App\Entities\Ingredient;

Class IngredientService {

    Private IngredientDAO $ingredientDAO;

    public function getIngredienten(): array {
        $this->ingredientDAO = new IngredientDAO();
        return $this->ingredientDAO->getAlleIngredienten();
    }
}
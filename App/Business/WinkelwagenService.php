<?php
//App/Business/PizzaService.php
declare(strict_types = 1);
namespace App\Business;
use App\Data\PizzaDAO;
use App\Entities\Pizza;
use App\Data\IngredientDAO;
use App\Entities\Ingredient;

class WinkelwagenService {
    
    private PizzaDAO $pizzaDAO;
    private IngredientDAO $ingredientDAO;

    public function berekenPrijsPizza(int $hoeveelheid, string $pizzaNaam, array $ingredienten): float {
        $this->pizzaDAO = new PizzaDAO();
        $this->ingredientDAO = new IngredientDAO();
        $pizza = $this->pizzaDAO->getPizzaByNaam($pizzaNaam);
        $ingredientTotaal = 0;
        if(!empty($ingredienten)) {
            foreach($ingredienten as $ingredientNaam) {
                $ingredient = $this->ingredientDAO->getIngredientByNaam($ingredientNaam);
                if($ingredient !== null) {}
                $ingredientTotaal += $ingredient->getPrijs();
            }
        }
        return ($hoeveelheid * ($pizza->getPrijs() + $ingredientTotaal));
    }
}
<?php
//App/Business/WinkelWagenService.php
declare(strict_types = 1);

namespace App\Business;

use App\Data\PizzaDAO;
use App\Data\PromotieKlantDAO;
use App\Entities\PromotieKlant;
use App\Entities\PromotiePizza;
use App\Entities\Pizza;
use App\Data\IngredientDAO;
use App\Entities\Ingredient;

class WinkelwagenService {
    
    private PizzaDAO $pizzaDAO;
    private IngredientDAO $ingredientDAO;
    private PromotieKlantService $promotieKlantService;

    public function __construct() {
        $this->pizzaDAO = new PizzaDAO();
        $this->ingredientDAO = new IngredientDAO();
        $this->promotieKlantService = new PromotieKlantService();
    }

    public function berekenPrijsPizza(int $hoeveelheid, string $pizzaNaam, array $ingredienten, int $klantId): float {
        $pizza = $this->pizzaDAO->getPizzaByNaam($pizzaNaam);
        $ingredientTotaal = 0;

        if(!empty($ingredienten)) {
            foreach($ingredienten as $ingredientNaam) {
                $ingredient = $this->ingredientDAO->getIngredientByNaam($ingredientNaam);
                if($ingredient !== null) {
                    $ingredientTotaal += $ingredient->getPrijs();
                }
            }
        }
        $promotieKlanten = $this->promotieKlantService->getPromotieKlantenByKlantId($klantId);

        $pizzaPrijs = $pizza->getPrijs();
        if (!empty($promotieKlanten)) {
            foreach($promotieKlanten as $promotieKlant) {
                if ($promotieKlant->getPromotiePizza()->getPizza()->getId() === $pizza->getId()) {
                    $pizzaPrijs = $promotieKlant->getPromotiePizza()->getPromotiePrijs();
                }
            } 
        } 

        return ($hoeveelheid * ($pizzaPrijs + $ingredientTotaal));
    }
}
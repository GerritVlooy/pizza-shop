<?php
//App/Business/BestellingService.php
declare(strict_types = 1);
namespace App\Business;

use App\Business\PizzaService;
use App\Business\PromotieKlantService;
use App\Business\IngredientService;
use App\Data\BestellingDAO;
use App\Data\BesteldePizzaDAO;
use App\Data\BesteldeIngredientDAO;
use App\Entities\Klant;
use App\Entities\Bestelling;
use App\Entities\BesteldePizza;
use App\Entities\BesteldeIngredient;
use App\Entities\Ingredient;
use App\Entities\PromotieKlant;
use App\Entities\PromotiePizza;

class BestellingService {

    private BestellingDAO $bestellingDAO;
    private BesteldePizzaDAO $besteldePizza;
    private BesteldeIngredientDAO $besteldeIngredientDAO;

    public function __construct()
    {
        $this->bestellingDAO = new BestellingDAO();
        $this->besteldePizza = new BesteldePizzaDAO();
        $this->besteldeIngredientDAO = new BesteldeIngredientDAO();
    }

    public function createOrder(array $winkelwagen, Klant $klantGegevens) {
        $pizzaService = new PizzaService();
        $promotieKlantService = new PromotieKlantService();
        $promotieKlanten = $promotieKlantService->getPromotieKlantenByKlantId((int) $klantGegevens->getId());
        $bestellingId = $this->createBestelling((int) $klantGegevens->getId(), $_SESSION['opmerkingen']);
        foreach ($winkelwagen as $index => $artikel) {
            $pizza = $pizzaService->getPizzaByNaam($artikel['pizza']);
            $pizzaId = $pizza->getId();
            $promotieKlantenId = null;
            if(!empty($promotieKlanten)) {
                foreach ($promotieKlanten as $promotieKlant) {
                    if ($promotieKlant->getPromotiePizza()->getPizza()->getId() === $pizza->getId()) {
                        $promotieKlantenId = $promotieKlant->getPromotieKlantenId();
                    }
                }
            }
            $besteldePizzaId = $this->createBesteldePizza($bestellingId, $pizzaId, $promotieKlantenId, (int) $artikel['hoeveelheid']);
            if(!empty($artikel['extras'])) {
                $ingredientService = new IngredientService();
                foreach($artikel['extras'] as $extra) {
                    $ingredient = $ingredientService->getByNaam($extra);
                    $this->createBesteldeIngredient($ingredient->getId(), $besteldePizzaId);
                }
            }
        }

    }

    private function createBestelling(int $klantId, string $opmerkingen): int {
        return $this->bestellingDAO->create($klantId, $opmerkingen);
    }

    private function createBesteldePizza(int $bestellingId, int $pizzaId, ?int $promotieKlantenId, int $hoeveelheid): int {
        return $this->besteldePizza->create($bestellingId, $pizzaId, $promotieKlantenId, $hoeveelheid);
    }

    private function createBesteldeIngredient(int $ingredientId, int $besteldePizzaId): int {
        return $this->besteldeIngredientDAO->create($ingredientId, $besteldePizzaId);
    }
}
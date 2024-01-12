<?php
//App/Business/PizzaService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\PizzaDAO;
use App\Data\PromotiePizzaDAO;
use App\Entities\Pizza;
use App\Business\PromotieKlantService;
use App\Entities\PromotieKlant;
use App\Entities\PromotiePizza;

Class PizzaService {

    Private PizzaDAO $pizzaDAO;

    public function __construct()
    {
        $this->pizzaDAO = new PizzaDAO();
    }

    public function getPizzas(int $klantId): array {

        $pizzas = $this->pizzaDAO->getAllePizzas();
        $promotieKlantService = new PromotieKlantService();
        $array = [];

        foreach ($pizzas as $pizza) {
            $promotieKlanten = $promotieKlantService->getPromotieKlantenByKlantId($klantId);
            if (!empty($promotieKlanten)) {
                foreach($promotieKlanten as $promotieKlant) {
                    if ($promotieKlant->getPromotiePizza()->getPizza()->getId() === $pizza->getId()) {
                        $pizza->setPrijs($promotieKlant->getPromotiePizza()->getPromotiePrijs());
                    }
                } 
            }
            array_push($array, $pizza);
        }

        return $array;
    }

    public function getPizzasGeenPromo(): array {
        return $this->pizzaDAO->getAllePizzas();
    }

    public function getPromoPrijsForPizza(Pizza $pizza, int $klantId): ?float {
        $promotiePizzaDAO = new PromotiePizzaDAO();
        $promotiePizza = $promotiePizzaDAO->getByPizzaIdandKlantId($pizza->getId(), $klantId);
        if ($promotiePizza !== null) {
            return $promotiePizza->getPromotiePrijs();
        }
        return null;
    }

    public function getPizzaByNaam(string $pizzaNaam): Pizza {
        return $this->pizzaDAO->getPizzaByNaam($pizzaNaam);
    }

}
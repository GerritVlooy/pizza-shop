<?php
//App/Business/PizzaService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\PizzaDAO;
use App\Entities\Pizza;

Class PizzaService {

    Private PizzaDAO $pizzaDAO;

    public function getPizzas(): array {
        $this->pizzaDAO = new PizzaDAO();
        return $this->pizzaDAO->getAllePizzas();
    }
}
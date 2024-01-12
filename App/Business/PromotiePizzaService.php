<?php
// App/Business/PromotiePizzaService.php
declare(strict_types=1);

namespace App\Business;

use App\Data\PizzaDAO;
use App\Data\PromotiePizzaDAO;
use App\Entities\PromotiePizza;
use App\Entities\Pizza;

class PromotiePizzaService
{
    private PromotiePizzaDAO $promotiePizzaDAO;

    public function __construct()
    {
        $this->promotiePizzaDAO = new PromotiePizzaDAO();
    }

    public function getPromotiePizzaById(int $promotieId): ?PromotiePizza
    {
        return $this->promotiePizzaDAO->getById($promotieId);
    }

}
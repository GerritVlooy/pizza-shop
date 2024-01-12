<?php
// App/Entities/BesteldePizza.php
declare(strict_types=1);

namespace App\Entities;

use App\Entities\Pizza;
use App\Entities\PromotieKlant;
use App\Entities\Bestelling;

class BesteldePizza
{
    private int $besteldePizzasId;
    private Bestelling $bestelling;
    private Pizza $pizza;
    private ?PromotieKlant $promotieKlant;
    private int $hoeveelheid;

    public function __construct(int $besteldePizzasId, int $bestelling, Pizza $pizza, ?PromotieKlant $promotieKlant = null, int $hoeveelheid)
    {
        $this->besteldePizzasId = $besteldePizzasId;
        $this->bestelling = $bestelling;
        $this->pizza = $pizza;
        $this->promotieKlant = $promotieKlant;
        $this->hoeveelheid = $hoeveelheid;
    }

    public function getBesteldePizzasId(): int
    {
        return $this->besteldePizzasId;
    }

    public function getBestelling(): Bestelling
    {
        return $this->bestelling;
    }

    public function getPizza(): Pizza
    {
        return $this->pizza;
    }

    public function getPromotieKlant(): ?PromotieKlant
    {
        return $this->promotieKlant;
    }

    public function getHoeveelheid(): int 
    {
        return $this->hoeveelheid;
    }
}
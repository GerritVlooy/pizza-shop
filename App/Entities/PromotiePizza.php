<?php
// App/Entities/PromotiePizza.php
declare(strict_types=1);
namespace App\Entities;

use App\Entities\Pizza;

class PromotiePizza
{
    private int $promotieId;
    private Pizza $pizza;
    private float $promotiePrijs;

    public function __construct(int $promotieId, Pizza $pizza, float $promotiePrijs)
    {
        $this->promotieId = $promotieId;
        $this->pizza = $pizza;
        $this->promotiePrijs = $promotiePrijs;
    }

    public function getPromotieId(): int
    {
        return $this->promotieId;
    }

    public function getPizza(): Pizza
    {
        return $this->pizza;
    }

    public function getPromotiePrijs(): float
    {
        return $this->promotiePrijs;
    }
}
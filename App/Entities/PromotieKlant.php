<?php
// App/Entities/PromotieKlant.php
declare(strict_types=1);
namespace App\Entities;

use App\Entities\Klant;
use App\Entities\PromotiePizza;

class PromotieKlant
{
    private int $promotieKlantenId;
    private PromotiePizza $promotiePizza;
    private Klant $klant;

    public function __construct(int $promotieKlantenId, PromotiePizza $promotiePizza, Klant $klant)
    {
        $this->promotieKlantenId = $promotieKlantenId;
        $this->promotiePizza = $promotiePizza;
        $this->klant = $klant;
    }

    public function getPromotieKlantenId(): int
    {
        return $this->promotieKlantenId;
    }

    public function getPromotiePizza(): PromotiePizza
    {
        return $this->promotiePizza;
    }

    public function getKlant(): Klant
    {
        return $this->klant;
    }
}
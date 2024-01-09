<?php
//App/Entities/Ingredient.php
declare(strict_types = 1);

namespace App\Entities;

Class Ingredient {

    private int $id;
    private string $naam;
    private float $prijs;

    public function __construct(int $id, string $naam, float $prijs) {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNaam(): string {
        return $this->naam;
    }

    public function getPrijs(): float {
        return $this->prijs;
    }
}
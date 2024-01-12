<?php
//App/Entities/Pizza.php
declare(strict_types = 1);

namespace App\Entities;

Class Pizza {

    private int $id;
    private string $naam;
    private string $beschrijving;
    private float $prijs;

    public function __construct(int $id, string $naam, string $beschrijving, float $prijs) {
        $this->id = $id;
        $this->naam = $naam;
        $this->beschrijving = $beschrijving;
        $this->prijs = $prijs;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNaam(): string {
        return $this->naam;
    }

    public function getBeschrijving(): string {
        return $this->beschrijving;
    }

    public function getPrijs(): float {
        return $this->prijs;
    }

    public function setPrijs(float $prijs) {
        $this->prijs = $prijs;
    }
}
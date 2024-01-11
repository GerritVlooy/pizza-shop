<?php
//App/Entities/Woonplaats.php
declare(strict_types = 1);

namespace App\Entities;

Class Woonplaats {

    private int $id;
    private string $naam;
    private int $postcode;

    public function __construct (int $id, string $naam, int $postcode) {
        $this->id = $id;
        $this->naam = $naam;
        $this->postcode = $postcode;
    }

    public function getId(): int {
        return $this->id;
    }

}
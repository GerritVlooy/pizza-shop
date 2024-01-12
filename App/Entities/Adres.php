<?php
//App/Entities/Adres.php
declare(strict_types = 1);

namespace App\Entities;

use App\Entities\Woonplaats;

Class Adres {

    private int $id;
    private string $straat;
    private string $huisnummer;
    private Woonplaats $woonplaats;

    public function __construct(int $id, string $straat, string $huisnummer, Woonplaats $woonplaats) {
        $this->id = $id;
        $this->straat = $straat;
        $this->huisnummer = $huisnummer;
        $this->woonplaats = $woonplaats;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getStraat(): string {
        return $this->straat;
    }

    public function getHuisnummer(): string {
        return $this->huisnummer;
    }

    public function getWoonplaats(): Woonplaats {
        return $this->woonplaats;
    }
}
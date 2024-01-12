<?php
// App/Entities/Bestelling.php
declare(strict_types=1);

namespace App\Entities;

use App\Entities\Klant;

class Bestelling
{
    private int $bestellingId;
    private Klant $klant;
    private string $datum;

    public function __construct(int $bestellingId, Klant $klantd, string $datum)
    {
        $this->bestellingId = $bestellingId;
        $this->klant = $klant;
        $this->datum = $datum;
    }

    public function getBestellingId(): int
    {
        return $this->bestellingId;
    }

    public function getKlant(): int
    {
        return $this->klant;
    }

    public function getDatum(): string 
    {
        return $this->datum;
    }
}
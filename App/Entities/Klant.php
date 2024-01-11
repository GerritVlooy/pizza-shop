<?php
//App/Entities/Klant.php
declare(strict_types = 1);

namespace App\Entities;

use App\Entities\Adres;

Class Klant {

    private int $id;
    private string $naam;
    private string $voornaam;
    private string $email;
    private Adres $adres;
    private string $telefoonGSM;
    private string $wachtwoord;
    private string $opmerking;

    public function __construct(
        int $id,
        string $naam,
        string $voornaam,
        string $email,
        Adres $adres,
        string $telefoonGSM,
        string $wachtwoord,
        string $opmerking
    ) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->email = $email;
        $this->adres = $adres;
        $this->telefoonGSM = $telefoonGSM;
        $this->wachtwoord = $wachtwoord;
        $this->opmerking = $opmerking;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getVoornaam(): string {
        return $this->voornaam;
    }

    public function getWachtwoord(): string {
        return $this->wachtwoord;
    }

    public function getAdres(): Adres {
        return $this->adres;
    }
}
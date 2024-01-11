<?php
//App/Business/VeldControleService.php
declare(strict_types = 1);
namespace App\Business;

class VeldControleService {

    private array $foutBericht;

    public function checkNaamTelefoonVelden(string $voornaam, string $naam, string $telefoonGSM): array {
        $this->foutBericht = [];

        if(empty($voornaam)) {
            $this->foutBericht[] = "Fout: Voornaam is verplicht";
        }

        if(empty($naam)) {
            $this->foutBericht[] = "Fout: Naam is verplicht";
        }

        if(empty($telefoonGSM)) {
            $this->foutBericht[] = "Fout: Telefoon/GSM nummer is verplicht";
        }

        return $this->foutBericht;       
    }

    public function checkAdresVelden(string $straat, string $huisnummer, int $postcode, string $woonplaats): array {
        $this->foutBericht = [];

        if(empty($straat)) {
            $this->foutBericht[] = "Fout: Straat is verplicht";
        }

        if(empty($huisnummer)) {
            $this->foutBericht[] = "Fout: Huisnummer is verplicht";
        }

        if(empty($postcode)) {
            $this->foutBericht[] = "Fout: postcode is verplicht";
        }

        if(empty($woonplaats)) {
            $this->foutBericht[] = "Fout: woonplaats is verplicht";
        }

        return $this->foutBericht;      
    }

    public function checkEmailWachtwoordVelden(string $email, string $wachtwoord): array {
        $this->foutBericht = [];

        if(empty($email)) {
            $this->foutBericht[] = "Fout: email is verplicht";
        }

        if(empty($wachtwoord)) {
            $this->foutBericht[] = "Fout: wachtwoord is verplicht";
        }

        return $this->foutBericht;  
    }

    public function checkWachtwoorden(string $wachtwoord, string $wachtwoordCheck): array {
        $this->foutBericht = [];

        if($wachtwoord !== $wachtwoordCheck) {
            $this->foutBericht[] = "Fout: gelieve wachtwoord twee keer in te geven";
        }

        return $this->foutBericht; 
    }

}

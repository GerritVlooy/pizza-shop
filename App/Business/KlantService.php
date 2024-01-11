<?php
//App/Business/KlantService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\KlantDAO;
use App\Entities\Klant;

class KlantService {

    private KlantDAO $klantDAO;
    private array $foutBericht;

    public function checkEmail(string $email): array {
        $this->klantDAO = new KlantDAO();
        $this->foutBericht = [];
        if($this->klantDAO->getByEmail($email) !== null) {
            $this->foutBericht[] = "Fout: Email bestaat al";
        }
        return $this->foutBericht;
    }

    public function createKlant(
        string $naam,
        string $voornaam,
        string $email,
        int $adresId,
        string $telefoonGSM,
        string $wachtwoord
    ) {
        $this->klantDAO->create(
            $naam,
            $voornaam,
            $email,
            $adresId,
            $telefoonGSM,
            md5($wachtwoord)
        );
    }

    public function checkLogin(string $email, string $wachtwoord): array {
        $this->klantDAO = new KlantDAO();
        $this->foutBericht = [];
        $klant = $this->klantDAO->getByEmail($email);

        if ($klant === null || $klant->getWachtwoord() !== md5($wachtwoord)) {
            $this->foutBericht[] = "Fout: Login mislukt";
        }

        return $this->foutBericht;
    }

}
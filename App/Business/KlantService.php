<?php
//App/Business/KlantService.php
declare(strict_types = 1);
namespace App\Business;

use App\Data\KlantDAO;
use App\Entities\Klant;
use App\Entities\Adres;

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
        ?string $email,
        int $adresId,
        string $telefoonGSM,
        ?string $wachtwoord
    ): int {
        if($wachtwoord !== null) {
            $wachtwoord = md5($wachtwoord);
        }
        $this->klantDAO = new KlantDAO();
        return $this->klantDAO->create(
            $naam,
            $voornaam,
            $email,
            $adresId,
            $telefoonGSM,
            $wachtwoord
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

    public function getKlantId(string $email): int {
        $this->klantDAO = new KlantDAO();
        $klant = $this->klantDAO->getByEmail($email);
        return $klant->getId();
    }

    public function getKlantGegevensById(int $id): Klant {
        $this->klantDAO = new KlantDAO();
        return $this->klantDAO->getById($id);
    }

    public function getKlantByEmail(string $email): Klant {
        $this->klantDAO = new KlantDAO();
        $klant = $this->klantDAO->getByEmail($email);
        $klant->setEmail();
        $klant->setWachtwoord();
        return $klant;
    }

    public function createKlantSession(
        string $naam,
        string $voornaam,
        Adres $adres,
        string $telefoonGSM
    ): Klant {
        return new Klant(
            0,
            $naam,
            $voornaam,
            "",
            $adres,
            $telefoonGSM,
            ""
        );
    }

    public function updateKlant(
        string $email,
        int $adresId
        ) {
        $this->klantDAO = new KlantDAO();
        $this->klantDAO->update($email, $adresId);
    }

}
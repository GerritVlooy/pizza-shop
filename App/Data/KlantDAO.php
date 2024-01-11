<?php
//App/Data/KlantDAO.php
declare(strict_types = 1);
namespace App\Data;
use PDO;
use App\Data\DBConfig;
use App\Data\AdresDAO;
use App\Entities\Klant;
use App\Entities\Adres;

class KlantDAO extends DBConfig{

    public function getByEmail(string $email): ?Klant {
        $sql = "SELECT klant_id, naam, voornaam, email, adres_id, telefoon_gsm, wachtwoord, opmerkingen 
                FROM klanten 
                WHERE email = :email";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($rij === false) {
            return null;
        }

        $adresDAO = new AdresDAO();
        $adres = $adresDAO->getById((int) $rij['adres_id']);
        if($rij['opmerkingen'] === null) {
            $rij['opmerkingen'] = "";
        }
        
        $klant = new Klant(
            (int) $rij['klant_id'], 
            $rij['naam'], 
            $rij['voornaam'], 
            $email, 
            $adres, 
            $rij['telefoon_gsm'], 
            $rij ['wachtwoord'],
            $rij['opmerkingen']
        );

        $dbh = null;
        return $klant;
    }

    public function create(
        string $naam,
        string $voornaam,
        string $email,
        int $adresId,
        string $telefoonGSM,
        string $wachtwoord
    ) {
        $sql = "INSERT INTO klanten (naam, voornaam, email, adres_id, telefoon_gsm, wachtwoord, opmerkingen) 
                VALUES (:naam, :voornaam, :email, :adres_id, :telefoon_gsm, :wachtwoord, :opmerkingen)";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':naam' => $naam,
            ':voornaam' => $voornaam,
            ':email' => $email,
            ':adres_id' => $adresId,
            ':telefoon_gsm' => $telefoonGSM,
            ':wachtwoord' => $wachtwoord,
            ':opmerkingen' => ""
        ));

        $dbh = null;
    }

}
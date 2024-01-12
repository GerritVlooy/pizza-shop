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

    private AdresDAO $adresDAO;

    public function __construct()
    {
        $this->adresDAO = new AdresDAO();
    }

    public function getByEmail(string $email): ?Klant {
        $sql = "SELECT klant_id, naam, voornaam, email, adres_id, telefoon_gsm, wachtwoord 
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

        $adres = $this->adresDAO->getById((int) $rij['adres_id']);
        
        $klant = new Klant(
            (int) $rij['klant_id'], 
            $rij['naam'], 
            $rij['voornaam'], 
            $email, 
            $adres, 
            $rij['telefoon_gsm'], 
            $rij ['wachtwoord']
        );

        $dbh = null;
        return $klant;
    }

    public function getById(int $id): Klant {
        $sql = "SELECT klant_id, naam, voornaam, email, adres_id, telefoon_gsm, wachtwoord 
                FROM klanten 
                WHERE klant_id = :klant_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klant_id' => $id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $adres = $this->adresDAO->getById((int) $rij['adres_id']);
        
        if($rij['email'] === null) {
            $rij['email'] === "";
            $rij['wachtwoord'] === "";
        }
        
        $klant = new Klant(
            $id, 
            $rij['naam'], 
            $rij['voornaam'], 
            $rij["email"], 
            $adres, 
            $rij['telefoon_gsm'], 
            $rij ['wachtwoord']
        );

        $dbh = null;
        return $klant;
    }

    public function create(
        string $naam,
        string $voornaam,
        ?string $email,
        int $adresId,
        string $telefoonGSM,
        ?string $wachtwoord
    ): int {
        $sql = "INSERT INTO klanten (naam, voornaam, email, adres_id, telefoon_gsm, wachtwoord) 
                VALUES (:naam, :voornaam, :email, :adres_id, :telefoon_gsm, :wachtwoord)";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':naam' => $naam,
            ':voornaam' => $voornaam,
            ':email' => $email,
            ':adres_id' => $adresId,
            ':telefoon_gsm' => $telefoonGSM,
            ':wachtwoord' => $wachtwoord
        ));

        $klantId = $dbh->lastInsertId();

        $dbh = null;

        return (int) $klantId;
    }

    public function update(
        string $email, 
        int $adresId,
        ) {
            $sql = "UPDATE klanten SET adres_id = :adres_id
                    WHERE email = :email";

            $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

            $stmt = $dbh->prepare($sql);

            $stmt->execute(array(
                ':adres_id' => $adresId,
                ':email' => $email
            ));
            
            $dbh = null;
    }

}
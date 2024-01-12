<?php
//App/Data/AdresDAO.php
declare(strict_types = 1);
namespace App\Data;
use PDO;
use App\Data\DBConfig;
use App\Data\WoonplaatsDAO;
use App\Entities\Woonplaats;
use App\Entities\Adres;

class AdresDAO extends DBConfig {

    private WoonplaatsDAO $woonplaatsDAO;

    public function __construct()
    {
        $this->woonplaatsDAO = new WoonplaatsDAO();
    }

    public function getById(int $id): Adres {
        $sql = "SELECT adres_id, straat, huisnummer, woonplaats_id FROM adressen WHERE adres_id = :adres_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':adres_id' => $id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $woonplaats = $this->woonplaatsDAO->getById((int) $rij['woonplaats_id']);
        $adres = new Adres($id, $rij['straat'], $rij['huisnummer'], $woonplaats);

        $dbh = null;
        return $adres;
    }

    public function getByParameters(string $straat, string $huisnummer, int $woonplaatsId): ?Adres {
        $sql = "SELECT adres_id, straat, huisnummer, woonplaats_id 
            FROM adressen 
            WHERE straat = :straat
            AND huisnummer = :huisnummer
            AND woonplaats_id = :woonplaats_id;";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':straat' => $straat, 
            ':huisnummer' => $huisnummer, 
            ':woonplaats_id' => $woonplaatsId
        ));

        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rij === false) {
            return null;
        }
       
        $woonplaats = $this->woonplaatsDAO->getById($woonplaatsId);

        $adres = new Adres((int) $rij["adres_id"], $straat, $huisnummer, $woonplaats );

        $dbh = null;
        return $adres;
    }

    public function create(string $straat, string $huisnummer, int $woonplaatsId) {
        $sql = "INSERT INTO adressen (straat, huisnummer, woonplaats_id) 
            VALUES (:straat, :huisnummer, :woonplaats_id)";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':straat' => $straat, 
            ':huisnummer' => $huisnummer,
            ':woonplaats_id' => $woonplaatsId
        ));

        $dbh = null;
    }

}
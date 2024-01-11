<?php
//App/Data/WoonplaatsDAO.php
declare(strict_types = 1);
namespace App\Data;
use PDO;
use App\Data\DBConfig;
use App\Entities\Woonplaats;
use App\Exceptions\WoonplaatsBestaatNietException;

class WoonplaatsDAO extends DBConfig {

    public function getByNaamAndPostcode (string $woonplaatsNaam, int $postcode): Woonplaats {
        $sql = "SELECT woonplaats_id, woonplaats_naam, postcode FROM woonplaatsen 
            WHERE woonplaats_naam = :woonplaats_naam AND postcode = :postcode" ;

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':woonplaats_naam' => $woonplaatsNaam,
            ':postcode' => $postcode
        ));

        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rij === false) {
            throw new WoonplaatsBestaatNietException();
        }

        $woonplaats = new Woonplaats((int) $rij['woonplaats_id'], $woonplaatsNaam, $postcode);
        $dbh = null;
        return $woonplaats;
    }
    
    public function getById($id): Woonplaats {
        $sql = "SELECT woonplaats_id, woonplaats_naam, postcode FROM woonplaatsen 
            WHERE woonplaats_id = :woonplaats_id";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME,
            parent::$DB_PASSWORD);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':woonplaats_id' => $id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $woonplaats = new Woonplaats($id, $rij['woonplaats_naam'], (int) $rij['postcode']);
        $dbh = null;
        return $woonplaats;
    }
}
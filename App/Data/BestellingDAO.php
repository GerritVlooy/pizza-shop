<?php
// App/Data/BestellingDAO.php
declare(strict_types=1);

namespace App\Data;

use PDO;
use App\Data\DBConfig;
use App\Entities\Bestelling;
use App\Entities\Klant;

class BestellingDAO extends DBConfig
{
    public function create(int $klantId, string $opmerkingen): int
    {
        $sql = "INSERT INTO bestellingen (klant_id, opmerkingen, bestelling_datum) VALUES (:klant_id, :opmerkingen, NOW())";

        $dbh = new PDO(parent::$DB_CONNSTRING, parent::$DB_USERNAME, parent::$DB_PASSWORD);
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':klant_id' => $klantId, ':opmerkingen' => $opmerkingen));

        $bestellingId = $dbh->lastInsertId();

        $dbh = null;

        return (int) $bestellingId;
    }

}
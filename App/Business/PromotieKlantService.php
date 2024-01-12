<?php
// App/Business/PromotieKlantService.php
declare(strict_types=1);

namespace App\Business;

use App\Data\PromotieKlantDAO;
use App\Entities\PromotieKlant;

class PromotieKlantService
{
    private PromotieKlantDAO $promotieKlantDAO;

    public function __construct()
    {
        $this->promotieKlantDAO = new PromotieKlantDAO();
    }

    public function getPromotieKlantenByKlantId(int $klantId): array
    {
        return $this->promotieKlantDAO->getByKlantId($klantId);
    }
}
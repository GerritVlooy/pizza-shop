<?php
//Tests/IngredientDAOTest.php
declare(strict_types = 1);
namespace Tests;
use PHPUnit\Framework\TestCase;
use PDO;
use App\Data\DBConfig;
use App\Data\IngredientDAO;
use App\Entities\Ingredient;

class IngredientDAOTest extends TestCase {

    private IngredientDAO $ingredientDAO;

    public function setup(): void {
        $this->ingredientDAO = new IngredientDAO();
    }

    /** @test */

    public function object_can_retrieve_by_naam() {
        $this->assertTrue($this->ingredientDAO->getIngredientByNaam("Tomaat"));
    }
}
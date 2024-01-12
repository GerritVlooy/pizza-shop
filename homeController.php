<?php
// homeController.php
declare(strict_types = 1);
require_once("bootstrap.php");
require_once("winkelwagenController.php");

use App\Business\PizzaService;
use App\Business\IngredientService;
use App\Business\PromotiePizzaService;
use App\Entities\Klant;

$title = "Home";
$view = "App/Presentation/home/index.php";
$winkelwagen = "App/Presentation/winkelwagen/index.php";
$pizzaService = new PizzaService();
$promotiePizzaService = new PromotiePizzaService();
$ingredientService = new IngredientService();

$klantHomeId = 0;
if (isset($_SESSION["login"])) {
    $klantHome = unserialize($_SESSION['klant']);
    $klantHomeId = $klantHome->getId();
}

$pizzaLijst = $pizzaService->getPizzasGeenPromo();
$ingredientLijst = $ingredientService->getIngredienten();

require_once "App/Presentation/template.php";
<?php
// homeController.php
declare(strict_types = 1);
require_once("bootstrap.php");
require_once("winkelwagenController.php");

use App\Business\PizzaService;
use App\Business\IngredientService;

$title = "Home";
$view = "App/Presentation/home/index.php";
$winkelwagen = "App/Presentation/winkelwagen/index.php";
$pizzaService = new PizzaService();
$ingredientService = new IngredientService();
$pizzaLijst = $pizzaService->getPizzas();
$ingredientLijst = $ingredientService->getIngredienten();

require_once "App/Presentation/template.php";
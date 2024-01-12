<?php
// App/Entities/BesteldeIngredient.php
declare(strict_types=1);

namespace App\Entities;

use App\Entities\Ingredient;
use App\Entities\BesteldePizza;

class BesteldeIngredient
{
    private int $besteldeIngredientId;
    private Ingredient $ingredient;
    private BesteldePizza $besteldePizza;

    public function __construct(int $besteldeIngredientId, Ingredient $ingredient, int $besteldePizza)
    {
        $this->besteldeIngredientId = $besteldeIngredientId;
        $this->ingredient = $ingredient;
        $this->besteldePizza = $besteldePizza;
    }

    public function getBesteldeIngredientId(): int
    {
        return $this->besteldeIngredientenId;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function getBesteldePizza(): BesteldePizza
    {
        return $this->besteldePizza;
    }
}
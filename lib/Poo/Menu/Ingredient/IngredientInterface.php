<?php

namespace Poo\Menu\Ingredient;

interface IngredientInterface extends \Poo\Price\PriceableInterface
{
    /**
     * @return string
     */
    public function getName();
}

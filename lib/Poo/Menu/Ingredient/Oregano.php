<?php

namespace Poo\Menu\Ingredient;

class Oregano extends IngredientInterface
{
    /**
     * @see IngredientInterface::getName()
     */
    public function getName()
    {
        return 'Oregano';
    }

    /**
     * @see PayableInterface::getPrice()
     */
    public function getPrice()
    {
        return 0.0;
    }
}

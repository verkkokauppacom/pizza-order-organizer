<?php

namespace Poo\Menu\Ingredient;

class Garlic extends IngredientInterface
{
    /**
     * @see IngredientInterface::getName()
     */
    public function getName()
    {
        return 'Garlic';
    }

    /**
     * @see PayableInterface::getPrice()
     */
    public function getPrice()
    {
        return 1.0;
    }
}

<?php

namespace Poo\Menu\Ingredient;

class IngredientCollection implements IngredientCollectionInterface
{
    /**
     * List of IngredientInterface objects.
     *
     * @var array
     */
    private $ingredients = array();

    /**
     * @param IngredientInterface $ingredient
     * @return $this
     */
    public function add(IngredientInterface $ingredient)
    {
        $this->ingredients[] = $ingredient;

        return $this;
    }

    /**
     * @see ArrayObject::getIterator()
     */
    public function getIterator()
    {
        // This iterator allows to unset and modify values and keys while iterating over Arrays and Objects.
        return new \ArrayIterator($this->ingredients);
    }

    /**
     * @see PayableInterface::getPrice()
     */
    public function getPrice()
    {
        $price = 0;
        foreach ($this as $ingredient) {
            $price += $ingredient->getPrice();
        }

        return $price;
    }

    /**
     * @see Countable::count()
     */
    public function count()
    {
        return count($this->ingredients);
    }
}

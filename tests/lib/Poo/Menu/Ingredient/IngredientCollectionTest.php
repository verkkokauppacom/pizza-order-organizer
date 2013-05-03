<?php

namespace Poo\Menu\Ingredient;

class IngredientCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IngredientInterface
     */
    private $ingredientOregano;

    /**
     * @var IngredientInterface
     */
    private $ingredientPork;

    /**
     * @var IngredientInterface
     */
    private $ingredientSalami;

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        parent::setUp();

        $this->ingredientOregano = new Ingrediment_Mock('Oregano', 0.0);
        $this->ingredientPork = new Ingrediment_Mock('Pork', 0.7);
        $this->ingredientSalami = new Ingrediment_Mock('Salami', 1.3);
    }

    public function testAddIngredients()
    {
        $ingredientCollection = new IngredientCollection();
        $this->assertCount(0, $ingredientCollection->getIterator());

        $ingredientCollection->add($this->ingredientOregano);
        $iterator = $ingredientCollection->getIterator();
        $this->assertCount(1, $iterator);
        $this->assertCount(1, $ingredientCollection);
        $this->assertEquals(0.0, $ingredientCollection->getPrice());

        $ingredientCollection->add($this->ingredientPork);
        $iterator = $ingredientCollection->getIterator();
        $this->assertCount(2, $iterator);
        $this->assertCount(2, $ingredientCollection);
        $this->assertEquals(0.7, $ingredientCollection->getPrice());

        $ingredientCollection->add($this->ingredientSalami);
        $iterator = $ingredientCollection->getIterator();
        $this->assertCount(3, $iterator);
        $this->assertCount(3, $ingredientCollection);
        $this->assertEquals(2.0, $ingredientCollection->getPrice());
    }

    public function testSortIngredients()
    {
        $ingredientCollection = new IngredientCollection();

        $ingredientCollection->add($this->ingredientPork);
        $ingredientCollection->add($this->ingredientOregano);
        $ingredientCollection->add($this->ingredientSalami);

        $expected = array('Pork', 'Oregano', 'Salami');
        /** @var $ingredient IngredientInterface */
        foreach ($ingredientCollection as $ingredient) {
            $this->assertSame(current($expected), $ingredient->getName());
            next($expected);
        }

        $iterator = $ingredientCollection->getIterator();
        $iterator->uasort(function (IngredientInterface $a, IngredientInterface $b) {
            return $a->getName() < $b->getName() ? -1 : 1;
        });

        $expected = array('Oregano', 'Pork', 'Salami');
        /** @var $ingredient IngredientInterface */
        foreach ($iterator as $ingredient) {
            $this->assertSame(current($expected), $ingredient->getName());
            next($expected);
        }
    }

    /**
     * @param string $name
     * @param float $price
     * @return IngredientInterface
     */
    private function getIngredientMock($name, $price)
    {
        $mock = $this->getMock('\\Poo\\Menu\\Ingredient\\IngredientInterface');

        $mock->expects($this->any())
            ->method('getPrice')
            ->will($this->returnValue($price));

        $mock->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($name));

        return $mock;
    }
}

class Ingrediment_Mock implements IngredientInterface
{
    private $name;
    private $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
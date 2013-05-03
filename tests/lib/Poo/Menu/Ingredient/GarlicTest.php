<?php

namespace Poo\Menu\Ingredient;

class GarlicTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $oregano = new Garlic();

        $this->assertEquals('Garlic', $oregano->getName());
        $this->assertEquals(1.0, $oregano->getPrice());
    }
}

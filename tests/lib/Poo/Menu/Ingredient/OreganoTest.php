<?php

namespace Poo\Menu\Ingredient;

class OreganoTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $oregano = new Oregano();

        $this->assertEquals('Oregano', $oregano->getName());
        $this->assertEquals(0, $oregano->getPrice());
    }
}

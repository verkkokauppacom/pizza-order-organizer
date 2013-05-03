<?php

namespace Poo\Menu;

class PizzaTest extends \PHPUnit_Framework_TestCase
{
    public function testSetterAndGetters()
    {
        $pizza = new Pizza();

        $number = 'U2';
        $this->assertSame($pizza, $pizza->setNumber($number));
        $this->assertEquals($number, $pizza->getNumber());

        $name = 'My Pizza';
        $this->assertSame($pizza, $pizza->setName($name));
        $this->assertEquals($name, $pizza->getName());

        $price = 8.50;
        $this->assertSame($pizza, $pizza->setPrice($price));
        $this->assertEquals($price, $pizza->getPrice());

        $paymentMethodMock = $this->getMock('\\Poo\\PaymentMethod\\PaymentMethodInterface');
        $this->assertSame($pizza, $pizza->setPayment($paymentMethodMock));
        $this->assertSame($paymentMethodMock, $pizza->getPayment());
    }

    public function testOregano()
    {
        $pizza = new Pizza();

        $this->assertFalse($pizza->hasOregano());
        $this->assertSame($pizza, $pizza->setHasOregano(true));
        $this->assertTrue($pizza->hasOregano());
    }


    public function testGarlic()
    {
        $pizza = new Pizza();

        $price = 5;
        $pizza->setPrice($price);
        $this->assertEquals($price, $pizza->getPrice());

        $this->assertFalse($pizza->hasGarlic());
        $this->assertSame($pizza, $pizza->setHasGarlic(true));
        $this->assertTrue($pizza->hasGarlic());

        $price = 6;
        $this->assertEquals($price, $pizza->getPrice());

        $pizza->setHasGarlic(false);
        $price = 5;
        $this->assertEquals($price, $pizza->getPrice());
    }
}

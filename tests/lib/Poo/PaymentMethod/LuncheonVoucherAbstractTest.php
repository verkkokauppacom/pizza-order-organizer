<?php

namespace Poo\PaymentMethod;

class LuncheonVoucherAbstractTest extends \PHPUnit_Framework_Testcase
{
    public function testGetTitle()
    {
        $mock = $this->getMockBuilder('\\Poo\PaymentMethod\\LuncheonVoucherAbstract')
            ->setMethods(array())
            ->getMockForAbstractClass();

        $this->assertEquals('Lounasseteli', $mock->getTitle());
    }
}

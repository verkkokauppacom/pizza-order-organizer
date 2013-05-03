<?php

namespace Poo\PaymentMethod;

class LounasSeteli930Test extends \PHPUnit_Framework_Testcase
{
    public function testgetPrice()
    {
        $lounasSeteli = new Lounasseteli930();

        $this->assertEquals(9.30, $lounasSeteli->getPrice());
    }
}

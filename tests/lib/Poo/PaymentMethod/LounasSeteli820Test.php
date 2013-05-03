<?php

namespace Poo\PaymentMethod;

class LounasSeteli820Test extends \PHPUnit_Framework_Testcase
{
    public function testgetPrice()
    {
        $lounasSeteli = new Lounasseteli820();

        $this->assertEquals(8.20, $lounasSeteli->getPrice());
    }
}
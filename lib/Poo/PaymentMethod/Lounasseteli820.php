<?php

namespace Poo\PaymentMethod;

class Lounasseteli820 extends LuncheonVoucherAbstract
{
    /**
     * @see PayableInterface::getPrice()
     */
    public function getPrice()
    {
        return 8.20;
    }
}


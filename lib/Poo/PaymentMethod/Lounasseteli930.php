<?php

namespace Poo\PaymentMethod;

class Lounasseteli930 extends LuncheonVoucherAbstract
{
    /**
     * @see PayableInterface::getPrice()
     */
    public function getPrice()
    {
        return 9.30;
    }
}


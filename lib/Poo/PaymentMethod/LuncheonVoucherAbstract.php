<?php

namespace Poo\PaymentMethod;

abstract class LuncheonVoucherAbstract implements PaymentMethodInterface
{
    /**
     * @see PaymentMethodInterface::getTitle()
     */
    public function getTitle()
    {
        return 'Lounasseteli';
    }
}


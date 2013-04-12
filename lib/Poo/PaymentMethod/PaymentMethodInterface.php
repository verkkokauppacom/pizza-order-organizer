<?php

namespace Poo\PaymentMethod;

use Poo\Price\PriceableInterface;

interface PaymentMethodInterface extends PriceableInterface
{
    /**
     * @return string
     */
    public function getTitle();
}


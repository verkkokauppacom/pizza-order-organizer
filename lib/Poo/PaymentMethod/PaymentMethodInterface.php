<?php

namespace Poo\PaymentMethod;

use Poo\Price\PayableInterface;

interface PaymentMethodInterface extends PayableInterface
{
    /**
     * @return string
     */
    public function getTitle();
}


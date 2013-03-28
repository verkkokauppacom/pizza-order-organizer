<?php

namespace Poo\Price;

interface PayableInterface
{
    /**
     * @return float
     */
    public function getPrice();
}


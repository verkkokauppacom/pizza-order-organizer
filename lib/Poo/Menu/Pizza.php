<?php

namespace Poo\Menu;

use Poo\Price\PriceableInterface;
use Poo\PaymentMethod\PaymentMethodInterface;

class Pizza implements PriceableInterface
{
    private $number;
    private $name;
    private $price;
    private $payment;
    private $hasOregano;
    private $hasGarlic;

    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPayment(PaymentMethodInterface $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    public function getPayment()
    {
        return $this->payment;
    }

    public function setHasOregano($hasOregano = true)
    {
        $this->hasOregano = $hasOregano;

        return $this;
    }

    public function hasOregano()
    {
        return $this->hasOregano;
    }

    public function setHasGarlic($hasGarlic = true)
    {
        $hasGarlic = (bool) $hasGarlic;

        if (true === $this->hasGarlic && false === $hasGarlic) {
            ++$this->price;
        } elseif (false === $this->hasGarlic && true === $hasGarlic) {
            --$this->price;
        }

        $this->hasGarlic = $hasGarlic;

        return $this;
    }

    public function hasGarlic()
    {
        return $this->hasGarlic;
    }
}

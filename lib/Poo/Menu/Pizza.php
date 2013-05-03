<?php

namespace Poo\Menu;

use Poo\Price\PriceableInterface;
use Poo\PaymentMethod\PaymentMethodInterface;

class Pizza implements PriceableInterface
{
    /**
     * @var $mixed
     */
    private $number;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var PaymentMethodInterface
     */
    private $payment;

    /**
     * @var boolean
     */
    private $hasOregano = false;

    /**
     * @var boolean
     */
    private $hasGarlic = false;

    /**
     * @param mixed $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param PaymentMethodInterface $payment
     * @return $this
     */
    public function setPayment(PaymentMethodInterface $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * @return PaymentMethodInterface
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param boolean $hasOregano
     * @return $this
     */
    public function setHasOregano($hasOregano = true)
    {
        $this->hasOregano = $hasOregano;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasOregano()
    {
        return $this->hasOregano;
    }

    /**
     * @param boolean $hasGarlic
     * @return $this
     */
    public function setHasGarlic($hasGarlic = true)
    {
        $hasGarlic = (bool) $hasGarlic;

        if (false === $this->hasGarlic && true === $hasGarlic) {
            ++$this->price;
        } elseif (true === $this->hasGarlic && false === $hasGarlic) {
            --$this->price;
        }

        $this->hasGarlic = $hasGarlic;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasGarlic()
    {
        return $this->hasGarlic;
    }
}

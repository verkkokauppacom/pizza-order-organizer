<?php

namespace Poo\Input;

use Poo\PaymentMethod\Lounasseteli820;
use Poo\PaymentMethod\Lounasseteli930;

use Poo\Menu\Pizza;

class UserInput
{
    public function readLine()
    {
        $input = trim(func_get_arg(0));

        $matches = array();
        if (preg_match('/^([a-z]+)\s+(\S+)\s+("[^"]+")\s+(\d+(.\d)?)(\s*[OVRL]+)?$/i', $input, $matches)) {

            if (false === array_key_exists(6, $matches)) {
                $matches[6] = '';
            }

            $pizza = new Pizza();
            $pizza->setNumber($matches[2]);
            $pizza->setNumber($matches[3]);

            $pizza->setPrice($matches[4]);
            $payment = stristr($matches[6], 'R') ? new Lounasseteli820() : new Lounasseteli930();
            $pizza->setPayment($payment);

            $pizza->setHasOregano((bool) stristr($matches[6], 'O'));
            $pizza->setHasGarlic((bool) stristr($matches[6], 'V'));

            $user = $matches[1];
            return array($user => $pizza);
        }

        return null;
    }
}

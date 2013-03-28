<?php

namespace Poo;

use Poo\PaymentMethod\Lounasseteli820;
use Poo\PaymentMethod\Lounasseteli930;

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
            return array($matches[1] => array(
                'pizza_number' => $matches[2],
                'pizza_name' => $matches[3],
                'price' => $matches[4],
                'payment' => stristr($matches[6], 'R') ? new Lounasseteli820() : new Lounasseteli930(),
                'is_oregano' => (bool) stristr($matches[6], 'O'),
                'is_garlic' => (bool) stristr($matches[6], 'V'),
            ));
        }

        return false;
    }
}

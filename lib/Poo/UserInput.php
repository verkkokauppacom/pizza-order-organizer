<?php

namespace Poo;

class UserInput
{
    public function readLine()
    {
        $input = trim(func_get_arg(0));

        $matches = array();
        if (preg_match('/^([a-z]+)\s+(\S+)\s+("[^"]+")\s+(\d+(.\d)?)(\s*[OVRL]+)?$/i', $input, $matches)) {

            return array($matches[1] => array(
                'pizza_number' => $matches[2],
                'pizza_name' => $matches[3],
                'price' => $matches[4],
                'payment' => stristr($matches[6], 'R') ? REAKTOR_LOUNARI : LOUNARI,
                'is_oregano' => (bool) stristr($matches[6], 'O'),
                'is_garlic' => (bool) stristr($matches[6], 'V'),
            ));
        }

        return false;
    }
}

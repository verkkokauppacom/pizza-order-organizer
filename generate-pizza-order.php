<?php

const PRICE_LIMU = 3.5;

const PIZZA_URL = 'http://pizzaexpress-lauttasaari.pizza-online.fi/index.php';

spl_autoload_register(function ($className) {
    set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/lib');

    $className = str_replace('\\', '/', ltrim($className, '\\')) . '.php';
    require_once $className;
});

use Poo\Menu\Pizza;

$userInput = new Poo\Input\UserInput();

/**
 * @see http://pizzaexpress-lauttasaari.pizza-online.fi/index.php
 */

$pizzaOrders = array();
$requests = array_filter(explode(PHP_EOL, <<<EOF
tommy 35 "RIISIKEBAB" 7.5 L
maxr 35 "RIISIKEBAB" 7.5 L
pasihu 17 "HOT-LOVER" 7.5 OL
juhaj 4 "ROMEO" 7.5 OL
jessesan 10 "SWEET DREAMS" 7.5 OL
samika 42 "RULLAKEBAB" 7.5 L
mattinie 35 "RIISIKEBAB" 7.5 L
siruhu 12 "POWER" 8 OVL
hewe 2 "ROMANTICA" 7.0 OL
nikok 16 "EX-LOVER" 8 OL
timom ? "SPECIALKEBAB" 8.2 L
samisy 42 "RULLAKEBAB" 7.5 L
jussitai 17 "HOT-LOVER" 7.5 OVL
mikkom U1 "SYNTTÄRI PIZZA" 8.5 L
mirko U1 "SYNTTÄRI PIZZA" 8.5 OVL
vesap 1 "FIRST LOVE" 6.5 O
EOF
));

foreach ($requests as $input) {
    $parsed = $userInput->readLine($input);
    if (null === $parsed) {
        echo "Error in line " . $input . PHP_EOL;
        continue;
    }

    $pizzaOrders[key($parsed)] = current($parsed);
}

/**
 * Sorts orders by pizzanumber
 *
 * @param array &$orders
 * @return void
 */
function sortByPizzaNumber(array & $orders)
{
    uasort($orders, function(Pizza $pizza1, Pizza $pizza2) {
        if ($pizza1->getNumber() == $pizza2->getNumber()) {
            return 0;
        }

        return ($pizza1->getNumber() < $pizza2->getNumber() ? -1 : 1);
    });
}

sortByPizzaNumber($pizzaOrders);

$totalPrice = 0;
$totalPayment = 0;

foreach ($pizzaOrders as $user => $pizza) {
    $totalPrice += $pizza->getPrice();
    $totalPayment += $pizza->getPayment()->getPrice();

    $mausteet = '';

    $mausteArray = array();

    if (true === $pizza->hasOregano()) {
        $mausteArray[] = 'o';
    }
    if (true === $pizza->hasGarlic()) {
        $mausteArray[] = 'v';
    }
    if (count($mausteArray) > 0) {
        $mausteet = '(' . implode(',', $mausteArray) . ')';
    }

    echo "[ ] " . str_pad($user, 10). " " . str_pad($pizza->getNumber(), 2, ' ', STR_PAD_LEFT) . "."  . str_pad(ucwords(strtolower($pizza->getName())) . ' ' . $mausteet, 25) . " [maksu: " . $pizza->getPayment()->getPrice() . ", hinta: " . $pizza->getPrice() . "]\n";
}

$limuRaha = $totalPayment - $totalPrice;
$limuCount = floor($limuRaha / PRICE_LIMU);

echo "Hinta yhteensä: {$totalPrice}€" . PHP_EOL;
echo "Maksu yhteensä: {$totalPayment}€" . PHP_EOL;
echo "Limurahaa jää: {$limuRaha}€, limuja saadaan siis {$limuCount} kpl." . PHP_EOL;
echo "alahan tilailee: " . PIZZA_URL . PHP_EOL;

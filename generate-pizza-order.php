<?php

const LOUNARI = 9.3;
const R_LOUNARI = 8.2; // Reaktor-lounari

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
nikok 16 "EX-LOVER" 8 OVL
juhaj 3 "JULIA" 7.5 OL
samulisii 4 "ROMEO" 7.5 OR
samisy 38 "Iskender Kebab" 7.5 OVR
mattinie 35 "Riisikebab" 7.5 L
samika 23 "Express Special" 8 L
hewe 2 "ROMANTICA" 7 OL
timom  33 "Special kebab " 8.5 L
maxr 18 "Riviera" 7.5 OVL
mirko 38 "Iskender Kebab" 7.5 L
mikkom 38 "Iskender Kebab" 7.5 L
vesap 5 "Wedding" 7.5 O
tonis U3 "Passion Pizza" 8.5 L
pasihu 17 "Hot-lover" 7.5 L
EOF
));

foreach ($requests as $input) {
    $parsed = $userInput->readLine($input);
    if (null !== $parsed) {
        $pizzaOrders[key($parsed)] = current($parsed);
    }
}

/**
 * Sorts orders by pizzanumber
 *
 * @param array &$orders
 * @return void
 */
function sortByPizzaNumber(array &$orders)
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

echo "Hinta yhteensä: {$totalPrice}€\n";
echo "Maksu yhteensä: {$totalPayment}€\n";
echo "Limurahaa jää: {$limuRaha}€, limuja saadaan siis {$limuCount} kpl.\n";
echo "alahan tilailee: " . PIZZA_URL . "\n";

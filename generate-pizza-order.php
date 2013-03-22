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

$userInput = new Poo\UserInput();

/**
 * @see http://pizzaexpress-lauttasaari.pizza-online.fi/index.php
 */


$pizzaOrders = array();
$requests = array_filter(explode(PHP_EOL, <<<EOF
juhaj 4 "ROMEO" 7.5 VOL
samika  42 "Rullakebab" 7.5 VL
mikkom 38 "ISKENDER kebab" 7.5 OL
mirko 36 "Ranskalainen kebab" 7.5 L
EOF
));

foreach ($requests as $input) {
    $parsed = $userInput->readLine($input);
    if (false !== $parsed) {
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
    uasort($orders, function($row1, $row2) {
        if ($row1['pizza_number'] == $row2['pizza_number']) {
            return 0;
        }

        return ($row1['pizza_number'] < $row2['pizza_number'] ? -1 : 1);
    });
}

sortByPizzaNumber($pizzaOrders);

$totalPrice = 0;
$totalPayment = 0;

foreach ($pizzaOrders as $user => $order) {
    $totalPrice += $order['price'];
    $totalPayment += $order['payment'];

    $mausteet = '';

    $mausteArray = array();

    if ($order['is_oregano']) $mausteArray[] = 'o';
    if ($order['is_garlic'])  $mausteArray[] = 'v';

    if (count($mausteArray) > 0) {
        $mausteet = '(' . implode(',', $mausteArray) . ')';
    }

    echo "[ ] " . str_pad($user, 10). " " . str_pad($order['pizza_number'], 2, ' ', STR_PAD_LEFT) . "."  . str_pad(ucwords(strtolower($order['pizza_name'])) . ' ' . $mausteet, 25) . " [maksu: " . $order['payment'] . ", hinta: " . $order['price'] . "]\n";
}

$limuRaha = $totalPayment - $totalPrice;
$limuCount = floor($limuRaha / PRICE_LIMU);

echo "Hinta yhteensä: {$totalPrice}€\n";
echo "Maksu yhteensä: {$totalPayment}€\n";
echo "Limurahaa jää: {$limuRaha}€, limuja saadaan siis {$limuCount} kpl.\n";
echo "alahan tilailee: " . PIZZA_URL . "\n";

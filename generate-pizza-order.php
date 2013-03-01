<?php

/**
 * @see http://pizzaexpress-lauttasaari.pizza-online.fi/index.php
 */

const LOUNARI = 9.3;
const R_LOUNARI = 8.2; // Reaktor-lounari

const PRICE_LIMU = 3.5;

const PIZZA_URL = 'http://pizzaexpress-lauttasaari.pizza-online.fi/index.php';

$pizzaOrders = array(
    'juhaj'   => array('pizza_number' => 4,  'pizza_name' => 'ROMEO',              'is_oregano' => true,  'is_garlic' => true,  'price' => 7.5,  'payment' => LOUNARI),
    'samika'  => array('pizza_number' => 42, 'pizza_name' => 'Rullakebab',         'is_oregano' => false, 'is_garlic' => true,  'price' => 7.5,  'payment' => LOUNARI),
    'mikkom'  => array('pizza_number' => 38, 'pizza_name' => 'ISKENDER kebab',     'is_oregano' => true,  'is_garlic' => false, 'price' => 7.50, 'payment' => LOUNARI),
    'mirko'   => array('pizza_number' => 36, 'pizza_name' => 'Ranskalainen kebab', 'is_oregano' => false, 'is_garlic' => false, 'price' => 7.50, 'payment' => LOUNARI),
);

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

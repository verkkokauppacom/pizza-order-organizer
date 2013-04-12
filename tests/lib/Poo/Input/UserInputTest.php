<?php

namespace Poo\Input;

class UserInputTest extends \PHPUnit_Framework_TestCase
{
    public function testReadLine()
    {
        $userInput = new UserInput();

        $requests = array_filter(explode(PHP_EOL, <<<EOF
user 1 "User Pizza" 9 LO
MYNAME 777 "Fantastical" 8.3 L
EOF
        ));

        foreach ($requests as $line) {
            $interpreted = $userInput->readLine($line);

            $pizza = current($interpreted);
            $this->assertTrue(is_numeric($pizza->getPrice()));
        }
    }
}


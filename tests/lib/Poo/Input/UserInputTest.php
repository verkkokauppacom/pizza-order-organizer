<?php

namespace Poo\Input;

class UserInputTest extends \PHPUnit_Framework_TestCase
{
    public function testReadLineSuccess()
    {
        $userInput = new UserInput();

        $requests = array_filter(explode(PHP_EOL, <<<EOF
user 1 "User Pizza" 9 LO
MYNAME 777 "Fantastical" 8.3
EOF
        ));

        foreach ($requests as $line) {
            $interpreted = $userInput->readLine($line);

            $pizza = current($interpreted);
            $this->assertTrue(is_numeric($pizza->getPrice()));
        }
    }

    public function testReadLineFailure()
    {
        $userInput = new UserInput();

        $this->assertNull($userInput->readLine('foo'));
    }
}

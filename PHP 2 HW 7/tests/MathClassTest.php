<?php

use PHPUnit\Framework\TestCase;
use app\models\entities\MathClass;

class MathClassTest extends TestCase
{
    protected $fixture;

    //TODO этот код выдаёт следующее
    // Fatal error: Declaration of MathClassTest::setUp() must be compatible with PHPUnit\Framework\TestCase::setUp():
    // void in C:\Program Files (x86)\OpenServer\domains\Now\tests\MathClassTest.php on line 9
   /* protected function TestCase::setUp()
    {
        $this->fixture = new MathClass();
    }
    protected function tearDown()
    {
        $this->fixture = NULL;
    }*/

    /**
     * @dataProvider providerFactorial
     */

    public function testFactorial($a, $b)
    {
        $my = new MathClass();
        $this->assertEquals($b, $my->factorial($a));
    }
    public function providerFactorial()
    {
        return array (
            array (0, 1),
            array (2, 2),
            array (5, 120)
        );
    }


// c помощью провайдера можно сразу задать массив переменных для подстановки в функцию

// vendor\bin\phpunit tests/MathClassTest.php

/*В результате теста получаем:
...
Time: 437 ms, Memory: 7.75Mb
OK (3 tests, 3 assertions)

Три точки в начале скрипта – не опечатка. Каждая из них означает один успешно пройденный тест.
 Если на каком-либо тесте произойдет ошибка сравнения, вместо точки появится буква F*/
}
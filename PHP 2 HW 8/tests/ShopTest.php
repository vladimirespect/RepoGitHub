<?php

use PHPUnit\Framework\TestCase;

class ShopTest extends TestCase //создаём класс с именем что тестируем и приставкой Тест и наследуемся от ТестКейз
{
    //в свою очередь каждый метод тоже должен начинаться со слова test
    public function testAdd() {
        $x = 1;
        $y = 2;
        //$this-> через это нам доступно великое множество методов для сравнения
        $this->assertEquals(3, $x + $y);
        $this->assertTrue(true);
//пока не добавим путь в path, вызываем тест в терминале так:
        // vendor\bin\phpunit tests/ShopTest.php
    }

}
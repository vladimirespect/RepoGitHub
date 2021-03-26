<?php

use PHPUnit\Framework\TestCase;
use app\models\entities\Goods;
use app\models\repositories\GoodsRepository;

class GoodsTest extends TestCase
{
    // по хорошему метод пишется под каждый метод тестируемого класса и назыв-ся соответственно напр. testGoodsConstruct
    public function testGetTableName()
    {
        //protected убрано на время тестирования через PHP-unit
        $name = (new GoodsRepository())->getTableName();
        $this->assertEquals($name, 'goods');

    }


    public function testGoods()
    {
        $name = "Чай";
        $good = new Goods($name);
        $this->assertIsObject($good); //проверяем объект ли это
        $this->assertEquals($name, $good->name);//проверяем совпадает ли имя, записалось ли оно в поле объекта
        //пока не добавим путь в path, вызываем тест в терминале так:
        // vendor\bin\phpunit tests/GoodsTest.php
    }

    /* если не находит класс, нужно научить автозагрузчик phpunit из папки vendor видеть наш проект
    через редактирование файла composer.json таким образом
       "autoload": {
        "psr-4": {                //psr-4 это стандарт который был применён при создании наших классов,
    // условное  правило что каждый класс это отдельный файл, неймспейс совпадает с папкой и т.д.
            "app\\":""           //app это та приставка для неймспейса которую мы выбрали самой верхней, если бы после неё лежали ещё какие-то папки надо было бы указать и их после двоеточия
        }
    }
теперь перестраиваем автозагрузчик, чтобы он по этим параметрам переписал vendor'овский автозагрузчик и включил в его код и наши папки
    для этого в терминале вводим команду composer dump-autoload
Теперь тест vendor\bin\phpunit tests/GoodsTest.php работает

    Чтобы не запускать каждый тест отдельно создаём  в общей директории спец.файл phpunit.xml.dist

    <?xml version="1.0" encoding="utf-8" ?>
<phpunit bootstrap="./vendor/autoload.php">
    <testsuites>
        <testsuite name="main">
            <directory>tests</directory>           //tests имя папки в которой лежат тесты, и у них есть приставка Test
        </testsuite>
    </testsuites>
</phpunit>

    И после этого уже можно запускать все тесты через терминал такой командой vendor\bin\phpunit


    */

}
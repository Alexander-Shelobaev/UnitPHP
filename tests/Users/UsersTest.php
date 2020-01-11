<?php

use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    private $user;

    /**
     * Метод выполняется перед запуском теста,
     * используется для инициализации данных,
     * данный метод похож на конструктор теста
     */
    protected function setUp() :void
    {
        //$this->user = new app\classes\Users();
        $this->user = new app\Models\Users();
        $this->user->setAge(33);
        //$this->user->setEmail('alexander.shelobaev@gmail.com');
    }

    /**
     * Метод выполняется после запуском теста,
     * используется для удаления данных,
     * данный метод похож на деструктор теста
     */
    protected function tearDown(): void
    {

    }

    /**
     * Выполняет проверку 33 == $this->user->getAge()
     */
    public function testAge()
    {
        $this->assertEquals(33, $this->user->getAge());
    }

    /**
     * Используем подстановку из функции userProvider
     * @dataProvider userProvider
     */
    public function testAge2($age)
    {
        $this->assertEquals($age, $this->user->getAge());
    }

    public function userProvider()
    {
        return [
            [1],
            [2],
            [33],
        ];
    }

    /**
     * Используем подстановку из функции userProvider
     * @dataProvider userProvider3
     */
    public function testAge3($age)
    {
        $this->assertEquals($age, $this->user->getAge());
    }

    public function userProvider3()
    {
        return [
            'one' => [1],
            'two' => [2],
            'correct' => [33],
        ];
    }

    /**
     * Данный тест возвращает значение 33
     */
    public function testAge4()
    {
        $this->assertEquals(33, $this->user->getAge());
        // В тесте мы можем вернуть определенное значение
        return 33;
    }

    /**
     * Можно создавать тесты которые зависят от результата выполненого ранее теста
     * @depends testAge4
     */
    public function testAge5()
    {
        $this->assertEquals(33, $this->user->getAge());
    }

    /**
     * Выполняет проверку
     * 33 === $this->user->getAge()
     */
    public function testAge6()
    {
        $this->assertSame('33', $this->user->getAge());
    }

    /**
     * Тестирование исключения
     * Тест будет пройден успешно, если получено исключение
     */
    public function testEmailException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->user->getEmail();
    }

    /**
     * Тестирование исключения
     * Тест будет пройден успешно, если получено исключение
     * и код парраметра и код ошибки совпадут
     */
    public function testEmailException2()
    {
        $this->expectExceptionCode(10);
        $this->user->getEmail();
    }

    /**
     * Тестирование исключения
     * Тест будет пройден успешно, если получено исключение
     * и описание ошибки в параметре теста и описание ошибки
     * совпадут
     */
    public function testEmailException3()
    {
        $this->expectExceptionMessage('Error email');
        $this->user->getEmail();
    }

    /**
     * Тестирование исключения
     * Описание состоит из регульрного выражения
     * Тест будет пройден успешно, если получено исключение
     * и описание ошибки в параметре теста и описание ошибки
     * совпадут
     */
    public function testEmailException4()
    {
        $this->expectExceptionMessageRegExp('/\w+.\w+/');
        $this->user->getEmail();
    }

    /**
     * Text
     */
    public function testAddToFile()
    {
        $this->assertFalse(@$this->addToFile('/awaw/somefile.txt', 'data to save'));
    }

    public function addToFile($path, $data)
    {
        $file = fopen($path, 'w');
        if ($file == false) {
            return false;
        }
    }

    /**
     * Тест будет пройден успешно, если получена ошибка заданного тип
     */
    public function testEmailException5()
    {
        $this->expectException(\PHPUnit\Framework\Error\Error::class);
        include "somefilenotexist.php";
    }

    /**
     * Тест будет пройден успешно, значения строк совпадут
     */
    public function testEcho()
    {
        $this->expectOutputString("success");
        echo "success";
    }

    /**
     * Тест будет пройден успешно, значение регулярного
     * выражения и строки совпадут
     */
    public function testEcho2()
    {
        $this->expectOutputRegex("/^\w+$/");
        echo "success";
    }

    /**
     * Тест будет пройден успешно, значения строк совпадут
     */
    public function testEcho3()
    {
        $this->expectOutputString("success");
        // Преобразует строку удаляя пробелы справа и слева
        $this->setOutputCallback(
            function ($str) {
                return trim($str);
            }
        );
        echo "success ";
    }

    public function testArray()
    {
        // Строгое (===) сравнение массивов
        $this->assertSame(
            [12, 2, 3, 34, 34],
            [12, 2, 3, 34, 34]
        );
    }

    public function testArray2()
    {
        // Мягкое (==) сравнение массивов
        $this->assertEquals(
            [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            ['1', 2, 3, 4, 5, 6, 7, 8, 9, 10]
        );
    }

    /**
     * C 6 версии резервное копирование запрещено
     * это можно изменив настройку backupGlobals="true" 
     */
    public function testVarGlobals()
    {
        $tmp  = $GLOBALS['somevar'];
        $GLOBALS['somevar'] = "world";
        $this->assertEquals($tmp, "hello");
    }

    public function testVarGlobals2()
    {
        $tmp  = $GLOBALS['somevar'];
        $this->assertEquals($tmp, "hello");

    }

    /**
     * Указываем, что тест не завершен
     */
    public function testIncomplete()
    {
        $this->markTestIncomplete();
    }

    /**
     * Указываем, что тест не завершен с комментарием
     */
    public function testIncomplete2()
    {
        $this->markTestIncomplete("Incomplete");
    }

    /**
     * Пропускает тест исходя из условия
     */
    public function testIncomplete3()
    {
        if (true) {
            $this->markTestSkipped("Skipped");
        }
    }
}

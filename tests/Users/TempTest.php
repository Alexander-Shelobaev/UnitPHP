<?php

use PHPUnit\Framework\TestCase;

class Temp extends TestCase
{
    protected static $db;

    /**
     * Метод выполняется перед запуском тестов,
     * используется для инициализации данных,
     * данный метод похож на конструктор
     */
    public static function setUpBeforeClass(): void
    {
        // Записываем название метода в стандартный поток вывода
        fwrite(STDOUT, __METHOD__ . "\n");
        self::$db = new mysqli('', '', '', '');
    }

    /**
     * Метод выполняется перед запуском теста,
     * используется для инициализации данных,
     * данный метод похож на конструктор теста
     */
    public function setUp(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    /**
     * Метод выполняется перед методом assert
     */
    public function assertPreConditions(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    public function testOne()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->assertTrue(true);
    }

    public function testTwo()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        $this->assertTrue(false);
    }

    /**
     * Метод выполняется после методом assert
     * при успешном выполнении теста
     */
    public function assertPostConditions(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    /**
     * Метод выполняется после запуском теста,
     * используется для удаления данных,
     * данный метод похож на деструктор теста
     */
    public function tearDown(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    /**
     * Метод выполняется при неуспежном завершении теста
     */
    protected function onNotSuccessfulTest(Throwable $t): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        throw $t;
    }

    /**
     * Метод выполняется после запуском тестов,
     * используется для удаления данных,
     * данный метод похож на десструктор
     */
    public static function tearDownAfterClass(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        self::$db = null;
    }

}

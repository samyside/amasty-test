<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PizzaApp\Database\Connection;

try {
    $db = Connection::getInstance()->getConnection();
    echo "Соединение с базой данных установлено успешно!";
} catch (PDOException $e) {
    echo "\033[31mОшибка подключения к базе данных\033[0m: " . $e->getMessage();
}

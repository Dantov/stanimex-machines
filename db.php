<?php

$connection = mysqli_connect("localhost", "adm_test", "V7L0QJk3YOHvMqnC", "almtrade_db");

mysqli_set_charset($connection, "utf8");


if (!$connection) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
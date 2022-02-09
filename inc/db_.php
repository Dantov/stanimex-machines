<?php

$db_stats = mysqli_connect("localhost", "adm_test", "V7L0QJk3YOHvMqnC", "almtrade_stats");
 //= mysqli_connect ($db_host, $db_user, $db_pass, $db_name) or die ("Невозможно подключиться к БД");

mysqli_set_charset($db_stats, "utf8");


if (!$db_stats) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
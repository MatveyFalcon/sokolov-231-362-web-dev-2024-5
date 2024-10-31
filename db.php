<?php
$host = 'localhost';
$db_user = 'sokol';
$db_password = 'sokol';
$db_name = 'lab5_web';

$mysql = new mysqli($host, $db_user, $db_password, $db_name);

if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

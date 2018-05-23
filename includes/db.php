<?php
require_once '../config.php';

$conn = new mysqli(
    $config['db']['server'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['name']
);

if ($conn == false) {
    echo "Не удалось подключится к базе </br>";
    echo mysqli_connect_error();
}
<?php

include "../includes/db.php";

$login = $_POST['login'];
$password = $_POST['password'];

$count = mysqli_query($conn, "SELECT * FROM Users WHERE login = '$login' AND password = '$password'");

if(mysqli_num_rows($count) == 0){
    echo "Не верный логин или пароль";
}
else{
    echo "Привет, ".$login;
}
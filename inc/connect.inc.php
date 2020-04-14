<?php
/*
	Подключаемый модуль connect.inc.php - подключения к базе данных
	Логин: "root"
	Пароль: ""
	База: "books"
*/
$link = mysqli_connect('localhost', 'root') or die ("He могу подключиться к серверу!");
mysqli_select_db($link, "books") or die ("He могу подключиться к базе данных!");

mysqli_query($link,'SET NAMES utf8');
mysqli_query($link,"SET CHARACTER SET 'cp1251'");
//mysqli_close ($link);
?>
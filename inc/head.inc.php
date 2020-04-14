<?php
/*
	Подключаемый шаблонный модуль - head.inc.php 
	Формирует секцию head/HTML любой страницы проекта
	13.01.2020
*/


$head = '
<head>
	<title>'.$title.'</title>
	
	<meta http-equiv="content-type" content="text/html; charset=win-1251"/>
	<META name="author" content="'.$copyright.'">
	<META name="description" content="'.$description.'">
	<META name="keywords" content="'.$keywords.'">
	<META name="Copyright" content="'.$copyright.'">
	<META name="robots" content="all">
	
	<link rel="stylesheet" href="css/my_style.css" type="text/css"/>
	<link rel="stylesheet" href="css/h_menu.css" type="text/css"/>
	
</head>

';

?>
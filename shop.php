<?php
/*
	index.php - Главный скрипт проекта по сайте "Книжный магазин"
	03.03.2020
*/
#-- Устанавливает режимы для всех страниц магазина (Не кешировать страницы),
#-- Создает cookie с uniqid("ID") для неавторизованого пользователя bask
#-- Запускает сесию
include "./inc/headers.inc.php";
include "./inc/cookie.inc.php";
#-- Принимаем и обрабатываем все параметры
include "./inc/var.inc.php";
include "./inc/connect.inc.php";
include "./inc/auto.inc.php";

if($page === "home")
{
	$description = "Это сайт для отработки упражнений курса Web-программирование";
	$keywords = "упражнения Web-программирование";
	include "./inc/home.inc.php";
	$content = $home;
}
else if($page === "catalog") //-- Каталог товаров
{
	$description = "Каталог товаров";
	$keywords = "Каталог товаров";
	//-- Если не выбран тип просмотра каталога
	if(!isset($type))
	{
		//-- Устанавливаем тип: по издателям и первый издатель
		$type=1;
		$id_publ=1;
	}
	include ("./inc/catalog.inc.php");
	$content="
	".$catalog;
}
else if($page === "register")
{
	$description = "Это регистрация для отработки упражнений курса Web-программирование";
	$keywords = "регистрация Web-программирование";
	include "./inc/register.inc.php";
	$content = $register;
}
else if($page === "cabinet")
{
	$description = "Здесь Авторизованный пользователь может отредактировать персональные данные и просмотреть, например, историю своих заказов.";
	$keywords = "Личный Кабинет";
	include "./inc/cabinet.inc.php";
	$content = $cabinet;
}
else if($page === "order") //-- Заказ
{
	$description = "Здесь Авторизованный пользователь может оформить заказ.";
	$keywords = "Формирование заказа";
	include ("./inc/order.inc.php");
	//-- <p>Здесь пользователь может отредактировать заказ и оформить его.<p>
	$content=$order;
}
else if($page === "basket") //-- Корзина пользователя
{
	$description = "Работа с корзиной.";
	$keywords = "корзина";
	include ('./inc/basket.inc.php');
	$content=$basket;
}
else if($page === "contacts")
{
	$description = "Это наши контакты для отработки упражнений курса Web-программирование";
	$keywords = "контакты Web-программирование";
	include "./inc/contacts.inc.php";
	$content = $contacts;
}
else 
{
	$description = "Эта страница в разработке для отработки упражнений курса Web-программирование";
	$keywords = "в разработке Web-программирование";
	$content = "<h3>В данный момент эта страница находится в стадии разработки</h3>";
}

include "./inc/head.inc.php";
include "./inc/header.inc.php";
include "./inc/menu.inc.php";
include "./inc/footer.inc.php";


$html = '<html>
'.$head.'
<body>
	<div class="main" id="main">
		<!-- Верхняя часть страницы -->
		<div class="header" id="header">
'.$header.'
		</div>
		<!-- Верхняя часть страницы -->
	
		<!-- Центральная часть страницы -->
		<div class="page" id="page">
			<!-- Меню -->
			<div class="menu" id="menu">
'.$menu.'
			</div>
			<!-- Меню -->
			<!-- Область основного контента -->
			<div class="content" id="content">
'.$content.'
			</div>
			<!-- Область основного контента -->
		</div>
		<!-- Центральная часть страницы -->
		
		<!-- Нижний колонтитул -->
		<div class="footer" id="footer">
'.$footer.'
		</div>
		<!-- Нижний колонтитул -->
	</div>
</body>
<html>
';

echo $html;
?>
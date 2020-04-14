<?php
/*
	Подключаемый шаблонный модуль - menu.inc.php 
	Формирует Вертикальное меню любой страницы проекта
	13.01.2020
*/

$strSQL1="SELECT `id_publ`, `name_publ` FROM `publishers` ORDER BY `name_publ`";
$result1=mysqli_query($link,$strSQL1) or die("He могу выполнить запрос [$strSQL1]!");
$strSQL2="SELECT * FROM `categories` ORDER BY `name_cat`";
$result2=mysqli_query($link,$strSQL2) or die("He могу выполнить запрос [$strSQL2]!");

while ($row=mysqli_fetch_array ($result1) )
{
	$publ_li .= '
				<li>
					<a href="'.$_SERVER["PHP_SELF"].'?page=catalog&type=1&id_publ='.$row["id_publ"].'">'.$row["name_publ"].'</a>
				</li>';
}
while ($row=mysqli_fetch_array ($result2) )
{
	$cat_li .= '
			<li>
				<a href="'.$_SERVER["PHP_SELF"].'?page=catalog&type=2&id_cat='.$row["id_cat"].'">'.$row["name_cat"].'</a>
			</li>';
}

$menu = '
			<nav>
				<ul>
					<li><a >Издaтeли</a></li>
					<ul>'.$publ_li.'
				</ul>
					<li><a >Kaтeгopии</a></li>
					<ul>'.$cat_li.'</ul>
				</ul>
			</nav>
';

?>
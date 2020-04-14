<?php	
/*
	Подключаемый функциональный модуль - catalog.inc.php 
	Осуществляет формирование котента страницы "Корзина"
	03.03.2020
*/

if ($type == 1)
{
	$strSQL1="SELECT `name_publ` FROM `publishers` WHERE `id_publ`=".$id_publ;
	$result=mysqli_query($link,$strSQL1) or die("He могу выполнить запрос [$strSQL1] !");
	if($row=mysqli_fetch_array($result))
		$title_cat=$row["name_publ"];
	$strSQL1 = "
		SELECT 
			`id_book`, `image`, `author`, `name_book`, `books`.`id_publ`, `name_publ`, `pages`,
			`price`, `books`.`id_cat`, `name_cat`
		FROM `books`, `publishers`, `categories`
		WHERE
			`books`.`id_cat`=`categories`.`id_cat` AND
			`books`.`id_publ`=`publishers`.`id_publ` AND
			`books`.`id_publ`=".$id_publ;
}
if ($type==2)
{
	$strSQL1="SELECT `name_cat` FROM `categories` WHERE `id_cat`=".$id_cat;
	$result=mysqli_query($link,$strSQL1) or die("He могу выполнить запрос [$strSQL1]!");
	if($row=mysqli_fetch_array($result))
		$title_cat=$row["name_cat"];
	$strSQL1 = "
		SELECT `id_book`, `image`, `author`, `name_book`, `books`.`id_publ`, `name_publ`, `pages`,
				`price`, `books`.`id_cat`, `name_cat`
		FROM `books`, `publishers`, `categories`
		WHERE
			`books`.`id_cat`=`categories`.`id_cat` AND
			`books`.`id_publ`=`publishers`.`id_publ` AND
			`books`.`id_cat`=".$id_cat;
}
$resultl=mysqli_query($link,$strSQL1) or die("He могу выполнить запрос [$strSQL1]!");

$count_members=0;
while ($row=mysqli_fetch_array ($resultl) )
{
	$count_members++;
	$catalog_tmp .= '
<tr>
	<td align="center">
		<img src="images/'.$row ["image"].'" alt="'.$row["name book"].'" border="0">
		<center>
			<a href="'.$_SERVER["PHP_SELF"].'?page=basket&type=1&id_book='.$row["id_book"].'">
				<font size=-1>положить в корзину</font>
			</а>
		</center>
	</td>
	
	<td>
		<table>
			<tr>
				<td align="right"><i>Автор: </i></td>
				<td>'. $row["author"].'</td>
			</tr>
			<tr>
				<td align="right"><i>Haзвание:</i></td>
				<td>'.$row["name_book"].'</td>
			</tr>
			<tr>
				<td align="right"><i>Издательство:</i></td>
				<td>
					<a href="'.$_SERVER["PHP_SELF"].'?page='.$page.'&type=1&id_publ='.$row["id_publ"].'">'.$row["name_publ"].'</a> 
				</td>
			</tr>
			<tr>
				<td align="right"><i>Количество страниц: </i></td>
				<td>'.$row["pages"].' стр</td>
			</tr>
			<tr>
				<td align="right"><i>Цена: </i></td>
				<td>'.$row["price"].' грн</td>
			</tr>
			<tr>
				<td align="right"><i>Категория:</i></td>
				<td>
					<a href="'.$_SERVER["PHP_SELF"].'?page='.$page.'&type=2&id_cat='.$row["id_cat"].'">'.$row["name_cat"].'</a> 
				</td>
			</tr>
		</table>
		<hr>
	</td>
</tr>
';
}

if($count_members > 0)
{
	$catalog = '
				<h3>Каталог товаров ('.$title_cat.')</h3>
				<p>Предложено '.$count_members.' наименований:</p>
				<table border="0" width="100%" align="right">
					'.$catalog_tmp.'
				</table>
';
}
else
	$catalog = '
				<h3>Каталог товаров ('.$title_cat.')</h3>
				<p>На данный момент предложений нет.</p>';


?>
<?php
/*
	Подключаемый функциональный модуль auto.inc.php - реализует фукциональность
	авторизации пользователя
	21.02.2020
*/

//-- Обработчик процедуры Авторизации
if(isset($pass) && isset($login))
{
	//-- ищем, есть ли в базе данных пользователь с таким логином
	$strSQL1="SELECT *
				FROM customers
				WHERE
					login='".$login."' AND
					pass='".$pass."'";
	$result1 = mysql_query($strSQL1) or die("He могу выполнить запрос [$strSQL1]!");
	// пользователь с таким логином и паролем найден ?
	if($row=mysql_fetch_array($result1))
	{
		// пользователь с таким логином и паролем найден
		$_SESSION["log"] = $row["fam"]." ".$row["im"];
		$_SESSION["id"] = $row["id_cust"];
		$message_auto="<span bgcolor='#66cc66' align='center'><b>Вы успешно авторизованы</b></span>";
		$success=true;
		$style_auto_Ok = 'style="background: #f1f1d1;"';
	}
	else
	{
		$success=false;
		$message_auto="<span bgcolor='#ff9999' align='center'> <b>Неправильные данные</b></span>" ;
	}
}
else
{
	if(isset($_SESSION["log"]))
	{
		$success=false;
		$message_auto="<span bgcolor='#ff9999' align='center'>
							<b>".$_SESSION["log"]."</b></span><br>
							<a href='/exit.php'>Выход</a>" ;
		$style_auto_Ok = 'style="background: #f1f1d1;"';
	}
	else
	{
		$success=false;
		$message_auto="<span bgcolor='#ff9999' align='center'> <b>Авторизуйтесь пожалуйста</b></span>" ;
	}
}
	
if($success)
{
	//-- если мы только что авторизовались- переходим на Личный Кабинет
	header("Refresh: 3;  http://".$_SERVER[HTTP_HOST].$_SERVER["PHP_SELF"]."?page=cabinet");
}
else
{
	//-- если авторизация не прошла
	if(!isset($style_auto_Ok))
	{
		$auto = '
			<div class=register id=register>
				<form action='.$_SERVER["PHP_SELF"].' method="post">
					<input type="hidden" name="page" value="'.$page.'">
					<p>
					<span>Логин: <input class=input type="text" name="login" size=20></span><br>
					<span>Пароль : <input class=input type="password" name="pass" size=14></span>
					<input type="submit" value=Ok>
					</p>
				</form>
			</div>
';
	}
	else
		$auto = '';
}


?>
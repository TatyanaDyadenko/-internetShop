<?php
/*
	Подключаемый модуль myfunctions.inc.php
	Содержит пользовательские функции 
*/

/*
	Функции работы с базой данных (БД) в текстовом файле
	В БД хранятся регистрационные данные пользователя:
	Формат:
		"ID|Фaмилия|Имя|Адрес|E-mail|Логин|Пароль|Подписаться на рассылку новостей"
	Файл БД: 
		"customers.txt"
	Реализованы функции:
	- Добавляем в пользователя
		add_customers($db_source, $fam, $im, $addr, $mail, $login, $pass, $subscribe);
			$db_source - файл БД
	- Проверяем, есть ли логин и пароль пользователя в файл БД
		customer_exist($db_source, $login, $pass)
			$db_source - файл БД
			$login - логин пользователя
			$pass - пароль пользователя
		возвращает:
			1 - пользователь есть в БД
			0 - пользователя нет в БД
*/
//-- Добавляем в пользователя файл БД
function add_customers($db_source, $fam, $im, $addr, $mail, $login, $pass, $subscribe)
{
	if(file_exists($db_source))
	{
		$fh = fopen($db_source, "a");
	}
	else
	{
		$fh = fopen($db_source, "w");
	}
	$id = uniqid("ID");
	fprintf($fh, "%s|%s|%s|%s|%s|%s|%s|%d\n", 
		$id, $fam, $im, $addr, $mail, $login, $pass, $subscribe);
	fclose($fh);
	return $id;
}
//-- Проверяем, есть ли логин пользователя в файл БД
function customer_exist($db_source, $login, $pass)
{
	$login_exist = 0;
	if(file_exists($db_source))
	{
		$file_array = file ($db_source);
		if(!$file_array) echo("Ошибка открытия файла");
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				list($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp, $login_tmp,
				$pass_tmp, $subscribe_tmp) = explode("|", $file_array[$i]);
				if(($login_tmp == $login) && ($pass_tmp == $pass))
				{
					//-- Да, такой пользователь уже есть
					$login_exist = $id_tmp;
					break;
				}
			}
		}
	}
	else
	{
		$login_exist = 0;
	}
	return $login_exist;
}
//-- Возвращаем данные зарегистрированного пользователя из файла БД
function customer_data($db_source, $login, $pass)
{
	$login_exist = 0;
	if(file_exists($db_source))
	{
		$file_array = file ($db_source);
		if(!$file_array) echo("Ошибка открытия файла");
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				list($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp, $login_tmp,
				$pass_tmp, $subscribe_tmp) = explode("|", $file_array[$i]);
				if(($login_tmp == $login) && ($pass_tmp == $pass))
				{
					//-- Да, такой пользователь уже есть
					return array($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp,
					$login_tmp, $pass_tmp, $subscribe_tmp);
				}
			}
		}
	}
	else
	{
		$login_exist = 0;
	}
	return $login_exist;
}
//-- Обновляем персрнальные данные пользователя в файле БД, по логину
function customer_update($db_source, $id, $fam, $im, $addr, $mail, $login, $pass, $subscribe)
{
	$login_exist = 0;
	if(file_exists($db_source))
	{
		$file_array = file ($db_source);
		if(!$file_array) echo("Ошибка открытия файла");
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				list($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp, $login_tmp,
				$pass_tmp, $subscribe_tmp) = explode("|", $file_array[$i]);
				if($id_tmp == $id)
				{
					//-- Да, такой пользователь уже есть
					$file_array[$i] = sprintf("%d|%s|%s|%s|%s|%s|%s|%d", $id, $fam,
					$im, $addr, $mail, $login, $pass, $subscribe);
					$login_exist = $id;
					break;
				}
			}
			//-- Записываем обновленную информацию в файл БД
			$str_out = implode("", $file_array);
			$fh = fopen($db_source, "w");
			fwrite($fh, $str_out);
			fclose($fh);
		}
	}
	else
	{
		$login_exist = 0;
	}
	return $login_exist;
}
?>
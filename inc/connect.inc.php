<?php
/*
	������������ ������ connect.inc.php - ����������� � ���� ������
	�����: "root"
	������: ""
	����: "books"
*/
$link = mysqli_connect('localhost', 'root') or die ("He ���� ������������ � �������!");
mysqli_select_db($link, "books") or die ("He ���� ������������ � ���� ������!");

mysqli_query($link,'SET NAMES utf8');
mysqli_query($link,"SET CHARACTER SET 'cp1251'");
//mysqli_close ($link);
?>
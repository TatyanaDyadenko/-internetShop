<?php
/*
	����� - ������ �����������
	21.02.2020
*/
session_start();
unset($_SESSION['log']);
unset($_SESSION['id']);
session_destroy();

//-- ���������� ��������� �� ������� ��������
header("Location: http://".$_SERVER["HTTP_HOST"]);
?>
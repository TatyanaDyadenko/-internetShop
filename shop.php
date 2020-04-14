<?php
/*
	index.php - ������� ������ ������� �� ����� "������� �������"
	03.03.2020
*/
#-- ������������� ������ ��� ���� ������� �������� (�� ���������� ��������),
#-- ������� cookie � uniqid("ID") ��� ���������������� ������������ bask
#-- ��������� �����
include "./inc/headers.inc.php";
include "./inc/cookie.inc.php";
#-- ��������� � ������������ ��� ���������
include "./inc/var.inc.php";
include "./inc/connect.inc.php";
include "./inc/auto.inc.php";

if($page === "home")
{
	$description = "��� ���� ��� ��������� ���������� ����� Web-����������������";
	$keywords = "���������� Web-����������������";
	include "./inc/home.inc.php";
	$content = $home;
}
else if($page === "catalog") //-- ������� �������
{
	$description = "������� �������";
	$keywords = "������� �������";
	//-- ���� �� ������ ��� ��������� ��������
	if(!isset($type))
	{
		//-- ������������� ���: �� ��������� � ������ ��������
		$type=1;
		$id_publ=1;
	}
	include ("./inc/catalog.inc.php");
	$content="
	".$catalog;
}
else if($page === "register")
{
	$description = "��� ����������� ��� ��������� ���������� ����� Web-����������������";
	$keywords = "����������� Web-����������������";
	include "./inc/register.inc.php";
	$content = $register;
}
else if($page === "cabinet")
{
	$description = "����� �������������� ������������ ����� ��������������� ������������ ������ � �����������, ��������, ������� ����� �������.";
	$keywords = "������ �������";
	include "./inc/cabinet.inc.php";
	$content = $cabinet;
}
else if($page === "order") //-- �����
{
	$description = "����� �������������� ������������ ����� �������� �����.";
	$keywords = "������������ ������";
	include ("./inc/order.inc.php");
	//-- <p>����� ������������ ����� ��������������� ����� � �������� ���.<p>
	$content=$order;
}
else if($page === "basket") //-- ������� ������������
{
	$description = "������ � ��������.";
	$keywords = "�������";
	include ('./inc/basket.inc.php');
	$content=$basket;
}
else if($page === "contacts")
{
	$description = "��� ���� �������� ��� ��������� ���������� ����� Web-����������������";
	$keywords = "�������� Web-����������������";
	include "./inc/contacts.inc.php";
	$content = $contacts;
}
else 
{
	$description = "��� �������� � ���������� ��� ��������� ���������� ����� Web-����������������";
	$keywords = "� ���������� Web-����������������";
	$content = "<h3>� ������ ������ ��� �������� ��������� � ������ ����������</h3>";
}

include "./inc/head.inc.php";
include "./inc/header.inc.php";
include "./inc/menu.inc.php";
include "./inc/footer.inc.php";


$html = '<html>
'.$head.'
<body>
	<div class="main" id="main">
		<!-- ������� ����� �������� -->
		<div class="header" id="header">
'.$header.'
		</div>
		<!-- ������� ����� �������� -->
	
		<!-- ����������� ����� �������� -->
		<div class="page" id="page">
			<!-- ���� -->
			<div class="menu" id="menu">
'.$menu.'
			</div>
			<!-- ���� -->
			<!-- ������� ��������� �������� -->
			<div class="content" id="content">
'.$content.'
			</div>
			<!-- ������� ��������� �������� -->
		</div>
		<!-- ����������� ����� �������� -->
		
		<!-- ������ ���������� -->
		<div class="footer" id="footer">
'.$footer.'
		</div>
		<!-- ������ ���������� -->
	</div>
</body>
<html>
';

echo $html;
?>
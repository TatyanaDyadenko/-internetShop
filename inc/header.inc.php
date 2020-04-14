<?php
/*
	������������ ��������� ������ - header.inc.php 
	��������� ������������ ����� ����� �������� �������
	13.01.2020
*/

$visit_str = '';
if(isset($visitCounter))
	if($visitCounter == 1)
	{
		$visit_str = "����� ���������� �� ��� ����!<br>&nbsp;";
	}
	else
	{
		$visit_str = "�� ����� � ��� $visitCounter ���<br>
					��������� ��������� $lastVisit";
	}


$h_menu = '
				<ul class="h_menu">
					<li><a href="http://mysite.ua">�� mysite.ua</a></li>
					<li '.(($page == "catalog")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=catalog">�������</a></li>
				'.(isset($_SESSION['id'])?
					'<li'.(($page=="cabinet")?' class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=cabinet">�������</a></li>'
				:
					'<li'.(($page=="register")?' class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=register">�����������</a></li>').'	
					<li '.(($page == "order")?'class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=order">�����</a></li>
					<li'.(($page=="contacts")?' class="selected"':'').'><a href="'.$_SERVER["PHP_SELF"].'?page=contacts">��������</a></li>
				'.(isset($_SESSION['id'])?
					'<li><a href="/exit.php">�����</a></li>'
				:'').'	
				</ul>
';

$header = '
			<div class="logo" id="logo">
				<a  href="'.$_SERVER["PHP_SELF"].'?page=home">
					<img src="images/logo.jpg" width="187" alt="��� �������" />
				</a>
			</div>
			<div class="title" id="title">
			<center>
				<blockquote>
					<i><b>
						��� ���</b><br>
						'.$visit_str.'
					</i>
				</blockquote>
				<center>
					<h1>'.$title.'</h1>
				</center>
			</div>
			<div class="auto" id="auto" '.$style_auto_Ok.'>
				'.$auto.$message_auto.'
				<a href="'.$_SERVER["PHP_SELF"].'?page=basket">�������</a>
			</div>
			<div class="h_menu" id="h_menu">
'.$h_menu.'
			</div>

';
?>
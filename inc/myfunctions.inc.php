<?php
/*
	������������ ������ myfunctions.inc.php
	�������� ���������������� ������� 
*/

/*
	������� ������ � ����� ������ (��) � ��������� �����
	� �� �������� ��������������� ������ ������������:
	������:
		"ID|�a�����|���|�����|E-mail|�����|������|����������� �� �������� ��������"
	���� ��: 
		"customers.txt"
	����������� �������:
	- ��������� � ������������
		add_customers($db_source, $fam, $im, $addr, $mail, $login, $pass, $subscribe);
			$db_source - ���� ��
	- ���������, ���� �� ����� � ������ ������������ � ���� ��
		customer_exist($db_source, $login, $pass)
			$db_source - ���� ��
			$login - ����� ������������
			$pass - ������ ������������
		����������:
			1 - ������������ ���� � ��
			0 - ������������ ��� � ��
*/
//-- ��������� � ������������ ���� ��
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
//-- ���������, ���� �� ����� ������������ � ���� ��
function customer_exist($db_source, $login, $pass)
{
	$login_exist = 0;
	if(file_exists($db_source))
	{
		$file_array = file ($db_source);
		if(!$file_array) echo("������ �������� �����");
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				list($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp, $login_tmp,
				$pass_tmp, $subscribe_tmp) = explode("|", $file_array[$i]);
				if(($login_tmp == $login) && ($pass_tmp == $pass))
				{
					//-- ��, ����� ������������ ��� ����
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
//-- ���������� ������ ������������������� ������������ �� ����� ��
function customer_data($db_source, $login, $pass)
{
	$login_exist = 0;
	if(file_exists($db_source))
	{
		$file_array = file ($db_source);
		if(!$file_array) echo("������ �������� �����");
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				list($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp, $login_tmp,
				$pass_tmp, $subscribe_tmp) = explode("|", $file_array[$i]);
				if(($login_tmp == $login) && ($pass_tmp == $pass))
				{
					//-- ��, ����� ������������ ��� ����
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
//-- ��������� ������������ ������ ������������ � ����� ��, �� ������
function customer_update($db_source, $id, $fam, $im, $addr, $mail, $login, $pass, $subscribe)
{
	$login_exist = 0;
	if(file_exists($db_source))
	{
		$file_array = file ($db_source);
		if(!$file_array) echo("������ �������� �����");
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				list($id_tmp, $fam_tmp, $im_tmp, $addr_tmp, $mail_tmp, $login_tmp,
				$pass_tmp, $subscribe_tmp) = explode("|", $file_array[$i]);
				if($id_tmp == $id)
				{
					//-- ��, ����� ������������ ��� ����
					$file_array[$i] = sprintf("%d|%s|%s|%s|%s|%s|%s|%d", $id, $fam,
					$im, $addr, $mail, $login, $pass, $subscribe);
					$login_exist = $id;
					break;
				}
			}
			//-- ���������� ����������� ���������� � ���� ��
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
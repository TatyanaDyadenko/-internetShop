<?php
/*
	������������ �������������� ������ - register.inc.php 
	������������ ������������ ������� ����������� ����� �������� "�����������"
	06.03.2020
*/

#echo "$type, $fam, $im, $addr, $mail, $login, $pass, $pass2.<br>";
// ���� ������ ������"���������" ?
if($type == 1)
{
	// ��� ���� �� ������?
	if($fam!="" && $im!="" && $addr!="" && $mail!="" && $login!="" && $pass!="" && $pass2!="")
	{
		// ���� ������ � ������� ������ �� ���������?
		if ($pass != $pass2)
		{
			$message="<span bgcolor='#ff9999' align='center'><b>���� ������ � ������� ������ �� ���������!!!</b></span>";
		}
		else
		{
			// ����, ��� �� � ���� ������ ������������ � ����� �������
			$strSQL1="SELECT id_cust FROM customers WHERE login='".$login."'";
			$result1=mysql_query($strSQL1) or die("He ���� ��������� ������ [$strSQL1]!");
			// ����� ����� ��� ���� ?
			if($row=mysql_fetch_array($result1))
			{
				$message="<span bgcolor='#ff9999' align='center'><b>����� ����� ��� ����������!!! �������� ������ �����</b></span>";
			}
			else
			{
				// ������� ������ ������������
				$strSQL1="INSERT INTO customers(fam, im, addr, mail, login, pass, subscribe)
								VALUES('".$fam."', '".$im."', '".$addr."', '".$mail."', '".$login."',
													'".$pass."', ".((int)$subscribe).")";
				$result1=mysql_query($strSQL1) or die("He ���� ��������� ������ [$strSQL1]!");
				//-- ������������� ������ ��� ������������
				//-- ������ �������� � headers.inc.php: session_start(); ��������� �� � exit.php
				$_SESSION['log'] = $fam." ".$im;
				//-- �������� ID ������������ � ��
				$strSQL1="SELECT id_cust FROM customers WHERE login='".$login."'";
				$result1=mysql_query($strSQL1) or die("He ���� ��������� ������ [$strSQL1]!");
				if($row=mysql_fetch_array($result1))
				{
					$_SESSION['id'] = $row["id_cust"];
				}
				$message="<span bgcolor='#66cc66' align='center'> <b>�� ������� 3ape��������������.</b></span>
							<p>����� 5 ������ �� ��������� � ������ ��������.</p>";
				$success=true;
			}
		}
	}
	else
		$message="<span bgcolor='#ff9999' align='center'> <b>He ��� ���� ���������!!!</b></span>";
}

if(!$success)
{
	$register = '
		<h3>��� �������� �����������</h3>
		'.$message.'
		<form action='.$_SERVER["PHP_SELF"].' method=post>
			<input type=hidden name=type value=1>
			<input type=hidden name=page value=register>
		
			<small>����������� �������� ������������ ����</small>
			<table border="0" width="100%" align="right">
				<tr>
					<td align="right" width="50%"><i>�a�����: </i></td>
					<td> <input type=text name=fam value="'.$fam.'">*</td>
				</tr>
				<tr>
					<td align="right"><i>���: </i></td>
					<td><input type=text name=im value="'.$im.'">*</td>
				</tr>
				<tr>
					<td align="right"><i>�����: </i></td>
					<td><input type=text name=addr value="'.$addr.'">*</td>
				</tr>
				<tr>
					<td align="right"><i>E-mail: </i></td>
					<td><input type=text name=mail value="'.$mail.'">*</td>
				</tr>
				<tr>
					<td align="right"><i>�����: </i></td>
					<td><input type=text name=login value="'.$login.'">*</td>
				</tr>
					<tr><td align="right"><i>������: </i></td>
					<td><input type=password name=pass value="">*</td>
				</tr>
				<tr>
					<td align="right"><i>������ ������: </i></td>
					<td><input type=password name=pass2 value="">*</td>
				</tr>
				<tr>
					<td><input type="checkbox" value="1" name="subscribe"></td>
					<td><i>����������� �� �������� ��������</i></td>
				</tr>
				<tr>
					<td align="right"></td>
					<td> <input type=submit value="���������"></td>
				</tr>
			</table>
		</form>
';
}
else
{
	$register = '
			<h3>��� �������� �����������</h3>
'.$message;
	header("Refresh: 5; http://".$_SERVER["HTTP_HOST"]."/".$_SERVER["PHP_SELF"]."?page=cabinet");
}

?>
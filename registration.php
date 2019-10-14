<?php
include "includes/chk_login.php";
include "connection/connection.php";
if(isset($_POST['Submit']))
{
	$fname = $_POST['fname'];
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	
	$sql = "insert into login_master(full_name,user_name,password) values('$fname','$uname','$pass')";
	$rec = mysql_query($sql);
	
	echo "<script>
				alert('Data Submitted !!');
				location.replace('login.php?')	
			</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include "includes/config.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Insert List Edit Delete</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td colspan="2"><?php include "includes/header.php";?></td>
  </tr>
  <tr>
    <td height="56" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="15%">&nbsp;</td>
    <td width="85%"><form id="form1" name="form1" method="post" action="" onsubmit="return null_chk()">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="46%" height="30" align="right">Full Name </td>
          <td width="7%" align="center">:</td>
          <td width="47%" align="left"><input name="fname" type="text" id="fname" /></td>
        </tr>
        <tr>
          <td height="30" align="right">User Name </td>
          <td align="center">:</td>
          <td align="left"><input name="uname" type="text" id="uname" /></td>
        </tr>
        <tr>
          <td height="30" align="right">Password</td>
          <td align="center">:</td>
          <td align="left"><input name="pass" type="password" id="pass" /></td>
        </tr>
        <tr>
          <td height="30" align="right">Retype Password </td>
          <td align="center">:</td>
          <td align="left"><input name="rpass" type="password" id="rpass" /></td>
        </tr>
        <tr>
          <td height="30" align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="left"><input type="submit" name="Submit" value="Submit" /></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td colspan="2"><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

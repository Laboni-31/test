<?php
	include "connection/connection.php";
	
	if(isset($_POST['Submit']))
	{
		$uname = $_POST['uid'];
		$pass = $_POST['pass'];
		
		$sql = "select * from login_master where user_name='$uname'";
		$rec = mysql_query($sql);
		$num = mysql_num_rows($rec);
		if($num > 0)
		{
			$res = mysql_fetch_assoc($rec);
			if($pass == $res['password'])
			{
				session_start();
				
				$_SESSION['full_name'] = $res['full_name'];
				$_SESSION['lid'] = $res['login_id'];
				$_SESSION['ltype'] = $res['login_type'];
				
				echo "<script>
							alert('Successfully Loggedin');
							location.replace('bus_booking.php');
						</script>";
			}else
			{
				echo "<script>
							alert('Wrong Password');
							location.replace('login.php?');
						</script>";
			}
		}else
		{
			echo "<script>
							alert('User Does Not Exists');
							location.replace('login.php?');
						</script>";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include "includes/config.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><?php include "includes/header.php";?></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="44%" height="36" align="right"><strong>User Name </strong></td>
          <td width="13%" align="center"><strong>:</strong></td>
          <td width="43%"  bordercolor="#FFFFFF" bgcolor="#FFFFFF"><input name="uid" type="text" id="uid" /></td>
        </tr>
        <tr>
          <td height="36" align="right"><strong>Password</strong></td>
          <td align="center"><strong>:</strong></td>
          <td bordercolor="#FFFFFF"><input name="pass" type="password" id="pass" /></td>
        </tr>
        <tr>
          <td height="36" align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Submit" /></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td align="center"><table width="80%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="44%" align="center"><a href="registration.php"> Sign Up </a></td>
        <td width="56%" align="center"><a href="admin_login.php"> </a><a href="#">Forgot Password </a></td>
      </tr>
    </table>
    <p><a href="admin_login.php"></a></p>
      <p><a href="registration.php"></a>
        <?php include "includes/footer.php";?>
      </p>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>

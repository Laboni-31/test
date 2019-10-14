<?php
include "includes/chk_login.php";
include "connection/connection.php";
if(isset($_POST['Submit']))
{
  
	$cname = $_POST['cname']; 
	
	$sql = "insert into source_destination(city_name) values('$cname')";
	$rec = mysql_query($sql);
	if($rec)
	{
	
	echo "<script>
				alert('Data Submitted !!');
				location.replace('city_entry.php?')	
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
<title>City Entry</title>
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
          <td width="41%" height="30" align="center">City</td>
          <td width="14%" align="center"><strong>:</strong></td>
          <td width="45%" align="center"><input type="text" name="cname" /></td>
        </tr>
        <tr>
          <td height="30">&nbsp;</td>
          <td align="center"><strong>:</strong></td>
          <td align="center"><input type="submit" name="Submit" value="Submit" /></td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
  <tr>
    <td align="center"><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

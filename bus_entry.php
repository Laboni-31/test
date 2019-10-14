<?php
include "includes/chk_login.php";
include "connection/connection.php";
if(isset($_POST['Submit']))
{
	$bname = $_POST['bname'];
	$btype = $_POST['btype'];
	$totalseat = $_POST['totalseat'];
	$dtime = $_POST['dtime'];
	$atime = $_POST['atime'];
	
	$sql = "insert into bus_master(bus_name,bus_type,total_no_seat,dep_time,arr_time) values('$bname','$btype','$totalseat','$dtime','$atime')";
	//echo $sql;exit;
	$rec = mysql_query($sql);
	if($rec)
	{
	echo "<script>
				alert('Data Submitted !!');
				location.replace('bus_entry.php?')	
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
<title>Bus Entry</title>
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
          <td width="44%" height="30" align="center">Bus Name </td>
          <td width="12%" align="center"><strong>:</strong></td>
          <td width="44%" align="center"><input name="bname" type="text" id="bname" /></td>
        </tr>
        <tr>
          <td height="30" align="center">Bus Type </td>
          <td align="center"><strong>:</strong></td>
          <td align="center"><select name="btype" id="btype">
            <option value="0">... Select ...</option>
            <option value="AC">AC</option>
            <option value="Non-AC">Non-AC</option>
          </select>          </td>
        </tr>
        <tr>
          <td height="30" align="center">Total No. of Seat </td>
          <td align="center"><strong>:</strong></td>
          <td align="center"><input name="totalseat" type="text" id="totalseat" /></td>
        </tr>
        <tr>
          <td height="30" align="center">Departure Time </td>
          <td align="center"><strong>:</strong></td>
          <td align="center"><input name="dtime" type="text" id="dtime" /></td>
        </tr>
        <tr>
          <td height="30" align="center">Arrival Time </td>
          <td align="center"><strong>:</strong></td>
          <td align="center"><input name="atime" type="text" id="atime" /></td>
        </tr>
        <tr>
          <td height="30">&nbsp;</td>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Submit" /></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

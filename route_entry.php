<?php
include "includes/chk_login.php";
include "includes/config.php";
include "connection/connection.php";
if(isset($_POST['Submit']))
{
	$sname = $_POST['sname'];
	$dname = $_POST['dname'];
	$bname = $_POST['bname'];
	
	$sql = "insert into bus_route(source_id,destination_id,bus_id) values('$sname','$dname','$bname')";
	$rec = mysql_query($sql);
	if($rec)
	{
	echo "<script>
				alert('Data Submitted !!');
				location.replace('route_entry.php?')	
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
<title>Route Entry</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><?php include "includes/header.php";?></td>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="">
      <table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="46%" height="30" align="right">Source</td>
          <td width="8%" align="center">:</td>
          <td width="46%" align="left"><select name="sname" id="sname">
            <option value="0" selected="selected">...select...</option>
			 <?php
				$ssql = "select * from source_destination where city_status=1";
				$srec = mysql_query($ssql);
				
				while($sres = mysql_fetch_assoc($srec))
				{
			?>
            <option value="<?php echo $sres['city_id'];?>"><?php echo $sres['city_name'];?></option>
            <?php
			}
			?>
          </select>
          </td>
        </tr>
        <tr>
          <td height="30" align="right">Destination</td>
          <td align="center">:</td>
          <td align="left"><select name="dname" id="dname">
            <option value="0">...select...</option>
			<?php
				$dsql = "select * from source_destination where city_status=1";
				$drec = mysql_query($dsql);
				
				while($dres = mysql_fetch_assoc($drec))
				{
			?>
			<option value="<?php echo $dres['city_id'];?>"><?php echo $dres['city_name'];?></option>
			<?php
			}
			?>
          </select>
          </td>
        </tr>
        <tr>
          <td height="30" align="right">Bus</td>
          <td align="center">:</td>
          <td align="left"><select name="bname" id="bname">
            <option value="0">...select...</option>
			  <option value="1">AC</option>
			    <option value="2">NON-AC</option>
			<?php
				$bsql = "select * from bus_master where bus_status=1";
				$brec = mysql_query($bsql);
				
				while($bres = mysql_fetch_assoc($brec))
				{
			?>
			<option value="<?php echo $bres['bus_id'];?>"><?php echo $bres['bus_name'];?></option>
			<?php
			}
			?>
          </select>
          </td>
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
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

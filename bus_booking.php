<?php
include "includes/chk_login.php";
include "includes/config.php";
include "connection/connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bus Booking</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/all.js"></script>
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th align="left" scope="col"><?php include "includes/header.php";?>
    <p>&nbsp;</p></th>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><form id="form1" name="form1" method="post" action="">
          <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="46%" height="30" align="right">Source</td>
              <td width="8%" align="center">:</td>
              <td width="46%" align="left"><select name="sname" id="sname">
                  <option value="0">....select....</option>
                  <?php
				$ssql = "select * from source_destination where city_status=1";
				$srec = mysql_query($ssql);
				
				while($sres = mysql_fetch_assoc($srec))
				{
			?>
                  <option value="<?php echo $sres['city_id'];?>" <?php if(@$_POST['sname'] == $sres['city_id']){echo "selected";}?>><?php echo $sres['city_name'];?></option>
                  <?php
			}
			?>
              </select></td>
            </tr>
            <tr>
              <td height="30" align="right">Destination</td>
              <td align="center">:</td>
              <td align="left"><select name="dname" id="dname">
                  <option value="0">....select....</option>
                  <?php
				$dsql = "select * from source_destination where city_status=1";
				$drec = mysql_query($dsql);
				
				while($dres = mysql_fetch_assoc($drec))
				{
			?>
                  <option value="<?php echo $dres['city_id'];?>" <?php if(@$_POST['dname'] == $dres['city_id']){echo "selected";}?>><?php echo $dres['city_name'];?></option>
                  <?php
			}
			?>
                </select>
              </td>
            </tr>
            <tr>
              <td height="30" align="right">Date of Journey </td>
              <td align="center">:</td>
              <td align="left"><input name="doj" type="text" id="doj" value="<?php echo @$_POST['doj'];?>" />
                (YY-MM-DD) </td>
            </tr>
            <tr>
              <td height="30" align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" value="Submit" /></td>
            </tr>
          </table>
        </form></th>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
	  <?php
	  if(isset($_POST['Submit']))
	  {
	  ?>
      <tr>
        <td align="center"><table width="53%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th width="5%" align="center" scope="col">Sl.</th>
            <th width="33%" align="left" scope="col">Bus Name </th>
            <th width="20%" height="30" align="center" scope="col">Option</th>
            <th width="22%" align="center" scope="col">Departure Time </th>
            <th width="20%" align="center" scope="col">Arrival Time </th>
          </tr>
		  <?php
		  	$sname = $_POST['sname'];
			$dname = $_POST['dname'];
			$dtime = $_POST['dtime'];
			$atime = $_POST['atime'];
		  	$bsql = "select * from bus_route br, bus_master bm where br.source_id='$sname' and br.destination_id='$dname'  and  br.bus_id=bm.bus_id";
			$brec = mysql_query($bsql);
			$x = 1;
			while($bres = mysql_fetch_assoc($brec))
			{
		  ?>
          <tr>
            <td height="30" align="center"><?php echo $x;?></td>
            <td align="left"><?php echo $bres['bus_name'];?></td>
             <td align="center"><a href="bus_booking_detail.php?S=<?php echo $bres['source_id'];?>&amp;D=<?php echo $bres['destination_id'];?>&amp;B=<?php echo $bres['bus_id'];?>&amp;DOJ=<?php echo $_POST['doj'];?>">Book</a></td>
             <td align="center"><?php echo $bres['dep_time'];?></td>
             <td align="center"><?php echo $bres['arr_time'];?></td>
          </tr>
		  <?php
		  	$x++;
		  }
		  ?>
        </table></td>
      </tr>
	  <?php
	  }
	  ?>
    </table></td>
  </tr>
  <tr>
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

<?php
include "includes/chk_login.php";
include "includes/config.php";
include "connection/connection.php";

if(isset($_GET['CT']))
{
	$CT = $_GET['CT'];
	$CS = $_GET['CS'];
	$BS = $_GET['BS'];
	$new_BS = "";
	$BS_arr = explode("@",$BS);
	for($z = 0; $z < count($BS_arr); $z++)
	{
		$this_BS = $BS_arr[$z];
		if($this_BS != $CS)
		{
			if($new_BS == "")
			{
				$new_BS = $this_BS;
			}else
			{
				$new_BS = $new_BS."@".$this_BS;
			}
		}
	}
	if($new_BS == "")
	{
		$usql = "delete from passenger_details where pass_id='$CT'";
	}else
	{
		$usql = "update passenger_details set booked_seat='$new_BS' where pass_id='$CT'";
	}
	//echo $usql;exit;
	$urec = mysql_query($usql);
	echo "<script>
				alert('Ticket Canceled!!');
				window.close();
				window.opener.location.reload();	
			</script>";
	
}
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th align="left" scope="col"><?php include "includes/header.php";?>
    <p>&nbsp;</p></th>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><table width="80%" border="0" cellspacing="1" cellpadding="1">
          <tr class="bg head_txt">
            <td width="5%" height="30" align="center">Sl.</td>
            <td width="13%" align="left" class="padL">Source</td>
            <td width="15%" align="left" class="padL">Destination</td>
            <td width="36%" align="left" class="padL">Booking Detail </td>
            <td width="14%" align="left" class="padL">Date of Journey </td>
            <td width="17%" align="center">Option</td>
          </tr>
		  <?php
		  	$fsql = "select * from passenger_details pd, source_destination sd, bus_master bm where pd.pass_id='$_GET[PI]' and pd.source_id=sd.city_id and pd.bus_id=bm.bus_id";
			//echo $fsql;
			$frec = mysql_query($fsql);
			$x = 1;
			while($fres = mysql_fetch_assoc($frec))
			{
				if($x % 2 == 0)
				{
					$st = " style=\"background-color:#FFFFCC;\"";
				}else
				{
					$st =  "style=\"background-color:#CCFF99\"";
				}
				$dsql = "select * from source_destination where city_id='$fres[dest_id]'";
				$drec = mysql_query($dsql);
				$dres = mysql_fetch_assoc($drec);
		  ?>
          <tr <?php echo $st;?> class="most_txt">
            <td height="30" align="center" valign="top"><?php echo $x;?></td>
            <td align="left" valign="top" class="padL"><?php echo $fres['city_name'];?></td>
            <td align="left" valign="top" class="padL"><?php echo $dres['city_name'];?></td>
            <td align="left" valign="top" class="padL"><table width="99%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="40%" align="right">Bus Name </td>
                <td width="7%" align="center">:</td>
                <td width="53%" align="left"><?php echo $fres['bus_name'];?></td>
              </tr>
              <tr>
                <td align="right">Seat Number </td>
                <td align="center">:</td>
                <td align="left"><?php echo str_replace("@",", ",$fres['booked_seat']);?></td>
              </tr>
              <tr>
                <td align="right">Passenger Name </td>
                <td align="center">:</td>
                <td align="left"><?php echo $fres['pass_name'];?></td>
              </tr>
              <tr>
                <td align="right">Bus Timing </td>
                <td align="center">:</td>
                <td align="left">&nbsp;</td>
              </tr>
            </table></td>
            <td align="left" valign="top" class="padL"><?php echo $fres['dt_of_journey'];?></td>
            <td align="left" valign="top" class="padL"><table width="99%" border="0" cellspacing="0" cellpadding="0">
              <?php 
					$s_arr = explode("@",$fres['booked_seat']);
					for($y = 0; $y < count($s_arr); $y++)
					{
			?>
              <tr>
                <td height="25"><?php echo $s_arr[$y];?> [ <a href="cancel_ticket.php?CT=<?php echo $fres['pass_id'];?>&CS=<?php echo $s_arr[$y];?>&BS=<?php echo $fres['booked_seat'];?>" class="most_link">Cancel</a> ]</td>
              </tr>
              <?php
				}
				?>
            </table></td>
          </tr>
		  <?php
		  	$x++;
			}
		  ?>
        </table></td>
      </tr>
	  <?php
	  if(isset($_POST['Submit']))
	  {
	  ?>
      <tr>
        <td align="center">&nbsp;</td>
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

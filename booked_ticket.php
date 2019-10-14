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
		  	$fsql = "select * from passenger_details pd, source_destination sd, bus_master bm where pd.login_id='$_SESSION[lid]' and pd.source_id=sd.city_id and pd.bus_id=bm.bus_id";
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
            <td align="center" valign="top"><a href="#" class="most_link" onclick="window.open('print_ticket.php?PI=<?php echo $fres['pass_id'];?>','Print Window','width=750,height=600')">Print</a> | <a href="#"  onclick="window.open('cancel_ticket.php?PI=<?php echo $fres['pass_id'];?>','Print Window','width=750,height=600')" class="most_link">Cancel Ticket </a></td>
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

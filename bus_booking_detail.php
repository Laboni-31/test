<?php
include "includes/chk_login.php";
include "connection/connection.php";
$S = $_GET['S'];
$D = $_GET['D'];
$B = $_GET['B'];
$DOJ = $_GET['DOJ'];
$dtime = $_GET['dtime'];
$atime = $_GET['atime'];

$fsql = "select * from passenger_details where source_id='$S' and dest_id='$D' and bus_id='$B' and dt_of_journey='$DOJ' and dep_time='$dtime' and arr_time='atime'";
$frec = mysql_query($fsql);
$booked_seat = array();
while($fres = mysql_fetch_assoc($frec))
{
	$this_booked = $fres['booked_seat'];
	$this_arr = explode("@",$this_booked);
	for($x = 0; $x < count($this_arr); $x++)
	{
		$this_s = $this_arr[$x];
		array_push($booked_seat,$this_s);
	}
}
//print_r($booked_seat);
if(isset($_POST['Submit']))
{
	$pname = $_POST['pname'];
	$mno = $_POST['mno'];
	$email = $_POST['email'];
	$total_seats = $_POST['sel_seat'];
	
	$sql = "insert into passenger_details(pass_name,pass_mobile,pass_email,source_id,dest_id,bus_id,dt_of_journey,booked_seat,login_id,dep_time,arr_time) values('$pname','$mno','$email','$S','$D','$B','$DOJ','$total_seats','$_SESSION[lid]','$dtime','$atime')";
	$rec = mysql_query($sql);
	if($rec)
	{
	echo "<script>
				alert('Data Submitted !!');
				location.replace('bus_booking.php?')	
			</script>";
	}
}

$bsql = "select bus_name,total_no_seat from bus_master where bus_id='$B'";
$brec = mysql_query($bsql);
$bres = mysql_fetch_assoc($brec);

$ssql = "select city_name from source_destination where city_id='$S'";
$srec = mysql_query($ssql);
$sres = mysql_fetch_assoc($srec);

$dsql = "select city_name from source_destination where city_id='$D'";
$drec = mysql_query($dsql);
$dres = mysql_fetch_assoc($drec);

$dtsql = "select dep_time from bus_master where bus_id='$B'";
$dtrec = mysql_query($dtsql);
$dtres = mysql_fetch_assoc($dtrec);

$atsql = "select arr_time from bus_master where bus_id='$B'";
$atrec = mysql_query($atsql);
$atres = mysql_fetch_assoc($atrec);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include "includes/config.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>Bus Booking Detail</title>
<script>
	function colorchange(str)
	{
		var flg = document.getElementById('flg'+str).value;
		var sel_seat = document.getElementById("sel_seat").value;
		var sel_seat_arr = sel_seat.split("@");
		var new_sel_seat = "";
		if(flg == 0)
		{
			document.getElementById('tabledata'+str).style.backgroundColor='#DDDDDD';
			document.getElementById('flg'+str).value = 1;
			if(sel_seat == "")
			{
				new_sel_seat = str;
			}else
			{
				new_sel_seat = sel_seat+"@"+str;
			}
			
		}else
		{
			document.getElementById('tabledata'+str).style.backgroundColor='#CCCCFF';
			document.getElementById('flg'+str).value = 0;
			//alert(sel_seat_arr.length)
			for(var x = 0; x < sel_seat_arr.length; x++)
			{
				var this_seat = sel_seat_arr[x];
				if(this_seat != str)
				{
					if(new_sel_seat == "")
					{
						new_sel_seat = this_seat;
					}else
					{
						new_sel_seat = new_sel_seat+"@"+this_seat;
					}
				}
			}
			
		}
		document.getElementById("sel_seat").value = new_sel_seat; 
	}
</script>
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th scope="col"><?php include "includes/header.php";?></th>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="50%" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th height="28" align="left" scope="col">
            <table width="80%" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td width="51%">Source : </td>
                <td width="49%"><form id="form2" name="form2" method="post" action="">
                  <input name="sname" type="text" value="<?php echo $sres['city_name']?>" id="sname" />
                </form>                </td>
              </tr>
              <tr>
                <td>Destination : </td>
                <td><form id="form3" name="form3" method="post" action="">
                  <input name="dname" type="text" value="<?php echo $dres['city_name']?>" id="dname" />
                </form>                </td>
              </tr>
              <tr>
                <td>Date of jouney : </td>
                <td><form id="form4" name="form4" method="post" action="">
                  <input name="doj" type="text" value="<?php echo $_GET['DOJ'];?>" id="doj" />
                </form>                </td>
              </tr>
              <tr>
                <td>Bus Name : </td>
                <td><form id="form5" name="form5" method="post" action="">
                  <input name="bname" type="text" value="<?php echo $bres['bus_name']?>" id="bname" />
                </form>                </td>
              </tr>
              <tr>
                <td>Departure Time: </td>
                <td><form id="form6" name="form6" method="post" action="">
                  <input name="dtime" type="text" value="<?php echo $dtres['dep_time']?>" id="dtime" />
                </form>
                </td>
              </tr>
              <tr>
                <td>Arrival Time: </td>
                <td><input name="atime" type="text" value="<?php echo $atres['arr_time']?>" id="atime" /></td>
              </tr>
            </table>
              <p>&nbsp;</p></th>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <?php 
		  $tot_seat = $bres['total_no_seat'];
		  $first_seat = $tot_seat-5;
		  
		  ?>
          <tr>
            <td align="center"><table width="300" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <th scope="col">&nbsp;</th>
              </tr>
			 
              <tr>
			   <?php
			   			
			  for($fs = 1; $fs <= $first_seat; $fs++)
			  {
			  	
			  ?>
                <td id="tabledata<?php echo $fs;?>" width="60" height="40" align="center" <?php if(in_array($fs,$booked_seat)){?>style="background-color:#FF0000"<?php }else{?>onclick="colorchange(<?php echo $fs;?>)" style="background-color:#CCCCFF; cursor:pointer"<?php }?>><?php echo $fs;?>
                  <input name="flg<?php echo $fs;?>" type="hidden" id="flg<?php echo $fs;?>" value="0" /></td>
				
				<?php
					if($fs % 2 == 0 && $fs % 4 != 0)
					{
						echo "<td width=\"60\" align=\"center\">&nbsp;</td>";
					}
					if($fs % 4 == 0)
					{
						echo "</tr><tr>";
					}
			  }
			  ?>
              </tr>
			  
              <tr>
			  	<?php
				for($ls=41; $ls <= $tot_seat; $ls++)
				{
				?>
                <td  id="tabledata<?php echo $ls;?>" width="60" height="40" align="center" <?php if(in_array($ls,$booked_seat)){?>style="background-color:#FF0000"<?php }else{?>onclick="colorchange(<?php echo $ls;?>)" style="background-color:#CCCCFF; cursor:pointer"<?php }?>><?php echo $ls;?><input name="flg<?php echo $ls;?>" type="hidden" id="flg<?php echo $ls;?>" value="0" /></td>
				<?php
				}
				?>
              </tr>
            </table></td>
          </tr>
        </table></th>
        <th width="50%" align="center" valign="top" scope="col"><form id="form1" name="form1" method="post" action="">
          <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th width="45%" height="30" align="right" scope="col">Passenger Name </th>
              <th width="10%" align="center" scope="col">:</th>
              <th width="45%" align="left" scope="col"><input name="pname" type="text" id="pname" /></th>
            </tr>
            <tr>
              <td height="30" align="right">Mobile Number </td>
              <td align="center">:</td>
              <td align="left"><input name="mno" type="text" id="mno" /></td>
            </tr>
            <tr>
              <td height="30" align="right">Email Address </td>
              <td align="center">:</td>
              <td align="left"><input name="email" type="text" id="email" /></td>
            </tr>
            <tr>
              <td height="30" align="right"><input name="bid" type="hidden" id="bid" value="<?php echo $_GET['B'];?>" /><input name="doj" type="hidden" id="doj" value="<?php echo $_GET['DOJ'];?>" />
              <input name="did" type="hidden" id="did" value="<?php echo $_GET['D'];?>" />
              <input name="sid" type="hidden" id="sid" value="<?php echo $_GET['S'];?>" />
              <input name="sel_seat" type="hidden" value="<?php echo $new_sel_seat; ?>" id="sel_seat" /></td>
              <td align="center">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" value="Submit" /></td>
            </tr>
          </table>
                </form>
        </th>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

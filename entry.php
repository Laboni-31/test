<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include "includes/chk_login.php";
include "includes/config.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Entry</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td><?php include "includes/header.php";?></td>
  </tr>
  <tr>
    <td><table width="80%" border="0" align="center" cellpadding="1" cellspacing="1">
      <tr>
        <td align="center"><a href="city_entry.php">City Entry</a></td>
        <td align="center"><a href="bus_entry.php">Bus Entry</a></td>
        <td align="center"><a href="route_entry.php">Route Entry</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>

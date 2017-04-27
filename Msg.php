<?php require_once('Connections/chat.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$myid_Recordset1 = "-1";
if (isset($_COOKIE['Name'])) {
  $myid_Recordset1 = $_COOKIE['Name'];
}
mysql_select_db($database_chat, $chat);
$query_Recordset1 = sprintf("SELECT * FROM chat WHERE Name = %s OR Private=%s OR Private='ALL' ORDER BY ID DESC LIMIT 20", GetSQLValueString($myid_Recordset1, "text"),GetSQLValueString($myid_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $chat) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<meta http-equiv="refresh" content="15"
</head>

<body>
<?php do { ?>
  <table width="80%" border="0">
    <tr>
      <td>
        <font color = "<?php echo $row_Recordset1['Sex']; ?>">
        <?php echo $row_Recordset1['Name']; ?>
        </font>
         <?php 
		 	if($row_Recordset1['Private']==$_COOKIE['Name']){
				echo "<font color=red>給你的悄悄話:</font>";
				}
			elseif($row_Recordset1['Private']!='ALL'){
				echo "<font color=red>給".$row_Recordset1['Private']."的悄悄話:</font>";
				}  
			else
				echo "說:";
		 
		 ?>
        說:
        <font color="<?php echo $row_Recordset1['Color']; ?>">
        <?php echo $row_Recordset1['Msg']; ?>
        </font>
        &nbsp; <?php echo $row_Recordset1['Time']; ?>
       </td>
    </tr>
  </table>
  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>

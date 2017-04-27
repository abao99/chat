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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO chat (Name, Sex, Msg, Color, Private, `Time`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Msg'], "text"),
                       GetSQLValueString($_POST['Color'], "text"),
                       GetSQLValueString($_POST['Private'], "text"),
                       GetSQLValueString($_POST['Time'], "date"));

  mysql_select_db($database_chat, $chat);
  $Result1 = mysql_query($insertSQL, $chat) or die(mysql_error());

  $insertGoTo = "chat.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
if(isset($_POST['Color'])){
	setcookie('Color',$_POST['Color'],time()+600);
	}
?>
<body onLoad="window.top.mainFrame.location.reload(); document.forml.Msg.focus();">
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="50%" border="1" align="center">
    <tr>
      <td width="20%" align="left" valign="middle">色彩:
        <label for="Color"></label>
        <select name="Color" id="Color">
          <option value="#000000" <?php if (!(strcmp("#000000", $_COOKIE['Color']))) {echo "selected=\"selected\"";} ?>>黑色</option>
          <option value="#333333" <?php if (!(strcmp("#333333", $_COOKIE['Color']))) {echo "selected=\"selected\"";} ?>>灰色</option>
          <option value="#009900" <?php if (!(strcmp("#009900", $_COOKIE['Color']))) {echo "selected=\"selected\"";} ?>>綠色</option>
          <option value="#ff6600" <?php if (!(strcmp("#ff6600", $_COOKIE['Color']))) {echo "selected=\"selected\"";} ?>>橘色</option>
          <option value="#0033ff" <?php if (!(strcmp("#0033ff", $_COOKIE['Color']))) {echo "selected=\"selected\"";} ?>>藍色</option>
          <option value="#ff0000" <?php if (!(strcmp("#ff0000", $_COOKIE['Color']))) {echo "selected=\"selected\"";} ?>>紅色</option>
      </select></td>
      <td align="left" valign="middle">內容:
        <label for="Msg"></label>
      <input name="Msg" type="text" id="Msg" size="50">
      <input type="submit" name="button" id="button" value="送出"></td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="middle">悄悄話:
        <label for="Private"></label>
      <input name="Private" type="text" id="Private" value="ALL" size="50">
      <input name="Name" type="hidden" id="Name" value="<?php echo $_COOKIE['Name']; ?>">
      <input name="Sex" type="hidden" id="Sex" value="<?php echo $_COOKIE['Sex']; ?>">
      <input name="Time" type="hidden" id="Time" value="<?php echo date("Y-m-d H:i:s"); ?>"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>
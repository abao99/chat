<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>
<?php
if(isset($_POST['Name'])){
	setcookie('Name',$_POST['Name'],time()+600);
	setcookie('Sex',$_POST['Sex'],time()+600);
	
	header("Location:main.php");
	}
?>
<body>
<center>
  <h3>聊天室</h3>
</center>
<hr>
<p></p>
<form action="index.php" method="post" name="form1" id="form1">
  <table width="50%" border="1" align="center">
    <tr>
      <td width="20%" align="center" valign="middle">暱稱:</td>
      <td valign="middle"><label for="Name"></label>
      <input type="text" name="Name" id="Name"></td>
    </tr>
    <tr>
      <td width="20%" align="center" valign="middle">性別:</td>
      <td valign="middle"><input type="radio" name="Sex" id="radio" value="#0066CC">
        男
        <label for="Sex">
          <input type="radio" name="Sex" id="radio2" value="#FF0066">
    女</label></td>
    </tr>
    <tr>
      <td colspan="2" align="right" valign="middle"><input type="submit" name="button" id="button" value="送出"></td>
    </tr>
  </table>
</form>
<p></p>
</body>
</html>
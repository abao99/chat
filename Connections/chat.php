<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_chat = "localhost";
$database_chat = "chat";
$username_chat = "admin";
$password_chat = "123456";
$chat = mysql_pconnect($hostname_chat, $username_chat, $password_chat) or trigger_error(mysql_error(),E_USER_ERROR);mysql_query("set names uf8");
?>
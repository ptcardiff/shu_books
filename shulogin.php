<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
<?php // shulogin.php

$db_hostname = 'localhost';
$db_database = 'shu_books';
$db_username = 'paul';
$db_password = 'everton';
$appname = "SHU Books"; 

$currency = "£";

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);

mysql_connect($db_hostname, $db_username, $db_password) or die(mysql_error());
mysql_select_db($db_database) or die(mysql_error());

function queryMysql($query)
{
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

function destroySession()
{
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}
//
//function showProfile($user)
//{
//    if (file_exists("$user.jpg"))
//        echo "<img src='$user.jpg' border='1' align='left' />";
//
//    $result = queryMysql("SELECT * FROM rnprofiles WHERE user='$user'");
//
//    if (mysql_num_rows($result))
//    {
//        $row = mysql_fetch_row($result);
//        echo stripslashes($row[1]) . "<br clear=left /><br />";
//    }
//}
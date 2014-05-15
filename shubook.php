<?php //shubook.php

echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

if (isset($_GET['view']))
    $view = ($_GET['view']); //add sanitizestring
    
$query = "SELECT * FROM book WHERE BookID = $view";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
        $row = mysql_fetch_row($result);
echo <<<_END
<li>$row[1]</li>
_END;
}
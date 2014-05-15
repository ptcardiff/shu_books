<?php // index.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$title = $bookID = "";

echo <<<_END
    <div class="outerBlock">
    <h2>SHU Books Homepage</h2>
    <h3>Top 10 Best Sellers</h3>
_END;

$query = "SELECT * FROM book";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
        $row = mysql_fetch_row($result);
echo <<<_END
                <ul>
                    <li><a href='shubook.php?view=$row[0]'>$row[1]</a></li>
                </ul>        
_END;
}

echo <<<_END
    </div>

_END;

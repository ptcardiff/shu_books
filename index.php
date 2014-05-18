<?php // index.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$title = $search = $bookID = "";

echo <<<_END
    <div class="outerBlock">
    <form action='index.php' method='post'>
    <input type='text' placeholder=' Search SHU books' id='search' name='search' class='registrationInput'/><input type='submit' value='Search' />
    <h2>SHU Books Homepage</h2>
_END;

if (isset($_POST['search']))
{
    echo "<h3>Search results</h3>";
    $search = sanitizeString($_POST['search']);
    
    $query = "SELECT * FROM book WHERE title LIKE '%$search%'";
    
        $result = mysql_query($query);
        $rows = mysql_num_rows($result); 
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            $row = mysql_fetch_row($result);
{
echo <<<_END
                <ul>
                    <li><a href='shubook.php?view=$row[0]'>$row[1]</a></li>
                </ul>        
_END;
}
}
}
else
{
echo  "<h3>Top 10 Best Sellers</h3>";
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
}
echo <<<_END
    </div>

_END;


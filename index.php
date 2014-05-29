<?php // index.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$title = $search = $bookID = "";

?>

    <div class="container">
    <div class="jumbotron text-center">
    <form action='index.php' method='post'>
    <input type='text' placeholder=' Search SHU books' id='search' name='search' class='registrationInput'/><input type='submit' class="btn btn-info" value='Search' />
    <h2>SHU Books Homepage</h2>
    </div>
    </div>

<div class="container text-center">
    <div class="containerMiddle">
<?php
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
                <ul style="list-style:none;">
                    <li><a href='shubook.php?view=$row[0]'>$row[1]</a></li>
                </ul>        
_END;
}
}
}
else
{
echo  "<h3>Top 10 Best Sellers</h3>";
$query = "SELECT * FROM book ORDER BY BookID LIMIT 10 ";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
        $row = mysql_fetch_row($result);
echo <<<_END
                <ul style="list-style:none;">
                    <li><a href='shubook.php?view=$row[0]'>$row[1]</a></li>
                </ul>        
_END;
}
}
?>

    </div>
</div>


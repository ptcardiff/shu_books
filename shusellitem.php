<?php // shureg.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$error = $isbn = $title = "";

if (isset($_POST['isbn']))

{
    $isbn = ($_POST['isbn']); // add sanitizeString function before $_POST

    if ($isbn == "") //and tick box is not selected
    {
        $error = "You have not entered an isbn number<br />";
    }
    else
    {
        $query = "SELECT * FROM book
                WHERE isbn='$isbn'";
        $result = mysql_query($query);
        $rows = mysql_num_rows($result); //not the cleanest way to query but it works try and identify better way if time permits
        for ($j = 0 ; $j < $rows ; ++$j)
        
        {
        $row = mysql_fetch_row($result);
        setcookie('sellbookid', $row[0]);
        header("Location: shusellitemdetails.php?view=$row[0]");
        }
                if (mysql_num_rows(queryMysql($query)) == 0)
        {
            $error = "ISBN not found in the database. Please add book details here<br />";
        }
    }
}

echo <<<_END
<div class="outerBlock">
    <h3>Enter the ISBN of the book you want to sell</h3>
        <div class="mainBlock">
            <form method='post' action='shusellitem.php'>$error
                <input type='text' placeholder=' Enter 10 digit ISBN number' maxlength='10' name='isbn' class='registrationInput' value='$isbn' /> <br />
                <input type='submit' class='button' value='Retrieve book details'/> <br />
            </form>
        </div>
</div>
_END;

//<input type='checkbox' onclick="this.form.title.style.visibility = this.checked? 'visible' : 'hidden';" name ='noisbn' value='noisbn'>Tick here if you do not know the isbn number<br />
//                <input type='text' style='visibility:hidden' id="title" placeholder=' Enter the title of the book' maxlength='100' name='title' class='registrationInput' value='$title' /> <br />

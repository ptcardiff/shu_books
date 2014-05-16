<?php //addbookdetails.php

echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$error = $title = $synopsis = $isbn = $subject = "";

if (isset($_POST['isbn']))
{
    $isbn = sanitizeString($_POST['isbn']);
    $title = sanitizeString($_POST['title']);
    $synopsis = sanitizeString($_POST['synopsis']);
    $subject = sanitizeString($_POST['subject']);

{
    $query = "INSERT INTO book (isbn, title, synopsis, subject) VALUES ('$isbn', '$title', '$synopsis', '$subject')";
    queryMysql($query);
    //add the book id to a cookie for use on next page
    die("Book has been added. Please continue here"); //display upload succesful message and return to homepage
}
}

    

echo <<<_END
<div class="outerBlock">
    <h3>Add the remaining details for the item you wish to sell</h3>
        <div class="mainBlock">
            <form method='post' action='addbookdetails.php'>$error
                <input type='text' id='isbn' placeholder=' 10 character ISBN' maxlength='10' name='isbn' class='registrationInput'/> <br />
                <input type='text' id='title' placeholder=' Book Title' maxlength='100' name='title' class='registrationInput'/> <br />
                <input type='text' id='synopsis' placeholder=' Book Synopsis' maxlength='500' name='synopsis' class='registrationInput'/> <br />
_END;

$query = mysql_query("SELECT * FROM subject"); 

echo '<select name="subject">'; 
echo '<option value="" disabled selected>Select the subject of the book...</option>';
while ($row = mysql_fetch_array($query)) {
   echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

echo '</select><br />';

echo <<<_END
                <input type="submit" value="Add Book Details" />
            </form>
        </div>
</div>
_END;
        
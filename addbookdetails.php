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
    $query = "INSERT INTO book (isbn, title, synopsis, subjectID) VALUES ('$isbn', '$title', '$synopsis', '$subject')";
    queryMysql($query);
    $query2 = "SELECT bookID FROM book WHERE isbn = '$isbn'";//add the book id to a cookie for use on next page
    $result2 = mysql_query($query2);
    $rows = mysql_num_rows($result2); //not the cleanest way to query but it works try and identify better way if time permits
    for ($j = 0 ; $j < $rows ; ++$j)   
        
    $row = mysql_fetch_row($result2);
    setcookie('sellbookid', $row[0]);
    die("Book has been added. Please continue <a href='shusellitemdetails.php'>here</a>"); //display upload succesful message and return to homepage
}
}
   

echo <<<_END
<div class="container text-center">
  <div class="containerMiddle">
    <h4>Add book details</h4>
   <div class="row">
       <div class="col-md-4 col-md-offset-4">
            <form method='post' class="form-horizontal" role="form" action='addbookdetails.php'>$error
                <input type='text' id='isbn' placeholder='10 character ISBN' maxlength='10' name='isbn' class='form-control'/> <br />
                <input type='text' id='title' placeholder='Book Title' maxlength='100' name='title' class='form-control'/> <br />
                <input type='text' id='synopsis' placeholder='Book Synopsis' maxlength='500' name='synopsis' class='form-control'/> <br />
_END;

$query = mysql_query("SELECT * FROM subject"); 

echo '<select name="subject" class="form-control">'; 
echo '<option value="" disabled selected>Select the subject of the book...</option>';
while ($row = mysql_fetch_array($query)) {
   echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

echo '</select><br />';

echo <<<_END
                <input type="submit" class="btn btn-info" value="Add Book Details" />
            </form>
            </div>
            </div>
    </div>
</div>
_END;
        
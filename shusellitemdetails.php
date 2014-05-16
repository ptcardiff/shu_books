<?php //shubook.php

echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$error = $bookID = $description = $price = $collection = $book_condition = $delivery_cost = "";

if (isset($_COOKIE['sellbookid']))
$bookID = $_COOKIE['sellbookid'];
//($_GET['view']); //add sanitizestring
//if (isset($_COOKIE['username'])) $username = $_COOKIE['username'];
//    
$query = "SELECT * FROM book WHERE BookID = $bookID";
$result = mysql_query($query);

if (!$result) die ("Database access failed: " . mysql_error());
$rows = mysql_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)
{
        $row = mysql_fetch_row($result);
echo <<<_END
<label>Book Name<li>$row[1]</li></label>
<label>Book Synopsis<li>$row[2]</li></label>
<label>ISBN<li>$row[4]</li></label>
_END;
}

if (isset($_POST['price']))    
  
{
    if (isset($_COOKIE['sellbookid']))
    $bookID = $_COOKIE['sellbookid'];
    $price = sanitizeString($_POST['price']); //add Javascript for checking that price has been added
    $description = sanitizeString($_POST['description']);
    $book_condition = sanitizeString($_POST['book_condition']); //add Javascript for checking that book condition has been completed
    $collection = sanitizeString($_POST['collection']);
    $delivery_cost = sanitizeString($_POST['delivery_cost']);
    
{ 
    $query = "INSERT INTO item (BookID, Price, description, conditionID, collection, delivery_cost) VALUES ('$bookID', '$price', '$description', '$book_condition', '$collection', '$delivery_cost')";
    queryMysql($query);
    header("Location: index.php");
    //die("Item created"); //display upload succesful message and return to homepage
}
}

echo <<<_END
<div class="outerBlock">
    <h3>Add the remaining details for the item you wish to sell</h3>
        <div class="mainBlock">
            <form method='post' action='shusellitemdetails.php'>$error
                <input type='text' id='price' placeholder=' Price' maxlength='10' name='price' class='registrationInput', value='$price' /> <br />
                <input type='text' placeholder=' Book Description' maxlength='200' name='description' class='registrationInput' value='$description' /> <br />
_END;
        
$query = mysql_query("SELECT * FROM book_condition"); 

echo '<select name="book_condition">'; 
echo '<option value="" disabled selected>Select the condition of the book...</option>';
while ($row = mysql_fetch_array($query)) {
   echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

echo '</select><br />';
        
echo <<<_END
                <input type='hidden' name='collection' value=0 />             
                <input type='checkbox' onclick="this.form.delivery_cost.style.visibility = this.checked? 'hidden' : 'visible';" name ='collection' value=1>Collection only?<br />
                <input type='text' id='delivery_cost' placeholder=' Delivery Cost' maxlength='10' name='delivery_cost' class='registrationInput' value='$delivery_cost' /> <br />
                <input type="submit" value="ADD RECORD" />
            </form>
        </div>
</div>
_END;


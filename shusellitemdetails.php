<?php //shubook.php

echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$error = $bookID = $description = $price = $collection = $book_condition = $delivery_cost = $image = "";

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
<div class="container">
<div class="jumbotron">
<ul style="list-style:none;">
<label>Book Name</label> <li>$row[1]</li>
<label>Book Synopsis</label> <li>$row[2]</li>
<label>ISBN</label><li>$row[4]</li>
</ul>
</div>
</div>
        
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
    $image = sanitizeString($_POST['image']);
    
{ 
    $query = "INSERT INTO item (BookID, Price, description, conditionID, collection, delivery_cost, image) VALUES ('$bookID', '$price', '$description', '$book_condition', '$collection', '$delivery_cost', $image)";
    queryMysql($query);
    header("Location: index.php");
    //die("Item created"); //display upload succesful message and return to homepage
}
}

echo <<<_END
<div class="container">
  <div class="containerMiddle">
   <h4>Add the remaining details for the item you wish to sell</h4>
   <form method='post' action='shusellitemdetails.php'>$error
   <div class="row">
       <div class="col-md-4 col-md-offset-4">
            <input type='text' id='price' placeholder='Price' maxlength='10' name='price' class='form-control', value='$price' /> <br />
            <input type='text' placeholder='Book Description' maxlength='200' name='description' class='form-control' value='$description' /> <br />
_END;
        
$query = mysql_query("SELECT * FROM book_condition"); 

echo '<select name="book_condition" class="form-control">'; 
echo '<option value="" disabled selected>Select the condition of the book...</option>';
while ($row = mysql_fetch_array($query)) {
   echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}

echo '</select><br />';
        
echo <<<_END
                <input type='hidden' name='collection' value=0 />             
                <div class="form-group">
                <div class="checkbox">
                <label>
                <input type='checkbox' onclick="this.form.delivery_cost.style.visibility = this.checked? 'hidden' : 'visible';" name ='collection' value=1>Collection only?<br />
                </label>
                </div>
                </div>
                <input type='text' id='delivery_cost' placeholder='Delivery Cost' maxlength='10' name='delivery_cost' class='form-control' value='$delivery_cost' /> <br />
                <label>Image</label><input type='file' name='image'/> <br />
                <input type="submit" class="btn btn-info" value="Add Item" />
                </div>
                </div>
            </form>
    </div>
</div>
_END;


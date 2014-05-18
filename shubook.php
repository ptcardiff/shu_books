<?php //shubook.php

session_start();

echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

if (isset($_GET['view']))
    $view = sanitizeString($_GET['view']);

$query2 = "SELECT * FROM book WHERE bookid = $view";
$result2 = mysql_query($query2);

$rows2 = mysql_num_rows($result2);

for ($j2 = 0 ; $j2 < $rows2 ; ++$j2)
{
    $row2 = mysql_fetch_row($result2);
    echo "<h3>$row2[1]</h3>";
}

echo "<div class='books'>";
echo "<h3>Used books for sale</h3>";
    
$results = $mysqli->query("SELECT b.bookid, b.title, i.itemid, i.description, i.price, c.condition_name, i.studentid, i.collection, i.delivery_cost, s.email_address FROM book b, item i, book_condition c, student s WHERE i.bookid = b.bookid AND i.conditionid = c.conditionid AND i.studentid = s.studentid AND i.bookid = '$view'");
if ($results) {
    while($obj = $results->fetch_object())
    {
        echo '<div class"item">';
        echo '<form method="post" action"shubasketupdate.php"';
        echo '<div class="price">Price '.$obj->price.' <button class="add_to_basket">Add to basket</button></div>';
        echo '<input type="hidden" name="itemID" value="'.$obj->itemid.'"/>';
        echo '<input type ="hidden" name="type" value="add" />';
        echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
        echo '</form>';
        echo '</div>';
    }
}
echo '</div>';

//$result = mysql_query($query);
//
//if (!$result) die ("Database access failed: " . mysql_error());
//$rows = mysql_num_rows($result);
//
//for ($j = 0 ; $j < $rows ; ++$j)
//{
//        $row = mysql_fetch_row($result);
//echo <<<_END
//        <div class='item'>
//        <form method="post" action="basket_update.php">
//        <div class="price">$row[4] <button class="add_to_basket">Add  to basket</button></div>
//        <input type="hidden" name="itemID" value="$row[2]" />
//        <input type ="hidden" name="type" value="add" />
//        <input type="hidden" name="return_url" value="$current_url"
//        </form>
//        </div>
//        </div>
//        
//_END;
//}

echo "<div class='shopping-basket'>";
echo "<h2>Your Shopping Basket</h2>";
if(isset($_SESSION["books"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["books"] as $basket_itm)
    {
        echo '<li class="basket-itm">';
        echo '<span class="remove-itm"><a href="shubasketupdate.php?removep='.$basket_itm["itemid"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$basket_itm["title"].'</h3>';
        echo '<div class="p-itemid">Item ID : '.$basket_itm["itemid"].'</div>';
        echo '<div class="p-price">Price :'.$basket_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($basket_itm["price"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$total.'</strong> <a href="view_basket.php">Check-out!</a></span>';
    echo '<span class="empty-basket"><a href="shubasketupdate.php?emptybasket=1&return_url='.$current_url.'">Empty Basket</a></span>';
}else{
    echo 'Your Basket is empty';
}
echo '</div>';

<?php //shubook.php

//session_start();

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
        //output results from database
        while($obj = $results->fetch_object())
        {
           
            echo '<div class="product">';
            echo '<form method="post" action="cart_update.php">';
            echo '<div class="product-content"><h3>'.$currency.$obj->price.'</h3>';
            echo '<div class="product-desc">Condition: '.$obj->condition_name.'</div>';
            echo '<div class="product-info">Seller: '.$obj->email_address.' <button class="add_to_cart">Add To Basket</button></div>';
            echo '</div>';
            echo '<input type="hidden" name="product_code" value="'.$obj->itemid.'" />';
            echo '<input type="hidden" name="type" value="add" />';
            echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
        }
   
}
?>
</div>

<div class="shopping-cart">
<h2>Shopping Basket</h2>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">Remove from Basket</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong>';
    echo '<a href="view_cart.php">Go to Check-out</a></span>';
    echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Basket</a></span>';
}else{
    echo 'Your Basket is empty';
}
?>
</div>
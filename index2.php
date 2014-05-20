<?php
//session_start();
include_once("shutoplevel.php");
?>

<div class="products">
<?php
//current URL of the Page. cart_update.php redirects back to this URL
$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
   
    $results = $mysqli->query("SELECT b.bookid, b.title, i.itemid, i.description, i.price, c.condition_name, i.studentid, i.collection, i.delivery_cost, s.email_address FROM book b, item i, book_condition c, student s WHERE i.bookid = b.bookid AND i.conditionid = c.conditionid AND i.studentid = s.studentid");
    if ($results) {
        //output results from database
        while($obj = $results->fetch_object())
        {
           
            echo '<div class="product">';
            echo '<form method="post" action="cart_update.php">';
            echo '<div class="product-content"><h3>'.$obj->studentid.'</h3>';
            echo '<div class="product-desc">'.$obj->description.'</div>';
            echo '<div class="product-info">Price '.$currency.$obj->price.' <button class="add_to_cart">Add To Cart</button></div>';
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
<h2>Your Shopping Cart</h2>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
    echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
}else{
    echo 'Your Cart is empty';
}
?>
</div>


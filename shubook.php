<?php //shubook.php

//session_start();

echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<div class="container">
    <div class="jumbotron text-center">
<?php
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
?>
    </div>
</div>

<div class="container">
 <div class="containerMiddle">
    <div class="row">            
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="page-header">
                        <h3>Items for sale</h3>
                    </div>

<?php

echo "<div class='books'>";
    
$results = $mysqli->query("SELECT b.bookid, b.title, i.itemid, i.description, i.price, c.condition_name, i.studentid, i.collection, i.delivery_cost, s.email_address FROM book b, item i, book_condition c, student s WHERE i.bookid = b.bookid AND i.conditionid = c.conditionid AND i.studentid = s.studentid AND i.bookid = '$view' AND i.purchased=0");
    if ($results) {
        //output results from database
        while($obj = $results->fetch_object())
        {
           
            echo '<div class="product">';
            echo '<form method="post" action="cart_update.php">';
            echo '<div class="product-info"><p><b>Seller: </b>' .$obj->email_address.'</p>';
            echo '<div class="product-content"><p><b>Price: </b>'.$currency.$obj->price.'</p>';
            echo '<div class="product-desc"><p><b>Book Condition: </b>'.$obj->condition_name.'</p></div>';
            echo '<button class="btn btn-info">Add To Basket</button></div>';
            echo '</div>';
            echo '<input type="hidden" name="product_code" value="'.$obj->itemid.'" />';
            echo '<input type="hidden" name="type" value="add" />';
            echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
        }
   
}
echo "</div>"
?>
             </div>
            </div>
        </div>
 
        <div class="col-md-3">
            <div class="shopping-cart">
                <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="page-header">
                                <h3>Shopping Basket</h3>
                            </div>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<p><b>'.$cart_itm["name"].'</b></p>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">Remove from Basket</a></span>';
        //echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> </br>';
    echo '<a href="view_cart.php">Go to Check-out</a></span> </br>';
    echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Basket</a></span>';
}else{
    echo 'Your Basket is empty';
}
?>
                    </div>
                </div>
            </div>        
        </div>
    </div>
  </div>
</div>
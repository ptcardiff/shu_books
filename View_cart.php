<?php
//session_start();
include_once("shutoplevel.php");

$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

    if(isset($_SESSION["products"]))
    {
        $total = 0;
        echo '<div class="container text-center">';
        echo '<div class="containerMiddle">';
        echo '<ul style="list-style:none;">';
        $cart_items = 0;
        foreach ($_SESSION["products"] as $cart_itm)
        {
           $itemid = $cart_itm["code"];
           $results = $mysqli->query("SELECT itemid, title, studentid, description, price FROM item, book WHERE item.bookid = book.bookid AND itemid='$itemid'");
           $obj = $results->fetch_object();
           
            echo '<li class="cart-itm">';
            echo '<div class="product-info">';
            echo '<h4>'.$obj->title.' (Code :'.$itemid.')</h4> ';
            echo '<div class="p-price">'.$currency.$obj->price.'</div>';
            echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">Remove from Basket</a></span></br>';
            echo '</div>';
            echo '</li>';
            $subtotal = ($cart_itm["price"]);
            $total = ($total + $subtotal);

            echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->studentid.'" />';
            echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$itemid.'" />';
            echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->description.'" />';
            $cart_items ++;
           
        }
        echo '</ul>';
        echo '<span class="check-out-txt">';
        echo '<strong>Total : '.$currency.$total.'</strong>  ';
        echo '<span class="purchase-itm"><a href="shupurchase.php?purchase='.$cart_itm["code"].'">Place your order</a></span>';
        echo '</span>';
        echo '</div>';
        echo '</div>';
       
    }
    else
    {
        echo '<div class="container text-center">';
        echo '<div class="containerMiddle">';
        echo 'Your Basket is empty';
        echo '</div>';
        echo '</div>';
    }
?>

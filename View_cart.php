<?php
//session_start();
include_once("shutoplevel.php");

$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

    if(isset($_SESSION["products"]))
    {
        $total = 0;
        //echo '<form method="post" action="PAYMENT-GATEWAY">';
        echo '<ul>';
        $cart_items = 0;
        foreach ($_SESSION["products"] as $cart_itm)
        {
           $itemid = $cart_itm["code"];
           $results = $mysqli->query("SELECT itemid, studentid, description, price FROM item WHERE itemid='$itemid' AND purchased=0");
           $obj = $results->fetch_object();
           
            echo '<li class="cart-itm">';
            echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">Remove from Basket</a></span>';
            echo '<div class="p-price">'.$currency.$obj->price.'</div>';
            echo '<div class="product-info">';
            echo '<h3>'.$obj->studentid.' (Code :'.$itemid.')</h3> ';
            echo '<div>'.$obj->description.'</div>';
            echo '<span class="purchase-itm"><a href="shupurchase.php?purchase='.$cart_itm["code"].'">Purchase Item</a></span>';
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
        echo '</span>';
        echo '</form>';
       
    }
    else
    {
        echo 'Your Basket is empty';
    }
?>

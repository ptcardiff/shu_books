<?php
include_once("shutoplevel.php");
 
if(isset($_SESSION["products"]) && isset($_SESSION["studentid"]))
    //&& isset($_GET["return_url"])
{
    //$itemid   = sanitizeString($_GET["purchase"]); //get the book code to purchase
    //$return_url     = base64_decode($_GET["return_url"]); //get return url

   
        foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
    
        {
        $itemid = $cart_itm["code"];
        $query = "INSERT INTO transaction (ItemID, TransactionDate, StudentID) VALUES('$itemid', now(), '$_SESSION[studentid]')";
        queryMysql($query);
        $query2 = "UPDATE item SET purchased=1 WHERE ItemID = '$itemid'";
        queryMysql($query2);
        }
        unset($_SESSION["products"]);
        echo "Transaction succesful. Please select here to go back to your shopping basket";
        

        
        //if($cart_itm["code"]!=$itemid){ //item does,t exist in the list
        //    $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'price'=>$cart_itm["price"]);
     
       
        //create a new product list for cart
        //$_SESSION["products"] = $product;
}

else
{
    echo "Transaction has failed";
}
   
    //redirect back to original page
    //header('Location:'.$return_url);


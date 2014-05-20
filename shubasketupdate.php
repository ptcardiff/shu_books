<?php
session_start(); 

include_once("shulogin.php"); 

if(isset($_GET["emptybasket"]) && $_GET["emptybasket"]==1)
{
    $return_url = base64_decode($_GET["return_url"]); //return url
    session_destroy();
    header('Location:'.$return_url);
}

//add item in shopping basket
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
    $itemid         = filter_var($_POST["itemid"], FILTER_SANITIZE_STRING); //product code
    $return_url     = base64_decode($_POST["return_url"]); //return url
       

    //MySqli query - get details of item from db using product code
    $results = $mysqli->query("SELECT * FROM item WHERE itemid='$itemid'");
    $obj = $results->fetch_object();
   
    if ($results) { //we have the product info
       
        //prepare array for the session variable
        $new_book = array(array('description'=>$obj->description, 'itemid'=>$itemid, 'price'=>$obj->price));
       
        if(isset($_SESSION["books"])) //if we have the session
        {
            $found = false; //set found item to false
           
            foreach ($_SESSION["books"] as $basket_itm) //loop through session array
            {
                if($basket_itm["itemid"] == $itemid){ //the item exist in array

                    $book[] = array('description'=>$basket_itm["description"], 'itemid'=>$basket_itm["itemid"], 'price'=>$basket_itm["price"]);
                    $found = true;
                }else{
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $book[] = array('description'=>$basket_itm["description"], 'itemid'=>$basket_itm["itemid"], 'price'=>$basket_itm["price"]);
                }
            }
           
            if($found == false) //we didn't find item in array
            {
                //add new user item in array
                $_SESSION["books"] = array_merge($book, $new_book);
            }else{
                //found user item in array list, and increased the quantity
                $_SESSION["books"] = $book;
            }
           
        }else{
            //create a new session var if does not exist
            $_SESSION["books"] = $new_book;
        }
       
    }
   
    //redirect back to original page
    header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["books"]))
{
    $itemid   = $_GET["removep"]; //get the product code to remove
    $return_url     = base64_decode($_GET["return_url"]); //get return url

   
    foreach ($_SESSION["books"] as $basket_itm) //loop through session array var
    {
        if($basket_itm["itemid"]!=$itemid){ //item does,t exist in the list
            $book[] = array('description'=>$basket_itm["description"], 'itemid'=>$basket_itm["itemid"], 'price'=>$basket_itm["price"]);
        }
       
        //create a new product list for cart
        $_SESSION["books"] = $book;
    }
   
    //redirect back to original page
    header('Location:'.$return_url);
}

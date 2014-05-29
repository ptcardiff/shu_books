<!DOCTYPE html>
<html>
    <head>
    <title>Bootstrap 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel ="stylesheet">
    <link href="css/styles.css" rel ="stylesheet">
    
    </head>
    
    <body>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <a href="#" class="navbar-brand">SHU Books</a>
                
                <button class ="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <div class="collapse navbar-collapse navHeaderCollapse">


<?php // shutoplevel.php
include 'shulogin.php';
session_start();

if (isset($_SESSION['studentid']))
{
    $studentid = $_SESSION['studentid'];
    $loggedin = TRUE;
}
else $loggedin = FALSE;

if ($loggedin)
{

    echo <<<_END
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="shusellitem.php">Sell Item</a>
                </li>
                <li>
                    <a href="shuaccount.php">Account</a>
                </li>
                <li>
                    <a href="view_cart.php">Shopping Basket</a>
                </li>
                <li>
                    <a href="shusignout.php">Sign Out</a>
                </li>
            </ul>   
_END;
}
else
{
    echo <<<_END
            <ul class="nav navbar-nav navbar-right">
               <li>
                   <a href="index.php">Home</a>
               </li>
               <li>
                   <a href="shusignin.php">Sign In</a>
               </li>
               <li>
                   <a href="shureg.php">Register</a>
               </li>
            </ul>
   
_END;
}
?>

            </div>
      </div>            
</div>
        
       
        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container">
                <p class="navbar-text pull-left">Prototype created by Paul Cardiff</p>
                <a href="#contact" data-toggle="modal" class="navbar-btn btn-info btn pull-right">Contact SHU Books</a> 
            </div>                     
        </div>
        
<div class="modal fade" id="contact" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>SHU Support</h4>
            </div>
            <div class="modal-body">
                <p>A contact form will be placed here and will issue email requests to shu books support team</p>
            </div>
            <div class ="modal-footer">
                <a class="btn btn-default" data-dismiss ="modal">Close</a>
            </div>
        </div>
    </div>    
</div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        
    </body> 
</html> 


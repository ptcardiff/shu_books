
<?php // shutoplevel.php
include 'shulogin.php';
session_start();

if (isset($_SESSION['studentid']))
{
    $studentid = $_SESSION['studentid'];
    $loggedin = TRUE;
}
else $loggedin = FALSE;

echo "<html><head><title>$appname";
echo "</title></head><body><font face='verdana' size='2'>";
echo "<h2>$appname</h2>";


if ($loggedin)
{
    echo "<b>$studentid</b>";
    echo <<<_END
    <div class="header">
    <div class="menu">
                <ul>
                <li>
                     <a style=color:black; href="index.php">Home</a>
                </li>
                <li>
                    <a style=color:black; href="shusignout.php">Sign Out</a>
                </li>
                <li>
                    <a style=color:black; href="shuaccount.php">Account</a>
                </li>
                <li>
                    <a style=color:black; href="shubasket.php">Shopping Basket</a>
                </li>
                <li>
                    <a style=color:black; href="shusellitem.php">Sell Item</a>
                </li>
            </ul>
      <br style="clear:left"/>
    </div>
    </div>
   
_END;
}
else
{
    echo <<<_END
    <div class="header">
    <div class="menu">
            <ul>
                <li>
                    <a style=color:black; href="index.php">Home</a>
                </li>
                <li>
                    <a style=color:black; href="shusignin.php">Sign In</a>
                </li>
                <li>
                    <a style=color:black; href="shureg.php">Register</a>
                </li>
            </ul>
        <br style="clear:left"/>
    </div>
    </div>
   
_END;
}

echo "</body>";

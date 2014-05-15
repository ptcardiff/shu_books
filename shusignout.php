<?php // rnlogout.php
include_once 'shutoplevel.php';

if (isset($_SESSION['email']))
{
destroySession();
echo "<h3>Log out</h3>You have been logged out.";
//add javascript to refresh the page after signing out
}
else echo "<h3>Log out</h3>You are not logged in";


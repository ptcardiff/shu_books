<?php // shusignin.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';
//sets variable
$error = $email = $password = $studentid = "";

if (isset($_POST['email']))
{
    $email = ($_POST['email']); // add sanitizeString function before $_POST
    $password = ($_POST['password']); // add sanitizeString function before $_POST

    if ($email == "" || $password == "")
    {
        $error = "You have not entered all the required fields<br />";
    }
    else
    {
        $query = "SELECT * FROM student
                WHERE email_address='$email' AND password='$password'";
        $result = mysql_query($query);
        $rows = mysql_num_rows($result); //not thd cleanest way to query but it works try and identify better way if time permits
        for ($j = 0 ; $j < $rows ; ++$j)
        {
        $studentid = mysql_result($result, $j, 'studentid');
        }

        if (mysql_num_rows(queryMysql($query)) == 0)
        {
            $error = "Email address and/or password is not recognised. Please check and try again<br />";
        }
        else
        {
            $_SESSION['studentid'] = $studentid;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("Location: index.php");
            
            /*die("You are now logged in. Please 
             <a href='index.php?view=$email'>click here</a>.");*/
        }
    }
}

echo <<<_END
<div class="outerBlock">
<h3>Sign In</h3>
   <div class="mainBlock">
        <form method='post' action='shusignin.php'>$error
            <input type='email' placeholder=' Enter Email Address' class='registrationInput' maxlength='50' name='email'
            value='$email' /><br />
            <input type='password' placeholder=' Password' class='registrationInput' maxlength='15' name='password'
            value='$password' /><br />
            <input type='submit' class='button' value='Sign In' /> &nbsp; <br /> <br />
            <a href="http://www.bbc.co.uk">Forgotten Password?</a> <br /> <br />
            Not yet registered? Register <a href="shureg.php">here</a>        
        </form>
    </div>
</div>
_END;
?>
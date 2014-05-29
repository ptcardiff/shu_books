<?php // shusignin.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

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
        $rows = mysql_num_rows($result); 
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

        }
    }
}

echo <<<_END
<div class="container text-center">
<div class="containerMiddle">
<h3>Sign In</h3>
   <div class="row">
       <div class="col-md-4 col-md-offset-4">
        <form method='post' action='shusignin.php'>$error
            <input type='email' placeholder=' Enter Email Address' class='form-control' maxlength='50' name='email'
            value='$email' /><br />
            <input type='password' placeholder=' Password' class='form-control' maxlength='15' name='password'
            value='$password' /><br />
            <input type='submit' class='btn btn-info' value='Sign In' /> &nbsp; <br /> <br />
            <a href="#forgot" data-toggle="modal">Forgotten Password?</a> <br /> <br />
            Not yet registered? Register <a href="shureg.php">here</a>        
        </form>
        </div>
   </div>
</div>
</div>
_END;
?>
<!--<a href="#contact" data-toggle="modal" class="navbar-btn btn-info btn pull-right">Contact SHU Books</a>-->

<div class="modal fade" id="forgot" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>SHU Support</h4>
            </div>
            <div class="modal-body">
                <p>Please contact shubookshelp@shu.ac.uk to have your password reset</p>
            </div>
            <div class ="modal-footer">
                <a class="btn btn-default" data-dismiss ="modal">Close</a>
            </div>
        </div>
    </div>    
</div>
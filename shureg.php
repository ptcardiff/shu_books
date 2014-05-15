<?php // shureg.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

//function queryMysql($query)
//{
//    $result = mysql_query($query) or die(mysql_error());
//    return $result;
//}

//echo <<<_END
//<script>
//function checkUser(user)
//{
//    if (user.value == '')
//    {
//        document.getElementById('info').innerHTML = ''
//        return
//    }
//
//    params  = "user=" + user.value
//    request = new ajaxRequest()
//    request.open("POST", "rncheckuser.php", true)
//    request.setRequestHeader("Content-type",
//        "application/x-www-form-urlencoded")
//    request.setRequestHeader("Content-length", params.length)
//    request.setRequestHeader("Connection", "close")
//
//    request.onreadystatechange = function()
//    {
//        if (this.readyState == 4)
//        {
//            if (this.status == 200)
//            {
//                if (this.responseText != null)
//                {
//                    document.getElementById('info').innerHTML =
//                        this.responseText
//                }
//                else alert("Ajax error: No data received")
//            }
//            else alert( "Ajax error: " + this.statusText)
//        }
//    }
//    request.send(params)
//}
//
//function ajaxRequest()
//{
//    try
//    {
//        var request = new XMLHttpRequest()
//    }
//    catch(e1)
//    {
//        try
//        {
//            request = new ActiveXObject("Msxml2.XMLHTTP")
//        }
//        catch(e2)
//        {
//            try
//            {
//                request = new ActiveXObject("Microsoft.XMLHTTP")
//            }
//            catch(e3)
//            {
//                request = false
//            }
//        }
//    }
//    return request
//}
//</script

$error = $email = $password = $forename = $surname = $address1 = $address2 = $address3 = $address4 = $postcode = $accountno = $sortcode = "";
//if (isset($_SESSION['email'])) destroySession();

if (isset($_POST['email']))
{
    $forename = ($_POST['forename']); // add sanitizeString function before $_POST
    $surname = ($_POST['surname']); // add sanitizeString function before $_POST
    $email = ($_POST['email']); // add sanitizeString function before $_POST
    $password = ($_POST['password']); // add sanitizeString function before $_POST
    $address1 = ($_POST['address1']);
    $address2 = ($_POST['address2']);
    $address3 = ($_POST['address3']);
    $address4 = ($_POST['address4']);
    $postcode = ($_POST['postcode']);
    $accountno = ($_POST['accountno']);
    $sortcode = ($_POST['sortcode']);
    

    if ($email == "" || $password == "")
    {
        $error = "Not all mandatory fields have been completed<br /><br />";
        //highlight the mandatory fields
    }
    else
    {
        $query = "SELECT * FROM student WHERE email_address='$email'";

        if (mysql_num_rows(queryMysql($query)))
        {
            $error = "That email address already exists<br /><br />";
        }
        else
        {
            $query = "INSERT INTO student (forename, surname, email_address, password, address1, address2, address3, address4, postcode, sortcode, accountno) VALUES('$forename', '$surname', '$email', '$password', '$address1', '$address2', '$address3', '$address4', '$postcode', '$sortcode', '$accountno')";
            queryMysql($query);
            die("<h4>Account created</h4> Please <a href='shusignin.php'>Sign In</a>");
        }
    }
}
//   onBlur='checkUser(this)'/><span id='info'></span><br /> - this goes when checking email address is already in 
//   Add confirmation email and confirmation password as a check to ensure that everything has been entered correctly
// Note: type="email" is not supported in Internet Explorer 9 and earlier versions
// <!--<input type='date' placeholder='Date Of Birth' name='dob' class='registrationInput' value='$dob' /> <br />-->

echo <<<_END
<div class="outerBlock">
    <h3>Registration Form</h3>
        <div class="mainBlock">
            <form method='post' action='shureg.php'>$error
                <input type='text' placeholder=' First name' maxlength='50' name='forename' class='registrationInput' value='$forename' /> <br />
                <input type='text' placeholder=' Last name' maxlength='50' name='surname' class='registrationInput' value='$surname' /> <br />
                <input type='email' placeholder=' Email address' maxlength='50' name='email' class='registrationInput' value='$email' />* <br />
                <input type='password' placeholder=' Password' maxlength='15' name='password' class='registrationInput' value='$password' />* <br /> <br />
                <label> Add Address Details </label> <br />
                <input type='text' placeholder=' Address Line 1' maxlength='50' name='address1' class='registrationInput' value='$address1' /> <br />
                <input type='text' placeholder=' Address Line 2' maxlength='50' name='address2' class='registrationInput' value='$address2' /> <br />
                <input type='text' placeholder=' Address Line 3' maxlength='50' name='address3' class='registrationInput' value='$address3' /> <br />
                <input type='text' placeholder=' Address Line 4' maxlength='50' name='address4' class='registrationInput' value='$address4' /> <br />
                <input type='text' placeholder=' Post Code' maxlength='10' name='postcode' class='registrationInput' value='$postcode' /> <br /> <br />
                <label> Add Account Details </label> <br />
                <label> (Only required for testing purposes) </label> <br />
                <label> (Strict encryption will be implemented on full version) </label> <br >
                <input type='text' placeholder=' Account Number' maxlength='8' name='accountno' class='registrationInput' value='$accountno' /> <br />
                <input type='text' placeholder=' Sort Code' maxlength='6' name='sortcode' class='registrationInput' value='$sortcode' /> <br /> <br />
                <input type='submit' class='button' value='Register' /> <br />
            </form>
        </div>
</div>
_END;
?>
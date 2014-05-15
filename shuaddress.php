<?php //shuaddress.php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$error = $address1 = $address2 = $address3 = $address4 = $postcode = $studentid = "";

if (isset($_POST['address1']))
{
    $studentid = $_SESSION['studentid'];
    $address1 = ($_POST['address1']); // add sanitizeString function before $_POST
    $address2 = ($_POST['address2']); // add sanitizeString function before $_POST
    $address3 = ($_POST['address3']); // add sanitizeString function before $_POST
    $address4 = ($_POST['address4']); // add sanitizeString function before $_POST
    $postcode = ($_POST['postcode']); // add sanitizeString function before $_POST
    

    if ($address1 == "" || $postcode == "")
    {
        $error = "Not all mandatory fields have been completed<br /><br />";
        //highlight the mandatory fields
    }
    else
    {
            $query = "INSERT INTO address (studentid, address_line_1, address_line_2, address_line_3, address_line_4, postcode ) VALUES('$studentid', $address1', $address2', '$address3', '$address4', '$postcode')";
            queryMysql($query);
            die("<h4>Account created</h4> To add an address click <a href='shuaddress.php'>here</a> <br /> To add account details click <a href='shuaccount.php'>here</a> <br /> Or <a href='shusignin.php'>Log In</a>");
        
    }
}


echo <<<_END
<div class="outerBlock">
    <h3>Add Address</h3>
        <div class="mainBlock">
            <form method='post' action='shuaddress.php'>$error
                <input type='text' placeholder=' Address Line 1' maxlength='50' name='address1' class='registrationInput' value='$address1' /> <br />
                <input type='text' placeholder=' Address Line 2' maxlength='50' name='address2' class='registrationInput' value='$address2' /> <br />
                <input type='text' placeholder=' Address Line 3' maxlength='50' name='address3' class='registrationInput' value='$address3' />* <br />
                <input type='text' placeholder=' Address Line 4' maxlength='50' name='address4' class='registrationInput' value='$address4' />* <br />
                <input type='text' placeholder=' Post Code' maxlength='10' name='postcode' class='registrationInput' value='$postcode' />* <br />
                <input type='submit' class='button' value='Add Address' /> <br />
                <button class="button" href="shuaddaccount.php">Add Account Details</button> <br />
                <button class="button" href="index.php">SHU Books Home</button> <br />
            </form>
        </div>
</div>
_END;
?>


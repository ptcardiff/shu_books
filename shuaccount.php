<?php
echo "<link rel='stylesheet' type='text/css' href='shubooks.css' />";
include_once 'shutoplevel.php';

$error = $forename = $surname = $address1 = $address2 = $address3 = $address4 = $postcode = $accountno = $sortcode = "";


if (isset($_POST['forename']))
{

    $forename = sanitizeString($_POST['forename']); 
    $surname = sanitizeString($_POST['surname']);  
    $address1 = sanitizeString($_POST['address1']);
    $address2 = sanitizeString($_POST['address2']);
    $address3 = sanitizeString($_POST['address3']);
    $address4 = sanitizeString($_POST['address4']);
    $postcode = sanitizeString($_POST['postcode']);
    $accountno = sanitizeString($_POST['accountno']);
    $sortcode = sanitizeString($_POST['sortcode']);
 
    $query = "UPDATE student SET forename='$forename', surname='$surname', address1='$address1', address2='$address2', address3='$address3', address4='$address4', postcode='$postcode', accountno='$accountno', sortcode='$sortcode'  WHERE studentid = '$_SESSION[studentid]'";
    queryMysql($query);

}

if (isset($_SESSION["studentid"]))
{
    $results = $mysqli->query("SELECT * FROM student WHERE studentid = '$_SESSION[studentid]'");
    
if ($results) 
    {
        //output results from database
        while($obj = $results->fetch_object())
        {
echo <<<_END
   <div class="container text-center">
   <div class="containerMiddle">
   <h3>Amend Details</h3>
   <div class="row">
   <div class="col-md-4 col-md-offset-4">
        <form method='post' action='shuaccount.php'>
        <p class="form-control-static" name="email">$obj->Email_address</p> <br />
        <input type="text" class="form-control" placeholder="Forename" name="forename" value=$obj->Forename> <br />
        <input type="text" class="form-control" placeholder="Surname" name="surname" value=$obj->Surname> <br />
        <h4>Edit Address Details </h4> <br />
        <input type="text" class="form-control" placeholder="Address Line 1" name="address1" value=$obj->address1> <br />
        <input type="text" class="form-control" placeholder="Address Line 2" name="address2" value=$obj->address2> <br />
        <input type="text" class="form-control" placeholder="Address Line 3" name="address3" value=$obj->address3> <br />
        <input type="text" class="form-control" placeholder="Address Line 4" name="address4" value=$obj->address4> <br />
        <input type="text" class="form-control" placeholder = "Post Code" name="postcode" value=$obj->postcode> <br />
        <h4>Edit Bank Account Details </h4> <br />
        <input type="text" class="form-control" placeholder = "Sort Code" name="sortcode" value=$obj->sortcode> <br />
        <input type="text" class="form-control" placeholder = "Account Number" name="accountno" value=$obj->accountno> <br />
        <input type='submit' class='btn btn-info' value='Update Details' /> <br />
        </form>
   </div>
   </div>
   </div>
   </div>
_END;
        }
    }
}

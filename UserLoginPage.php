<?php require("Header.php");
require_once("checkUserLogin.php");

$nameErr = $pwderr = $invalidMesg = "";

if (isset($_POST['submit'])) {

    if ($_POST["uID"] == "") {
        $uIDErr = "Application ID is required";
    } 
      
    if ($_POST["pwd"] == "") {
        $pwdErr = "Password is required";
    }

    if ($_POST["pCode"] == ""){
        $pCodeErr = "Postcode is required";
    }

    if ($_POST["lName"] == ""){
        $lNameErr = "Last Name is required";
    }

    if($_POST['uID'] != "" && $_POST["pwd"] != "" && $_POST["pCode"] != "" && $_POST["lName"] != ""){
        $array_user = verifyUsers(); 
        if ($array_user != null) {

        session_start();
        $_SESSION['pCode'] = $array_user[0]['UserPostcode'];
        $_SESSION['lName'] =$array_user[0]['UserLastName'];
        $_SESSION['uID'] = $array_user[0]['UserID'];
        $_SESSION['pwd'] = $array_user[0]['UserPassword'];
               
        header("Location: userIndex.php"); 
        exit();              
        }
        else{
            $invalidMesg = "Invalid Inputs!";
        }
    }
}

?>    

<?php require("Footer.php");?>
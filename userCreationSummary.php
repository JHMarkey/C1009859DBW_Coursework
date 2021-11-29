<?php include("Header.php"); 
include_once("CreateUserSQL.php");
session_start();
$result = $_GET['createUser'];
?>

<div class="container pb-5">
        <main role="main" class="pb-3">
        <h2>User Creation Result</h2><br>

        <div style = "height: 300px;">
            <?php
                if($result){
                    echo "Successfully created new user: ".$_SESSION["uID"];
                }
                else{
                    echo "Error";
                }
            ?>
            <div><a href="index.php">Back</a></div>
        </div>
</div>

<?php
    include("Footer.php"); 
?>

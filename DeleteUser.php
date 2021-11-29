<?php require("Header.php");

$uID = $_GET['uid'];
$db = new SQLite3('C:/xampp/Data/ABCBank.db');
$sql = "SELECT UserID, UserFirstName, UserLastName, ProductID FROM Users WHERE USerID = :uID";

$stmt = $db->prepare($sql);
$stmt->bindParam(':uID', $uID, SQLITE3_TEXT);

$Result = $stmt->execute();
$arrayResult = [];

while ($row = $Result->fetchArray()) {
    $arrayResult [] = $row;
}

$sql = "SELECT Cost FROM Products WHERE ProductID = :pID";
$stmt = $db->prepare($sql);
$stmt->bindParam(':pID', $arrayResult[0]['ProductID'], SQLITE3_NUM);

$Result = $stmt->execute();
$ProductArray = [];

while($row = $Result->fetchArray()){
    $ProductArray [] = $row;
}

if (isset($_POST['delete'])) {

    $db = new SQLite3('C:\xampp\Data\ABCBank.db');

    $stmt = "DELETE FROM Users WHERE UserId = :uID";
    $sql = $db->prepare($stmt);
    $sql->bindParam(':uID', $uID, SQLITE3_TEXT);

    $sql->execute();
    header("Location:viewUser.php?deleted=true");
}

?>

<h2>Delete User for <?php echo $uID; ?></h2><br>
<h4 style="color: red;">Are you sure want to delete this user?</h4><br>

<div class="row">
    <div class="col-md-2 f">
        <label style="font-size: 20px; color:blue; font-weight: bold;">First Name</label>
    </div>
    <div class="col-md-6">
        <label style="font-size: 20px;"><?php echo $arrayResult[0]['UserFirstName']?></label>
    </div>
</div>

<div class="row">
    <div class="col-md-2 f">
        <label style="font-size: 20px; color:blue; font-weight: bold;">Last Name</label>
    </div>
    <div class="col-md-6">
        <label style="font-size: 20px;"><?php echo $arrayResult[0]['UserLastName']?></label>
    </div>
</div>

<div class="row">
    <div class="col-md-2 f">
        <label style="font-size: 20px; color:blue; font-weight: bold;">Product</label>
    </div>
    <div class="col-md-6">
        <label style="font-size: 20px;"><?php echo "£".$ProductArray[0]['Cost'];?></label>
    </div>
</div>

<div class="row">
    <div class="col-5">
        <form method="post">
            <input type="hidden" name="uid" value="<?php echo $uID ?>"><br>
            <input type="submit" value="Delete" class="btn btn-danger" name="delete"><a href="viewUsers.php" style="font-weight: bold; padding-left: 30px;">Back</a>
        </form>
    </div>
</div>

<?php require("Footer.php");?>
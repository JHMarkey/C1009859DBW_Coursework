<?php
require("Header.php");

$db = new SQLite3('C:\xampp\Data\ABCBank.db');
$sql = "SELECT * FROM Users WHERE userID=:uid";
$stmt = $db->prepare($sql);
$stmt->bindParam(':uid', $_GET['uid'], SQLITE3_TEXT);
$result = $stmt->execute();
$arrayResult = [];
while ($row = $result->fetchArray(SQLITE3_NUM)) {
    $arrayResult[] = $row;
}

if (isset($_POST['submit'])) {
    $db = new SQLite3('C:\xampp\Data\ABCBank.db');
    $uID = $_GET['uid'];
    $sql = "UPDATE Users SET ProductID = :pID, UserFirstName = :fName, UserLastName = :lname, UserPostcode = :pCode, UserDOB = :dob, UserTele = :tele, UserStatus = :status WHERE UserID = :uid";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':uid', $uID, SQLITE3_TEXT);    
    $stmt->bindParam(':pID', $_POST['pID'], SQLITE3_INTEGER);
    $stmt->bindParam(':fname', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':pCode', $_POST['pCode'], SQLITE3_TEXT);
    $stmt->bindParam(':dob', $_POST['dob'], SQLITE3_TEXT);
    $stmt->bindParam(':tele', $_POST['tele'], SQLITE3_INTEGER);
    $stmt->bindParam(':status', $_POST['status'], SQLITE3_TEXT);

    $stmt->execute();

    header('Location: viewUsers.php');
}

?>

<div class="row">
    <div class="col-11">
        <form method="post">
            <div class="form-group col-md-4">
                <label class="control-label labelFont">ProductID</label>
                <input class="form-control" type="number" name="pID" min="0" max="6" value="<?php echo $arrayResult[0][1]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">FirstName</label>
                <input class="form-control" type="text" name="fName" value="<?php echo $arrayResult[0][2]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">LastName</label>
                <input class="form-control" type="text" name="lname" value="<?php echo $arrayResult[0][3]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">Password</label>
                <input class="form-control" type="text" name="pwd" value="<?php echo $arrayResult[0][4]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">Postcode</label>
                <input class="form-control" type="text" name="pCode" value="<?php echo $arrayResult[0][5]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">DOB</label>
                <input class="form-control" type="Date" name="dob" value="<?php echo $arrayResult[0][6]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">Telephone</label>
                <input class="form-control" type="Number" name="tele" value="<?php echo $arrayResult[0][7]; ?>">
            </div>

            <div class="form-group col-md-4">
                <label class="control-label labelFont">Status</label>
                <select name="status" class="form-control">
                    <option value="active" <?php echo ($arrayResult[0][8] == "New") ? "selected" : ""; ?>>New</option>
                    <option value="closed" <?php echo ($arrayResult[0][8] == "In-Process") ? "selected" : ""; ?>>In-Process</option>
                    <option value="blocked" <?php echo ($arrayResult[0][8] == "Complete") ? "selected" : ""; ?>>Complete</option>
                    <option value="closed" <?php echo ($arrayResult[0][8] == "On-Hold") ? "selected" : ""; ?>>On-Hold</option>
                    <option value="blocked" <?php echo ($arrayResult[0][8] == "Withdrawn") ? "selected" : ""; ?>>Withdrawn</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </div>

            <div class="form-group col-md-3"><a href="viewUsers.php">Back</a></div>
        </form>
    </div>
</div>
<?php require("Footer.php"); ?>
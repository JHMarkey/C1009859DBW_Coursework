<?php
function verifyUsers () {
    if (!isset($_POST['usrname']) or !isset($_POST['password'])) {
        return;  // <-- return null;  
    }

    $db = new SQLite3('C:\xampp\Data\ABCBank.db');
    $stmt = $db->prepare('SELECT UserID, UserLastName, UserPostcode, UserPassword FROM Users WHERE UserLastName=:lName AND UserPassword=:pwd AND UserID = :uID AND UserPostcode = :pCode');
    $stmt->bindParam(':lname', $_POST['lName'], SQLITE3_TEXT);
    $stmt->bindParam(':pwd', $_POST['pwd'], SQLITE3_TEXT);
    $stmt->bindParam(':uID', $_POST['uID'], SQLITE3_TEXT);
    $stmt->bindParam(':pCode', $_POST['pCode'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $rows_array = [];
    while ($row=$result->fetchArray())
    {
        $rows_array[]=$row;
    }
    return $rows_array;
}
?>
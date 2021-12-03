<?php

function getUsers (){
    session_start();
    $db = new SQLITE3('C:\xampp\Data\ABCBank.db');
    $sql = "SELECT * FROM Users WHERE UserID = :uID";
    $stmt = $db->prepare($sql);
    $stmt -> bindParam('uID', $_SESSION['uID'], SQLITE3_TEXT);

    $result = $stmt->execute();

    $arrayResult = [];
    while ($row = $result->fetchArray()){
        $arrayResult [] = $row;
    }
    return $arrayResult;
}

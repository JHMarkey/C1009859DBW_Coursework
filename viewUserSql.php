<?php

function getUsers (){
    $db = new SQLITE3('C:\xampp\Data\ABCBank.db');
    $sql = "SELECT * FROM Users";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $arrayResult = [];
    while ($row = $result->fetchArray()){
        $arrayResult [] = $row;
    }
    return $arrayResult;
}

<?php

function createUserID(){
    $fName = substr($_POST['fname'],0 ,2);
    $lName = substr($_POST['lname'],0 ,2);    
    $postcode = $_POST['postcode'];
    $postcode = substr($postcode, -2);
    $date = date("d");
    $ending = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

    session_start();
    $_SESSION["uID"] = strtoupper($lName.$fName.$postcode.$date.$ending);
}

function checkPassword(){
    $db = new SQLite3('C:/xampp/Data/ABCBank.db');
    $sql = 'SELECT UserPassword FROM Users WHERE(UserPassword = :pwd)';
    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':pwd', $_POST['pwd']);    
    return $stmt->execute();
    
}

function createUser($ProductID){    
    createUserID();    
    $defaultStatus = "New";
    $date = date("d/m/Y");

    $db = new SQLite3('C:/xampp/Data/ABCBank.db');
    $created = false;
    $sql = 'INSERT INTO Users(UserID, ProductID, UserFirstName, UserLastName, UserPassword, UserPostcode, UserDOB, UserTele, UserStatus, ApplicationDate) VALUES (:uID, :pID, :fName, :lName, :pwd, :postcode, :DOB, :tele, :uStatus, :appDate);';
    $stmt = $db->prepare($sql);
    
    $stmt->bindParam(':uID',$_SESSION["uID"], SQLITE3_TEXT);    
    $stmt->bindParam(':pID', $ProductID, SQLITE3_INTEGER); 
    $stmt->bindParam(':fName', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lName', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':pwd', $_POST['pwd'], SQLITE3_TEXT);
    $stmt->bindParam(':postcode', $_POST['postcode'], SQLITE3_TEXT);     
    $stmt->bindParam(':DOB', $_POST['DOB'], SQLITE3_TEXT);
    $stmt->bindParam(':tele', $_POST['tele'], SQLITE3_TEXT);
    $stmt->bindParam(':uStatus', $defaultStatus, SQLITE3_TEXT);
    $stmt->bindParam(':appDate', $date, SQLITE3_TEXT);

    $stmt->execute();
    
    if($stmt){
        $created = true;
    }

    return $created;
}

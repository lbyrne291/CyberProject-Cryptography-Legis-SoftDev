<?php

require_once "db.inc.php";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS CovidDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$sql = 'USE CovidDB;';
if (!$conn->query($sql) === TRUE) {
  die('Error using database: ' . $conn->error);
}

$sql = 'CREATE TABLE IF NOT EXISTS RegisteredAccounts (
Email varchar(256) NOT NULL,
Password varchar(256) NOT NULL,
userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
firstName varchar(256) NOT NULL,
surName varchar(256) NOT NULL,
address varchar(256) NOT NULL,
phoneNumber varchar (10)NOT NULL,
DateofBirth DATE NOT NULL) ;';
if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}

$conn->close();
?>
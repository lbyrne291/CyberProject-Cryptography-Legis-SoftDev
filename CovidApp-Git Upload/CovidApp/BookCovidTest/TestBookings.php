<!DOCTYPE html>
<html>

<?php

include "db.inc.php";

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS CovidDB";
if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error creating database: " . $conn->error;
}

$sql = 'USE CovidDB;';
if (!$conn->query($sql) === TRUE) {
  die('Error using database: ' . $conn->error);
}

//Creating Table and Fields
$sql = 'CREATE TABLE IF NOT EXISTS TestBookings (
TestID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
userID int(11),
iv varchar(32) NOT NULL,
DateAndTime varchar(20) NOT NULL);';

if (!$conn->query($sql) === TRUE) 
{
  die('Error creating table: ' . $conn->error);
}


?>


<style>

.navBar{margin-left:25%;}
.button1{font-size:25px; cursor: pointer; border:none; background-color:red; text-align:center;}

.navBar ul li { 
background-color: Yellow;
color: Black;
height :50px;
width:150px;
border:1px solid #000;
border-radius:26px;
text-align: center;
line-height: 50px;
float:left;
font-size:19px;
list-style:none;
}

.navBar ul li:hover{
background-color: #85C1E9;

}



.TheForm{ border:solid; width:800px; height:400px; background-color:yellow; margin:100px auto}
.CenterAllfields{margin-left:80px;}
body{background-color:grey; border-radius 5px;}

.Booking{margin:80px; font: 20px Arial, sans-serif; color:Blue; font-weight:bold;}


</style>

<head>

<div class = "LogOut">
<button class = "button1"><a href = "../Logout/Logout.php" > Logout </a></button>
</div>

<div class = "navBar">

<ul>

	<a href = "../Homepage/Covid-home.php" ><li> Home </li> </a>
	
		<a href = "../BookCovidTest/TestBookings.php" ><li> Book Covid Test</li></a>	
	
	<a href = "../ViewCovidResult/Results.php" ><li> View Result </li></a>
	
	<a href = "TestBookings.php" ><li> Book A Vaccine</li></a>	
	
</ul>

</div>

</head>


<body>

<br>
<br>

<div class ="TheForm"> 


<div class = "CenterAllfields">

<h2>Book A Covid-19 Test Now!</h2>


<form action="TestBookings.php" method = "POST" >

<div class ="TestDateTime">
<label for ="TestDateTime">Choose an available appointment:</label><br>
<input type ="Datetime-local"  id="TestDateTime"  name="TestDateTime" placeholder="" required="required">

<br>
<br>
<br>


<input type="submit" value="Confirm Booking" id ="submit" name = "submit">

</div>
</form> 

</div>


<div class = "Booking">

<?php
//Inserting the Users information to the table and escaping unescesary characters-->
if (isset($_POST['submit']))
{
	
	
	 $iv = random_bytes(16);
	 $iv_hex = bin2hex($iv);
	 

	 
	 $escaped_TestDateTime = $conn -> real_escape_string($_POST['TestDateTime']);
	 $encrypted_TestDateTime = openssl_encrypt($escaped_TestDateTime, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $TestDateTime_hex = bin2hex($encrypted_TestDateTime);


		
	 
	 $sql = "INSERT INTO TestBookings(iv,DateAndTime)
	 VALUES ('$iv_hex','$TestDateTime_hex')";
	 
if ($conn->query($sql) === TRUE) 
{

echo ('Your Test booking has been confirmed ');
echo ($_POST['TestDateTime']);

} 

else
{
 die('Error creating account ' . $conn->error);
}

}


?>


<div>

</body>
</html>
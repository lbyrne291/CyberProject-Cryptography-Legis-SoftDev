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
$sql = 'CREATE TABLE IF NOT EXISTS registeredaccounts (
userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
iv varchar(32) NOT NULL,
firstName varchar(256) NOT NULL,
surName varchar(256) NOT NULL,
address varchar(256) NOT NULL,
phoneNumber varchar (10)NOT NULL,
DateofBirth varchar (10) NOT NULL,
Email varchar(256) NOT NULL,
Password varchar(256) NOT NULL) ;';

if (!$conn->query($sql) === TRUE) 
{
  die('Error creating table: ' . $conn->error);
}



?>



<!--This is the HTML Form Below --> 

<!DOCTYPE html>

<style>

.TheForm{ border:solid; width:400px; height:640px; background-color:yellow; margin:0 auto}


.CenterAllfields{margin-left:80px;}

.Created{margin:20px; font: 20px Arial, sans-serif; color:Blue; font-weight:bold;}
</style>

<html>



<body>
<div class = "Created">
<?php
//Inserting the Users information to the table and escaping unescesary characters-->
if (isset($_POST['submit']))
{
	 $iv = random_bytes(16);
	 $iv_hex = bin2hex($iv);
	 
	 $escaped_firstName = $conn -> real_escape_string($_POST['firstName']);
	 $encrypted_firstName = openssl_encrypt($escaped_firstName, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $firstName_hex = bin2hex($encrypted_firstName);
	 
	 $escaped_surName = $conn -> real_escape_string($_POST['surName']);
	 $encrypted_surName = openssl_encrypt($escaped_surName, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $surName_hex = bin2hex($encrypted_surName);
	  
	 $escaped_address = $conn -> real_escape_string($_POST['address']);
	 $encrypted_address = openssl_encrypt($escaped_address, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $address_hex = bin2hex($encrypted_address);
	  
	 $escaped_phoneNumber = $conn -> real_escape_string($_POST['phoneNumber']);
	 $encrypted_phoneNumber = openssl_encrypt($escaped_phoneNumber, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $phoneNumber_hex = bin2hex($encrypted_phoneNumber);
	 
	 $escaped_DateofBirth = $conn -> real_escape_string($_POST['DateofBirth']);
	 $encrypted_DateofBirth = openssl_encrypt($escaped_DateofBirth, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $DateofBirth_hex = bin2hex($encrypted_DateofBirth);
	 
	 $escaped_Email = $conn -> real_escape_string($_POST['Email']);
	 $encrypted_Email = openssl_encrypt($escaped_Email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
	 $Email_hex = bin2hex($encrypted_Email);
	 
	 $escaped_Password = $conn -> real_escape_string($_POST['Password']);	 
	 $hashedPassword = password_hash($escaped_Password, PASSWORD_DEFAULT);
	
	
	
	 
	 
	 $sql = "INSERT INTO registeredaccounts(iv,firstName,surName,address,phoneNumber,DateofBirth,Email,Password) 
	 VALUES ('$iv_hex','$firstName_hex','$surName_hex','$address_hex','$phoneNumber_hex','$DateofBirth_hex','$Email_hex','$hashedPassword')";
	 
if ($conn->query($sql) === TRUE) 
{
echo '<p><i> Your account has been created, please login </i></p>';
} 
else
{
 die('Error creating account ' . $conn->error);
}

}

?>
</div>

<button type = "submit"><a href = "../Login Page/Login.php" > Login Now!! </a></button>


<div class ="TheForm"> 

<div class = "CenterAllfields">

<h2>Register Now!!</h2>


<form action="RegisteredAccount.php" method = "POST" >

<div class ="firstname">
<label for ="Firstname">First Name:</label><br>
<input type ="text"  id="firstName"  name="firstName" placeholder="First Name" required="required">

<br><br>

<div class ="Surname">
<label for ="Surname">Surname:</label><br>
<input type ="text" id="surName" name="surName" placeholder="Surname" required="required" >


<br><br>


<div class ="Address">
Address:<br>
<input type="text" id = "address" name= "address" placeholder="Home Address" required="required">
</div>

<br>


<div class="PhoneNumber">
Phone Number:<br>
<input type="tel" id = "phoneNumber" name ="phoneNumber" placeholder="Mobile Number" required="required">
</div>

<br>

<div class="DateofBirth">
<label> Date Of Birth:</label><br>
<input type ="Date" required="required" id = "DateofBirth" name = "DateofBirth" placeholder = "dd-mm-yyyy">
</div>

<br>

<div class="email">
E-mail Address:<br>
<input type="E-mail" id = "Email" name ="Email" placeholder="Email Address" required="required" >
</div>

<br>

<div class="password">
Password:<br>
<input type="password" id ="Password" name ="Password" required="required" >
</div>

<br>
<br>

<input type="checkbox" name="TermsAndCondtions" required > I agree to <u>Terms and Conditions</u>

<br>
<br>
<br>

<input type="submit" value="Submit" id ="submit" name = "submit">

</div>
</form> 

</div>


</body>
</html>

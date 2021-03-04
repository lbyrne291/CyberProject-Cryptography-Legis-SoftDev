<!DOCTYPE html>

<?php
session_start();

include "db.inc.php";

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
firstName varchar(256) NOT NULL,
surName varchar(256) NOT NULL,
address varchar(256) NOT NULL,
phoneNumber varchar (10)NOT NULL,
DateofBirth DATE NOT NULL,
Email varchar(256) NOT NULL,
Password varchar(256) NOT NULL) ;';

if (!$conn->query($sql) === TRUE) {
  die('Error creating table: ' . $conn->error);
}


?>

<style>

.TheForm{ border:solid; width:400px; height:280px; background-color:yellow; margin:100px auto}
.CenterAllfields{margin-left:80px;}
body{background-color:grey; border-radius 5px;}
.Logging{margin-left:540px; font: 20px Arial, sans-serif; color:yellow; font-weight:bold;}

</style>


<html>


<body>



<!--This is the HTML Form Below --> 
<div class ="TheForm"> 


<div class = "CenterAllfields">

<h2>Log In</h2>

<form action="Login.php" method = "POST" >

<div class="email">
E-mail Address:<br>
<input type="Email" id = "Email" name ="Email" placeholder="Email Address" required="required"autocomplete = 'off'  >
</div>

<br>

<div class="password">
Password:<br>
<input type="password" id ="Password" name ="Password" required="required" autocomplete = 'off' >
</div>

<br>
<br>
<br>


<input type="submit" value="Sign In" id ="submit" name = "login">


<input type="button" value="Click to Register" id ="register" name = "register" onclick = "window.location.href='../Register Page/RegisteredAccount.php'">

</div>

</form> 

</div>

<div class ="Logging">
<?php




if (isset($_POST['login']))
{

	$cipher = 'AES-128-CBC';
	$key = 'thebestsecretkey';

	$sql = "SELECT iv, Email, Password FROM registeredaccounts";
	$result = $conn->query($sql);

	$escaped_Email = $conn -> real_escape_string($_POST['Email']);
	
	
	$escaped_Password = $conn -> real_escape_string($_POST['Password']);	 
		

	
	if ($result->num_rows > 0) 
	{
		
		while($row = $result->fetch_assoc())
		{
			$iv = hex2bin($row['iv']);
			
			//Verifiying that the email is in the array produced from the database rows of email field
			$Email = hex2bin($row['Email']);
			$unencrypted_Email = openssl_decrypt($Email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
		
			//Verifiying that the password is in the array produced from the database rows of password field
			$PasswordsFromDB = ($row['Password']);	

				
		//determining if the email is in the database
		if($escaped_Email === $unencrypted_Email)
		{
			$_SESSION['Email'] = $unencrypted_Email;
			echo ""; 

		}
		else
		{
			echo "";
		}
		
		//Determining if the password is the database
		if(password_verify($escaped_Password,$PasswordsFromDB))
		{
			echo "";
			header ('Location: ../Homepage/Covid-home.php');
		}
		else
		{
			echo "Error logging in, Please try again.";
		}
		
		}
		
		
	}
	 
}

?>
<div>

</body>
</html>
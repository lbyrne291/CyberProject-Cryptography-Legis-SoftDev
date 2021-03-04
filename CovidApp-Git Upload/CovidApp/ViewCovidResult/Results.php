<html>
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



<?php

session_start();

include "db.inc.php";

echo "<h2>Covid-19 Results</h2>";
echo " <h3> Hi ".$_SESSION["Email"].', </h3>'; 
echo "";
echo "You're  covid-19 results will be available soon,  please stay safe and follow covid-19 guidelines. </h3>";

$cipher = 'AES-128-CBC';
$key = 'thebestsecretkey';

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS CovidDB";
if ($conn->query($sql) === TRUE) 
{
  echo "";
}
else 
{
  echo "Error creating database: " . $conn->error;
}

$sql = 'USE CovidDB;';

if (!$conn->query($sql) === TRUE) 
{
  die('Error using database: ' . $conn->error);
}


	$sql = "SELECT * FROM registeredaccounts";
	$result = $conn->query($sql);
	


	if ($result->num_rows > 0) 
	{
		
		while($row = mysqli_fetch_array($result))
		{
			$iv = hex2bin($row['iv']);
		
			
			//Verifiying that the email is in the array produced from the database rows of email field
			$Email = hex2bin($row['Email']);
			$unencrypted_Email = openssl_decrypt($Email, $cipher, $key, OPENSSL_RAW_DATA, $iv);
			

			$userID =($row['userID']);
			$unencrypted_userID = openssl_decrypt($userID, $cipher, $key, OPENSSL_RAW_DATA, $iv);
					

		}

			
			if (isset($_POST['submit']))
			{
				$sql = "DELETE Email FROM registeredaccounts WHERE Email = '$unencrypted_Email'";
						
				if($conn->query($sql) === TRUE) 
				{

				echo ('You have successfuly deleted your account, stay safe and follow HSE Covid guidelines ');
				echo "";
				echo ('Thankyou!');
				
				} 

				else
				{
				 die('Error Deleting account ' . $conn->error);
				}
			
			}
	
	
	}



			



?>



<br> <br> 
<br> <br>

<input type="submit" value="Delete your account + results" id ="submit" name = "submit">


</div>
</form> 

</div>
</html>

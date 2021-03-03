<!DOCTYPE html>
<html lang="en">

<title>Covid-Booking-Homepage</title>

<style>
.LogOut{margin-left:-400px; }
.button1{font-size:25px; cursor: pointer; border:none; background-color:red; text-align:center;}
.navBar{margin-left:-100px; padding-top: -80px;}

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
body {

background-color:grey;
h1{text-align:center;}
  font-family: Arial, Helvetica, sans-serif;
  margin-left:35%;
  margin-top:200px;
 } 
 
.para{ font: 20px Arial, sans-serif; color:Blue; font-weight:bold;}  


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
	
	<a href = "../BookCovidTest/TestBookings.php" ><li> Book A Vaccine</li></a>	
	
</ul>

</div>

</head>

<body>
<br>
<br>
<br>
<br>
<br>
<br>

<h1>Covid-19 Booking Application</h1>

<div class = para>
<p>We are all in this together!</p>
</div>
</body>
</html>
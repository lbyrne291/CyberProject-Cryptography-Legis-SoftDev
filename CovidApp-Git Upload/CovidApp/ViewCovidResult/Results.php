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

<h2>Covid-19 Results</h2>

<h3> You're results will be available soon,  please stay safe and follow covid-19 guidelines. </h3>

<br> <br>

<input type="submit" value="Delete your account + results" id ="submit" name = "submit">

<?php


?>


</div>
</form> 

</div>
</html>

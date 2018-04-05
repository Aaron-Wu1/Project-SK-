<!Doctype html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="Scripts.js" type="text/javascript"></script>
<?php 

session_start();
require_once "../config.php";
?>
<?php

/* $myPDO = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
     $sth = $myPDO ->prepare("SELECT username FROM accounts");
	$sth->execute();
	$alreadyRegisteredUsers = $sth->fetchAll();
     	foreach ($alreadyRegisteredUsers as $key =>$value) {
		
		//echo "{$key}";
		//echo "{$value['username']}";
     		
     		
	}*/
	if(isset($_SESSION["name"])){
$username = $_SESSION["name"];
     		}else{
     			$username = "";
     		}
      ?>
      <script>
	var username = "<?php echo $username; ?>";
	
	if(username != ""){
		$(document).ready(function(){
        $("#register").hide();
        $("#login").hide();
        $("#middletext").hide();
        document.getElementById('name').innerHTML = username;

});
	}else{
		$(document).ready(function(){
		$("#welcome").hide();
		$("#enter").hide();
		});
	}


</script>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
<style type="text/css">
body{
	background-color: black;
	font-family: 'Open Sans', sans-serif;
	color:white;
	text-align: center;
	 font-weight: 10;
}

	a{
		color: #D66853;
		text-decoration: none;
		text-decoration: underline;


	}
	li{
				padding-top:5px;
		margin-top:5px;
	}
	ul{
		list-style-type: none;
	}
	#heading{
		text-align: center;
	}
	#rc {
    border-radius: 25px;
    background: white;
    padding: 3px; 
    width: 150px;
   
}

#register{
	border: 2px solid red;
	 border-radius: 25px;
    padding: 5px; 
    width: 25%;
    margin: 0 auto;
}
#login{
	 border: 2px solid red;
	 border-radius: 25px;
	 
    padding: 5px; 
    width: 25%;
    margin: 0 auto;
}
	#rc2 {
		    color: white;
		border: 2px solid red;
    border-radius: 25px;
    background: #0e1717;
    padding: 2px; 
    width: 150px;
   
}
#welcome{
	font-size: 30px;
	margin-top:40px;
}
#enter{
	border-radius: 25px;
    background: #666666;
    padding: 5px; 
    width: 100px;
    height: 25px;   
    margin:0 auto;
}
#Send{
	border-radius: 25px;
    background: #666666;
    padding: 5px; 
    width: 100px;
    height: 25px;   
    color:white;
     margin:0 auto;
}
tr{
	border-radius: 25px;
    padding: 5px; 
    width: 100%;
    height: 25px;   
    color:white;
     margin:0 auto;
     text-align:left;
}
 input{
		border-radius: 25px;
		color:black;
    padding: 5px; 
	width: 100%;
	font-family: 'Open Sans', sans-serif;
	
}

#OnlineBox {
    color: blue;
    width: 70px;
    border: 2px solid black;
    position: absolute;
    top: 0px;
    right: 0px;
}
#footer{
	position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;
}
</style>
<title>
Aaron's Portfolio
</title>
</head>
<body>
	<div id = "heading"><img src="ProjectSK!Logo.png" /></div>
<div id="entirebody">
<div id="register">
<form action ="register.php" method ="post">
<p>Username: 
<input type ="text" name="username" maxlength="10" id = "rc"></p>
<?php 
if(isset($_GET['sucess'])){
if ($_GET['sucess'] == "false_space"){
	echo "<p class=\"warningText\">Please do not include spaces in your username</p>";
}else if($_GET['sucess'] == "false_length"){
	echo "<p class=\"warningText\">Please keep your username between 1 and 10 characters inclusive</p>";
}else if($_GET['sucess'] == "false_taken"){
	echo "<p class=\"warningText\">Sorry! Your username has already been taken</p>";
} 
}
?>
<p>Password: 
<input type ="password" name="password" id = "rc"></p>
<?php
if(isset($_GET['sucess'])){
if($_GET['sucess'] == "false_password_length"){
	echo "<p class=\"warningText\">Sorry! Your password must be more than 6 characters</p>";
}
}
?>
<input type ="submit" value="REGISTER" id = "rc2">
</form>
</div>
<!-- Log in -->
<div id="middletext">
<p>or... if you already have an account...</p>
</div>
<div id ="login">
<form action ="login.php" method ="post">
<p>Username: 
<input type ="text" name="login_username" maxlength="10" id = "rc"></p>
<?php
if(isset($_GET['success'])){
if($_GET['success'] == "false_user_does_not_exist"){
	echo "<p class=\"warningText\">Account does not exist. Please register a new account</p>";
}else if($_GET['success'] == "false_length"){
	echo "<p class=\"warningText\">Your username should not be over 10 characters</p>";
}else if($_GET['success'] == "false_length_short"){
	echo "<p class=\"warningText\">Please enter a username</p>";
}else if ($_GET['success'] == "false_space"){
	echo "<p class=\"warningText\">You should not have spaces in your username</p>";
}
}
?>
<p>Password: 
<input type ="password" name="login_password" id = "rc"></p>
<?php
if(isset($_GET['success'])){
if($_GET['success'] == "false_wrong_password"){
	echo "<p class=\"warningText\">Incorrect Password</p>";
}
}
?>
<input type ="submit" value="LOGIN" id = "rc2">
</form>
</div>
</div>
<p id="welcome">Welcome <span id="name"></span>.</p>
<!-- <p id="wrongpassword">You have entered the wrong password</p> -->
<div id="enter">Enter</div>
<table id="text">
  <tbody>
  </tbody>
</table>
<div id="OnlineBox">
	<table id="OnlineList">
  <tbody>
  </tbody>
</table>
</div>

<div id="footer">

<input id= "chatInput" type="text" name="userInput"  autofocus>
<div id="Send">Send</div>
<div id="SignOut">Sign Out</div>
</div>
   
</body>
</html>


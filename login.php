<?php
session_start();

require_once "../config.php";
if(!isset($_SESSION["name"])){
	$username = $_POST['login_username'];
try{
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
	$sth = $dbh ->prepare("SELECT id, username, password FROM accounts WHERE username =:user");
	$sth->bindValue(':user', $username);
	$sth->execute();
	$users =$sth->fetchAll();
	//var_dump($users);
	if(count($users) == 0){
		header ('Location: http://synergybynight.sytes.net/project SK!/index.php?wrongpassword=true');
		exit;
	}
	end($users);
	$key = key($users);
	for($i = 0; $i<= $key; $i++){
		$hashed = password_hash($_POST['login_password'], PASSWORD_DEFAULT);
		//echo "<p>{$hashed}</p>";
	if(password_verify($_POST['login_password'], $users[$i]['password'])){

	$_SESSION["name"] = $_POST['login_username'];
		header ('Location: http://synergybynight.sytes.net/project SK!/');
	echo $_SESSION["name"];

	}else{
		header ('Location: http://synergybynight.sytes.net/project SK!/index.php?wrongpassword=true');
	}

}
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

	if(empty($_POST)){
	header ('Location: http://synergybynight.sytes.net/project SK!/');
	exit;
}else{

}



}else{
		header ('Location: http://synergybynight.sytes.net/project SK!/index.php?loginsucessful=true');
	echo "LOGGED IN AS ";
	echo $_SESSION["name"];

}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="signout.php" method ="post">
	<input type="submit" value = "Sign Out">


</body>
</html>
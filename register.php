<?php
if(isset($_POST['username'])){
	if(isset($_POST['password'])){
		$user = $_POST['username'];
		echo $user;
		$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
		echo $pass;

/*$player->name = $user;
$player->password = $pass;*/
require_once "../config.php";
try{
	$validated = false;
	$usernameTaken = false;
	$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
	$sth = $dbh ->prepare("SELECT username FROM accounts");
	$sth->execute();
	$alreadyRegisteredUsers = $sth->fetchAll();
	if(!empty($alreadyRegisteredUsers)){
	//var_dump($_POST['password']);
		if(strpos($user, " ")){

			header ('Location: http://synergybynight.sytes.net/project SK!/index.php?sucess=false_space');
		}else{
		//echo $_POST['username'];
			foreach ($alreadyRegisteredUsers as $key =>$value) {

		//echo "{$key}";
		//echo "{$value['name']}";
				if($value['username'] ==$user){

			//echo "in if statement name = username";
			///$usernameTaken = true;
					header ('Location: http://synergybynight.sytes.net/project SK!/index.php?sucess=false_taken');
				}else if(strlen ($user) >10){

					header ('Location: http://synergybynight.sytes.net/project SK!/index.php?sucess=false_length');
				}else if(strlen($_POST['password']<=6)){

					header ('Location: http://synergybynight.sytes.net/project SK!/index.php?sucess=false_password_length');
				}else{


					$validated= true;
				}
			}
		}
	}else{
		$validated= true;
	}


	if($validated == true){
		$sth2 = $dbh ->prepare("INSERT INTO accounts VALUES (NULL, :name, :password, 'false')");
		$sth2->bindParam(':name', $user);
		$sth2->bindParam(':password', $pass);
		$sth2->execute();

		echo "sucessfully registered";
		$sth = $dbh ->prepare("SELECT username, password FROM accounts");
		$sth->bindValue(':name', $user);
		$sth->bindValue(':password', $pass);
		$sth->execute();
		$avatars =$sth->fetchAll();
		var_dump($avatars);
	header ('Location: http://synergybynight.sytes.net/project SK!/index.php?sucess=true');
		end($avatars);
		$key = key($avatars);
		for($i = 0; $i<= $key; $i++){
			echo $avatars[$i]['username'];
		}
	}
}
catch (PDOException $e) {
	echo "<p>Error: {$e->getMessage()}</p>";
}
//$myJSON = json_encode($player);

}else{
	echo "<p>Please enter a password</p>";

}
}else{
	
	echo "<p>Please enter a valid username</p>";
}


?>
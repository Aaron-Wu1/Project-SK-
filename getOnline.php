<?php
session_start();
require_once "../config.php";
try{
	$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
	$sth = $dbh ->prepare("SELECT username FROM accounts");
//$sth->bindValue(':user', $_SESSION['name']);
	$sth->execute();
	$ServerHost =$sth->fetchAll();
	//var_dump($ServerHost);
	$sth = $dbh ->prepare("SELECT online FROM accounts");
//$sth->bindValue(':user', $_SESSION['name']);
	$sth->execute();
	$ServerHost2 =$sth->fetchAll();
	//var_dump($ServerHost2);
	class users{
		public function currentUsers(){
			return $ServerHost;
		}
		public function online(){
			return $ServerHost2;
		}
	}
	$users = new users();
	$users->currentUsers = $ServerHost;
	$users->online = $ServerHost2;

	echo json_encode($users);

}
catch (PDOException $e) {
	echo "<p>Error: {$e->getMessage()}</p>";
}

?>
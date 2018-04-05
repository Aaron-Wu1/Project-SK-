<?php
session_start();
require_once "../config.php";
try{
	$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
	$sth = $dbh ->prepare("SELECT id, user, msg FROM serverhost");
//$sth->bindValue(':user', $_SESSION['name']);
	$sth->execute();
	$ServerHost =$sth->fetchAll();
	$sth = $dbh ->prepare("SELECT id FROM serverhost");
//$sth->bindValue(':user', $_SESSION['name']);
	$sth->execute();
	$ServerHost2 =$sth->fetchAll();
	$sth = $dbh ->prepare("SELECT msg FROM serverhost");
//$sth->bindValue(':user', $_SESSION['name']);
	$sth->execute();
	$ServerLog =$sth->fetchAll();
	$sth = $dbh ->prepare("SELECT username FROM accounts INNER JOIN serverhost ON accounts.id =serverhost.user;");
//$sth->bindValue(':user', $_SESSION['name']);
	$sth->execute();
	$ServerLog2 =$sth->fetchAll();

	$username = "";
	$msg = "";
	$stop = "false";
	$id = 0;
	foreach ($ServerHost as $key =>$value) {
		$username = $value['user'];
		$msg = $value['msg'];
		$stop = "false";
		$id =  $value['id'];
	}
	$sth = $dbh ->prepare("SELECT username FROM accounts WHERE id = :user");
	$sth->bindValue(':user', $username);
	$sth->execute();
	$name =$sth->fetch();

	$username = $name['username'];
	$ServerHost = json_encode( $ServerHost2, JSON_PRETTY_PRINT);
	//$ServerLog = json_encode( $ServerLog, JSON_PRETTY_PRINT);
	//$ServerLog2 = json_encode( $ServerLog2, JSON_PRETTY_PRINT);

	class message{
		public function getMessage(){
			return $msg;
		}
		public function getStop(){
			return $stop;
		}
		public function getUsername(){
			return $stop;
		}
		public function getID(){
			return $id;
		}
		public function getServerLog(){
			return $ServerHost2;
		}
		public function getServerLogMsg(){
			return $ServerLog;
		}
		public function getServerLogUser(){
			return $ServerLog2;
		}
	}
	$message = new message();
	$message->getMessage = $msg;
	$message->getStop = $stop;
	$message->getUsername = $username;
	$message->getID = $id;
	$message->getServerLog = $ServerHost2;
	$message->getServerLogMsg = $ServerLog;
	$message->getServerLogUser = $ServerLog2;
	echo json_encode($message);

}
catch (PDOException $e) {
	echo "<p>Error: {$e->getMessage()}</p>";
}

?>
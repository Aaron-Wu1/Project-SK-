<?php
session_start();
require_once "../config.php";
$send = $_SESSION['name'] . "send";
//echo $send;
$msg = "";
try{
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh ->prepare("SELECT id FROM accounts Where username = :user");
$sth->bindValue(':user', $_SESSION['name']);
$sth->execute();
$UserId =$sth->fetch();
$id =$UserId['id'];
$sth = $dbh ->prepare("UPDATE accounts SET online = 'true' WHERE id = :user");
$sth->bindValue(':user', $id);
//$sth->bindValue(':msg', $msg);
//$sth->bindValue(':sendable', "'" . $_SESSION['name'] . "send" . "'" );
$sth->execute();

$ServerHost =$sth->fetchAll();
var_dump($ServerHost);
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

?>
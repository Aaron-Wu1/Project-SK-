<?php
session_start();
require_once "../config.php";
try{
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh ->prepare("ALTER TABLE serverhost DROP COLUMN `:person`");
$sth->bindValue(':person', $_SESSION['name']);
$sth->execute();
$sth = $dbh ->prepare("ALTER TABLE serverhost DROP COLUMN `:send`");
$sth->bindValue(':send', $_SESSION['name'] . "send");
$sth->execute();
$sth = $dbh ->prepare("SELECT ServerHost, username, message FROM accounts");
//$sth->bindValue(':user', $_SESSION['name']);
$sth->execute();
$ServerHost =$sth->fetchAll();
var_dump($ServerHost);
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

?>
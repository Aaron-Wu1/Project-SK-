<?php
session_start();
require_once "../config.php";
$msg = $_GET['msg'];
$user = $_SESSION['name'];
echo $msg . $user;
echo "`'" . $_SESSION['name'] . "send" . "'`" . "`'" . $_SESSION['name'] . "'`";
try{
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh ->prepare("SELECT id FROM accounts WHERE username = :user1");
$sth->bindValue(':user1', $_SESSION['name']);
$sth->execute();
$UserId =$sth->fetch();
$id =$UserId['id'];
echo $id;
$sth = $dbh ->prepare("INSERT INTO serverhost VALUES (NULL, :user, :msg)");
$sth->bindValue(':user', $id);
$sth->bindValue(':msg', $msg);
//$sth->bindValue(':sendable', "'" . $_SESSION['name'] . "send" . "'" );
$sth->execute();

}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}

?>
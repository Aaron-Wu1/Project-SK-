
<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();
require_once "../config.php";
$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$sth = $dbh ->prepare("SELECT id FROM accounts WHERE username = :user1");
$sth->bindValue(':user1', $_SESSION['name']);
$sth->execute();
$UserId =$sth->fetch();
$id =$UserId['id'];
echo $id;
$sth = $dbh ->prepare("DELETE FROM serverhost WHERE user = :user");
$sth->bindValue(':user', $id);
//$sth->bindValue(':sendable', "'" . $_SESSION['name'] . "send" . "'" );
$sth->execute();
// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}



// Finally, destroy the session.
session_destroy();
?>

<?php
$data = $request->getParsedBody();

$username = $data['uname'];
$password = $data['psw'];

$db = new PDO(
    'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

//:username is a parameter which can be bound
$fetchUserStatement = $db->prepare("SELECT * FROM User WHERE UserName = :username");
$fetchUserStatement->bindParam(":username", $username); //replace :username with the contents of username variable avoiding SQL injection
$fetchUserStatement->execute();
$row = $fetchUserStatement->fetch();

$storedPasswordHash = $row['UserPassword'];

if(password_verify($password, $storedPasswordHash)) { //built in PHP function to compare password to password_hashed version
    $_SESSION["username"] = $row["UserName"];
    $_SESSION["location"] = $row["UserLocation"];
    $_SESSION["id"] = $row["UserID"];
    $_SESSION["is_host"] = false;
    header("Location: /userprofile/{$username}");
    exit();
} else {
    $_SESSION["ERROR"] = "incorrect_password";
    header("Location: /login");
    exit();
}
?>

<?php
$data = $request->getParsedBody();

$username = $data['uname'];
$password = $data['psw'];

$db = new PDO(
    'mysql:host=localhost;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

//:username is a parameter which can be bound
$fetchUserStatement = $db->prepare("SELECT * FROM Host WHERE HostUserName = :hostusername");
$fetchUserStatement->bindParam(":hostusername", $username); //replace :username with the contents of username variable avoiding SQL injection
$fetchUserStatement->execute();
$row = $fetchUserStatement->fetch();

$storedPasswordHash = $row['HostUserPassword'];

if(password_verify($password, $storedPasswordHash)) { //built in PHP function to compare password to password_hashed version
    $_SESSION["hostusername"] = $username;
    header("Location: /hostuserprofile/{$username}");
    exit();
} else {
    $_SESSION["ERROR"] = "incorrect_password";
    header("Location: /hostlogin");
    exit();
}
?>
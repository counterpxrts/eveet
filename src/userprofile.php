<?php
$db = new PDO(
    'mysql:host=localhost;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

$username = $args['username'];

//:username is a parameter which can be bound
$fetchUserStatement = $db->prepare("SELECT * FROM User WHERE UserName = :username");
$fetchUserStatement->bindParam(":username", $username); //replace :username with the contects of username variable avoiding SQL injection
$fetchUserStatement->execute();
$row = $fetchUserStatement->fetch();

$fullname = $row["UserFullName"];
$location = $row["UserLocation"];
$description = $row["UserDescription"];
?>
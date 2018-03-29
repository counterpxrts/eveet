<?php
$data = $request->getParsedBody();

$description = $data['description'];
$username = $args['username']; //get username from URL

$db = new PDO(
    'mysql:host=localhost;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

//set description in database
//:username is a parameter which can be bound, ditto for :description
$fetchUserStatement = $db->prepare("UPDATE User SET UserDescription = :description WHERE UserName = :username");
$fetchUserStatement->bindParam(":username", $username); //replace :username with the contects of username variable avoiding SQL injection
$fetchUserStatement->bindParam(":description", $description);
$fetchUserStatement->execute();

header("Location: /userprofile/{$username}"); //redirect to user profile
exit();
?>
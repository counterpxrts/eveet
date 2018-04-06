<?php
$db = new PDO(
    'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);

$username = $args['username'];

//:username is a parameter which can be bound
if($_SESSION["is_host"]) {
    $fetchUserStatement = $db->prepare("SELECT * FROM Host WHERE HostUserName = :username");
} else {
    $fetchUserStatement = $db->prepare("SELECT * FROM User WHERE UserName = :username");
}
$fetchUserStatement->bindParam(":username", $username); //replace :username with the contects of username variable avoiding SQL injection
$fetchUserStatement->execute();
$row = $fetchUserStatement->fetch();

// LEFT JOIN Event on Interested By UserID
$getInterested = $db->prepare("SELECT * FROM Event, Interested WHERE Interested.UserID = ? AND Interested.EventID = Event.EventID ORDER BY Interested.InterestedID DESC");
$getAttending = $db->prepare("SELECT * FROM Event, Attending WHERE Attending.UserID = ? AND Attending.EventID = Event.EventID ORDER BY Attending.AttendingID DESC");

$getInterested->execute(array( $row["UserID"] ));
$getAttending->execute(array( $row["UserID"] ));

$interested = $getInterested->fetchAll();
$attending = $getAttending->fetchAll();

$fullname = $row["UserFullName"];
$location = $row["UserLocation"];
$description = $row["UserDescription"];

$image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $row["UserEmail"] ) ) ) . "?s=200";

// make safe to display - get rid of unwanted XSS
if($row["UserImage"]) $image = trim($row["UserImage"], '!"#$%&\'()*+,-./@:;<=>[\\]^_`{|}~');

?>

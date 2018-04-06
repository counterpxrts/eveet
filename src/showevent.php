<?php
  $db = new PDO(
      'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
      'eveet',
      'KGqWXTJqHlCGigw6',
      array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );

  $fetchEvent = $db->prepare("SELECT * FROM Event WHERE EventID = :id");
  $fetchEvent->bindParam(":id", $args["id"]);
  $fetchEvent->execute();
  $event = $fetchEvent->fetch();

  $fetchHost = $db->prepare("SELECT * FROM Host WHERE HostUserID = :id");
  $fetchHost->bindParam(":id", $event["HostID"]);
  $fetchHost->execute();
  $host = $fetchHost->fetch();

  $fetchComments = $db->prepare("SELECT * FROM EventDiscussion WHERE EventID = :id");
  $fetchComments->bindParam(":id", $args["id"]);
  $fetchComments->execute();
  $comments = $fetchComments->fetchAll();

  $fetchInterested = $db->prepare("SELECT * FROM Interested WHERE EventID = ? AND UserID = ?");
  $fetchInterested->execute(array(
    $args["id"],
    $_SESSION["id"]
  ));
  $interested = !!$fetchInterested->fetch();

  $fetchAttending= $db->prepare("SELECT * FROM Attending WHERE EventID = ? AND UserID = ?");
  $fetchAttending->execute(array(
    $args["id"],
    $_SESSION["id"]
  ));
  $attending = !!$fetchAttending->fetch();

  $data = array(
    'id' => $args["id"],
    'title' => $event["EventName"],
    'location' => $event["EventLocation"],
    'date' => $event["EventDate"],
    'time' => $event["EventTime"],
    'host' => $host["HostUserName"],
    'comments' => $comments,
    'interested' => $interested,
    'attending' => $attending
  );
?>

<?php
  // IF NOT A HOST, DIE IMMEDIATELY
  if(!$_SESSION["is_host"]) die("You are not a host!");

  $data = $request->getParsedBody();

  // IF NOT ALL REQUIRED FIELDS ARE SET, DIE IMMEDIATELY
  if(!isset($data["EventName"], $data["EventLocation"], $data["EventDate"], $data["EventTime"])) die("Required fields missing!");

  $db = new PDO(
    'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );

  $createEvent = $db->prepare("INSERT INTO Event (HostID, EventName, EventLocation, EventDate, EventTime) VALUES (:host, :name, :location, :date, :time)");
  // bind posted data into create
  $createEvent->bindParam(":host", $_SESSION["id"]);
  $createEvent->bindParam(":name", $data["EventName"]);
  $createEvent->bindParam(":location", $data["EventLocation"]);
  $createEvent->bindParam(":date", $data["EventDate"]);
  $createEvent->bindParam(":time", $data["EventTime"]);
  $createEvent->execute();

  $id = $db->lastInsertId();

  header("Location: /event/{$id}"); //redirect to user profile
  exit();
?>

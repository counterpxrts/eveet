<?php
  $db = new PDO(
    'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  if($invert) {
    $deleteEntry = $db->prepare("DELETE FROM ".$type." WHERE UserID = ? AND EventID = ?");
    $deleteEntry->execute(array(
      $_SESSION["id"],
      $args["id"]
    ));
  }else{
    $createEntry = $db->prepare("INSERT INTO ".$type." (UserID, EventID) VALUES (?, ?)");
    if($type == "Attending") {
      $removeInterest = $db->prepare("DELETE FROM Interested WHERE UserID = ? AND EventID = ?");
      $removeInterest->execute(array(
        $_SESSION["id"],
        $args["id"]
      ));
    }
    $createEntry->execute(array(
      $_SESSION["id"],
      $args["id"]
    ));
  }
  header("Location: /event/".$args["id"]);
  exit();

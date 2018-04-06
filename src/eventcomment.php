<?php
  $data = $request->getParsedBody();

  if(!isset($data["text"]) || strlen($data["text"]) < 1) die("Comment too short!");

  $db = new PDO(
    'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );

  $createComment = $db->prepare("INSERT INTO EventDiscussion (CommentText, CommentUserID, CommentByHost, EventID) VALUES (?, ?, ?, ?)");
  $createComment->execute(array(
    $data["text"],
    $_SESSION["id"],
    $_SESSION["is_host"],
    $args["id"]
  ));

  header('Location: /event/'.$args["id"]);
  exit();

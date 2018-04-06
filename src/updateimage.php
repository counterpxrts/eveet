<?php
  $data = $request->getParsedBody();

  $image = $data["image"];
  if($image) $image = trim($image);
  if(!isset($image) || strlen($image) < 1) die(json_encode(array(
    'error' => "invalid url"
  )));
  $db = new PDO(
    'mysql:host=127.0.0.1;dbname=eveet;charset=utf8mb4',
    'eveet',
    'KGqWXTJqHlCGigw6',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $update = $db->prepare("UPDATE User SET UserImage = ? WHERE UserID = ?");
  $update->execute(array(
    $image,
    $_SESSION["id"]
  ));
  echo json_encode($data);

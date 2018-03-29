<?php
$data = $request->getParsedBody();

if($data["psw"] != $data["psw-repeat"]) {
    $_SESSION["ERROR"] = "not_eqn";
    header("Location: /signup");
    exit();
} else {
    //check for password is done, go ahead
    $email = $data["email"];
    $username = $data["username"];
    $psw = password_hash($data["psw"], PASSWORD_DEFAULT); //built in PHP function to salt and hash password
    $dob = $data["userdob"];
    $location = $data["location"];
    $fullname = $data["fullname"];

    $db = new PDO('mysql:host=localhost;dbname=eveet;charset=utf8mb4', 'eveet', 'KGqWXTJqHlCGigw6', array(PDO::ATTR_EMULATE_PREPARES => false, 
                                                                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
    try {
        $stmt = $db->query("SELECT * FROM User WHERE UserEmail = '$email'"); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row["UserID"] == "") {
            //query to add inserted information into DB
            $statement = $db->prepare("INSERT INTO User(UserFullName, UserLocation, UserDOB, UserEmail, UserPassword, UserName) 
            VALUES('$fullname','$location','$dob','$email','$psw','$username')");

            $statement->execute() ;
            header("Location: /login");
            exit();
        } else {
            $_SESSION["ERROR"] = "user_exists";
            header("Location: /signup");
            exit();
        }
    } catch(PDOException $ex) {
        $_SESSION["ERROR"] = "db_error";
        print_r($ex);
       // header("Location: /signup");
        //exit()
    }



    //header("Location: /signup");
    exit();
}


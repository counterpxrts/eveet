<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/login', function (Request $request, Response $response, array $args) {
    // Render index view
    return $this->renderer->render($response, 'login.phtml', $args);
});

$app->get('/signup', function (Request $request, Response $response, array $args) {
    // Render index view
    return $this->renderer->render($response, 'signup.phtml', $args);
});

$app->get('/hostlogin', function (Request $request, Response $response, array $args) {
    // Render index view
    return $this->renderer->render($response, 'hostlogin.phtml', $args);
});

/**
 * run signup code when form is posted to signup route  
 */
$app->post('/action/signup', function ($request, $response) {
   include("signup.php");
});

/**
 * run login code when form is posted to login route
 */
$app->post('/action/login', function ($request, $response) {
    include("login.php");
 });

/**
 * :username is a path variable that gets put into $args e.g. $args['username']
 */
$app->get('/userprofile/{username}', function (Request $request, Response $response, array $args) {
    include("userprofile.php");

    $isOwner = $username == $_SESSION["username"]; //is profile for currently logged in user
    //pass $fullname from userprofile.php to the template
    return $this->renderer->render($response, 'userprofile.phtml', array('fullname' => $fullname, 'location' => $location, 'username' => $username, 'description' => $description,  'isOwner' => $isOwner));
});

/**
 * :username is a path variable that gets put into $args e.g. $args['username']
 */
$app->get('/userprofile/{username}/edit', function (Request $request, Response $response, array $args) {
    include("userprofile.php");

    
    if($username == $_SESSION["username"]) {  //is profile for currently logged in user
        //pass $fullname from userprofile.php to the template
        return $this->renderer->render($response, 'userprofile-editable.phtml', array('fullname' => $fullname, 'location' => $location, 'username' => $username, 'description' => $description));
    }
});

/**
 * :username is a path variable that gets put into $args e.g. $args['username']
 */
$app->post('/action/edituser/{username}', function (Request $request, Response $response, array $args) {
    if($args["username"] == $_SESSION["username"]) {  //is profile for currently logged in user
        include("edituser.php");
    }
});

$app->get("/logout", function () {
    session_destroy();
    header("Location: /");
    exit();
});

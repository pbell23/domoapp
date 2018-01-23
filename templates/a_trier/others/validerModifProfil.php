<?php
require('../../../utilities/autoload.php');

$kernel = new \kernel\Kernel();
$dataBase = $kernel->get("database.object");
$databaseService = $kernel->get("database.service");
$userService = $kernel->get("user.service");
$sessionService = $kernel->get("session.manager");
$userService->setServiceConnect($databaseService);
$userService->setDataBaseObject($dataBase);
$databaseService->connect($dataBase);


$last_name = $_POST["last_name"];
$first_name = $_POST["first_name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$userTab = $userService->getUserBy('id',1);
if(sizeOf($userTab)==1){
    $user = $userTab[0];
    $user->setFirstName($first_name);
    $user->setLastName($last_name);
    $user->setPhone($phone);
    $user->setEmail($email);
}

$userService->updateUser($user);

header('Location: modificationClient.php');





<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== "FetchAjaxRequest")
    exit();

require_once("./Repository.php");
require_once("../constants/constants.php");
require_once("./User.php");
require_once("./helpers.php");

$repository = new Repository(PATH);
$users = $repository->read();

$name = $_POST["name"];
$email = $_POST["email"];
$login = $_POST["login"];
$password = $_POST["password"];
$errors = [];
$salt = generateSalt();

function userIs($errors)
{
    echo json_encode($errors);
    exit();
}

foreach ($users as $user) {
    if ($user->getLogin() === $login) {
        $errors["type"] = "login";
        $errors["message"] = "Такой логин уже существует";
        userIs($errors);
    } elseif ($user->getEmail() === $email) {
        $errors["type"] = "email";
        $errors["message"] = "Такой email уже существует";
        userIs($errors);
    }
}

function addNewUser($repository, $login, $password, $email, $name, $salt)
{
    $user = new User($login, $salt . md5($password), $email, $name, $salt);
    $repository->create($user);
    $errors["type"] = "success";
    $errors["message"] = "";
    $_SESSION["isAuth"] = true;
    $_SESSION["name"] = $user->getName();
    echo json_encode($errors);
}

addNewUser($repository, $login, $password, $email, $name, $salt);
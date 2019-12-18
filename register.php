<?php
namespace RegisterTest;

if(isset($_POST['register-user'])) {
    $username = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $firstName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["userEmail"], FILTER_SANITIZE_STRING);
    //image
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = "img/" . $fileName;

    require_once("User.php");
    $user = new User();
    $errorMessage = $user->validateUser();

    if (empty($errorMessage)) {
        $usersCount = $user->ifUserExists($username, $email);

        if ($usersCount == 0) {
            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
            $insertId = $user->insertUser($username, $firstName, $password, $email, $fileName);

            if (! empty($insertId)) {
                header("Location: layout/user_profile.php?id=".$insertId);
            }
        } else {
            $errorMessage[] = "User already exists.";
        }
    }
}

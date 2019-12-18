<?php
namespace RegisterTest;

use \RegisterTest\DataSource;

class User
{
    private $ds;

    function __construct()
    {
        require_once("DataSource.php");
        $this->ds = new DataSource();
    }

    function validateUser()
    {
        $valid = true;
        $errorMessage = array();
        foreach ($_POST as $key => $value) {
            if (empty($_POST[$key])) {
                $valid = false;
            }
        }
        
        if($valid == true) {
            // Password Matching Validation
            if ($_POST['password'] !== $_POST['confirm_password']) {
                $errorMessage[] = 'Passwords should be same.';
                $valid = false;
            }
            
            // Email Validation
            if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
                $errorMessage[] = "Invalid email address.";
                $valid = false;
            }

            // Username validation
            if(!preg_match("/^[a-zA-Z0-9]*$/", $_POST["userName"])){
                $errorMessage[] = "Username is not valid.";
                $valid = false;
            }

            // First name validation
            if(!preg_match("/^[a-zA-Z ]*$/", $_POST["firstName"])){
                $errorMessage[] = "Fist name must contain only letters.";
                $valid = false;
            }

            // Image Validation
            $targetDir = "img/";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if (! empty($_FILES["file"]["name"])) {
                $allowTypes = array('jpg','png','gif');
                if(! in_array($fileType, $allowTypes)){
                    $errorMessage[] = "Image must be of extensions: .jpg, .png, .gif";
                    $valid = false;
                }
            }
        }
        else {
            $errorMessage[] = "All fields are required.";
        }
        
        if ($valid == false) {
            return $errorMessage;
        }
        return;
    }

    function ifUserExists($username, $email)
    {
        $query = "SELECT * FROM users WHERE user_name = ? OR email = ?";
        $paramType = "ss";
        $paramArray = array($username, $email);
        $usersCount = $this->ds->numRows($query, $paramType, $paramArray);
        
        return $usersCount;
    }

    function insertUser($username, $firstName, $password, $email, $image)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (user_name, first_name, password, email, image) VALUES (?, ?, ?, ?, ?)";
        $paramType = "sssss";
        $paramArray = array(
            $username,
            $firstName,
            $passwordHash,
            $email,
            $image
        );
        $insertId = $this->ds->insert($query, $paramType, $paramArray);
        return $insertId;
    }

    function getUser($id)
    {
        $query = "SELECT user_name, first_name, email, image FROM users WHERE id = ?";
        $paramType = "i";
        $paramArray = array(
            $id
        );
        $user = $this->ds->select($query, $paramType, $paramArray);
        return $user;
    }
}
<?php
session_start();
include "database.php";
$action = $_GET['action'];

switch($action)
{
    case "add":
        addUser();
    break;
    case "login":
        login();
    break;
    case "logout":
        logout();
    break;
    case "delete":
        deleteUser();
    break;
    case "edit":
        editUser();
    break;
    default:
        header("Location: index.html");
    break;
}

function editUser()
{
    $con=connect();
    $uid=$_GET['uid'];
    $nm=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $sql = "UPDATE `users` SET name='$nm', email='$email', pass='$pass' WHERE uid='$uid'";
    mysqli_query($con, $sql);
    header("Location: home.php");
}

function deleteUser()
{
    $con = connect();
    $uid = $_GET['uid'];
    $sql = "DELETE FROM `users` WHERE uid='$uid'";
    mysqli_query($con, $sql);
    header("Location: home.php");
}

function logout()
{
    unset($_SESSION);
    header("Location: index.html");
}

function addUser()
{
    $con = connect();
    $nm = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $sql = "INSERT INTO `users`(name,email,pass) values('$nm', '$email', '$pass')";
    mysqli_query($con, $sql);
    header("Location: add.php");
}

function login()
{
    $con = connect();
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `admin` WHERE email='$email' AND pass='$pass'";
    echo $sql;
    $result = mysqli_query($con, $sql);
    echo mysqli_num_rows($result);
    if(mysqli_num_rows($result)  == 1)
    {
        $data = mysqli_fetch_assoc($result);
        extract($data);
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        header("Location: home.php");
    }
    else
    {
        header("Location: index.html");
    }
}

?>

<?php


function connect()
{   
    $username="root";
    $pass="";
    $host="localhost";
    $db="faac";
    return mysqli_connect($host, $username, $pass, $db);
}

?>
<?php
session_start();
if(!isset($_SESSION['email']))
{
  header("Location: index.html");
}
include "database.php";
$con = connect();
$fid = $_GET['fid'];
$sql = "DELETE FROM feedback WHERE fid='".$fid."'";
$result = mysqli_query($con,$sql);
header("Location: list.php");
?>
<?php
$user = file_get_contents("user.txt");

$connect = mysqli_connect("remotemysql.com:3306", "A94GJGzFph", "zMgmuGyp7J", "A94GJGzFph");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE $user SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>
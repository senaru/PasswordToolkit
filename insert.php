<?php
$connect = mysqli_connect("remotemysql.com:3306", "A94GJGzFph", "zMgmuGyp7J", "A94GJGzFph");
if(isset($_POST["first_name"], $_POST["last_name"], $_POST["password"]))
{
 $first_name = mysqli_real_escape_string($connect, $_POST["first_name"]);
 $last_name = mysqli_real_escape_string($connect, $_POST["last_name"]);
 $password = mysqli_real_escape_string($connect, $_POST["password"]);
 $query = "INSERT INTO user(first_name, last_name, password) VALUES('$first_name','$last_name', '$password')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
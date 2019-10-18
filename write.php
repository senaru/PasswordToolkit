<?php
$userAnswer = $_POST['auth']; 
$file = 'user.txt';

file_put_contents($file, $userAnswer);
// Create connection
$connect = mysqli_connect("remotemysql.com:3306", "A94GJGzFph", "zMgmuGyp7J", "A94GJGzFph");

if(isset($_POST['auth']))
{
 $query = "CREATE TABLE IF NOT EXISTS `$userAnswer` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;";
    
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}

echo json_encode($userAnswer);    
?>
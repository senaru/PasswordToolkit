<?php
use google\appengine\api\cloud_storage\CloudStorageTools;

$userAnswer = $_POST['name']; 
//$file = 'user.txt';

//file_put_contents($file, $userAnswer);

$current = fopen('gs://firstphp/current_user.txt','w');
//$current = fopen('user.txt','w');
		fwrite($current,$userAnswer);
		fclose($current);

echo json_encode($userAnswer);    
?>
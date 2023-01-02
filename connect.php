<?php 
 $localhost = 'localhost';
 $username = 'root';
 $password = 'mysql';
 $db = 'hrm';

$conn = mysqli_connect($localhost, $username, $password, $db);
if(!$conn){
   die(mysqli_connect_error($conn)); 
}else{
    
}

?>
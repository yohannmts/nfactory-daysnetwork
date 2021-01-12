<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=network_days', "root", "",);

$name = $_POST['usernames'];
$password = $_POST['passwords'];
 
 $_SESSION['firstname'] = $name;
$sql = "SELECT * FROM nd_users where name='$name' AND password='$password'";

$result = mysqli_query($pdo, $sql);

if (mysqli_num_rows($result) > 0) {
 echo "yes";
} else {
    echo 'no'; 
}

if(ISSET($_POST['action'])){
	 
		unset($_SESSION["username"]);
 	
}


mysqli_close($conn);
?>

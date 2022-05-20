<?php

$dbuser = "victor";
$dbpassword = "121212";
$dbpasswordEncoded = password_hash($dbpassword, PASSWORD_DEFAULT);

$user = $_POST['user'];
$password = $_POST['password'];

if($dbuser == $user && password_verify($password, $dbpasswordEncoded)){
  header("Location: ./panel/static/panel.php");
} else {
  header("Location: index.php?error=1");
}

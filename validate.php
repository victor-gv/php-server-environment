<?php

$dbuser = "victor";
$dbpassword = "121212";
$dbpasswordEncoded = password_hash($dbpassword, PASSWORD_DEFAULT);

$user = $_POST['user'];
$password = $_POST['password'];

if($dbuser == $user && password_verify($password, $dbpasswordEncoded)){
  echo "Welcome, $user";
} else {
  echo "Wrong username or password";
}

<?php 

session_start();
$usernameOrEmail = $_SESSION['UsernameOrEmail'];
echo $usernameOrEmail;


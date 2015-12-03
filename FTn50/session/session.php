<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");

// Selecting Database
$db = mysql_select_db("ftusers", $connection);

// Starting Session
session_start();

// Storing Session
$user_check=$_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username from ftusers where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];

if(!isset($login_session)){

	// Closing Connection
	mysql_close($connection); 
	header('Location: ../index.html'); // Redirecting To Home Page
}
?>

<?php
session_start(); // Starting Session
echo "your session started.";
$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
		try {
			if (empty($_POST['username']) || empty($_POST['password'])) {
				throw new Exception("Username or Password is invalid");
			}
			else {
				// Define $username and $password
				$username=$_POST['username'];
				$password=$_POST['password'];
				echo $username;echo "\n";
				echo $password;
				// Establishing Connection with Server by passing server_name, user_id and password as a parameter
				$connection = mysql_connect("localhost", "root", "");
				if (!$connection) {
					die('\nNot connected with localhost,root ' . mysql_error());
				}
				// To protect MySQL injection for Security purpose
				$username = stripslashes($username);
				$password = stripslashes($password);
				$username = mysql_real_escape_string($username);
				$password = mysql_real_escape_string($password);
				// Selecting Database
				$db = mysql_select_db("ftusers", $connection);
				if (!$db) {
    					die (' ftusers database is not selected ' . mysql_error());
				}
				// SQL query to fetch information of registerd users and finds user match.
				$query = mysql_query("select * from ftusers where password='$password' AND username='$username'", $connection);
				$rows = mysql_num_rows($query);
				if ($rows == 1) {
					$_SESSION['login_user']=$username; // INITIALIZING SESSION
					header("location: profile.php"); // Redirecting To Other Page
				}
	 			else {
					 $error = "Username or Password is invalid";
					 throw new Exception("email or Password is invalid");
				}
				mysql_close($connection); // Closing Connection
			}
		}
		catch (Exception $e) {
	        	$_SESSION['login_error'] = $e->getMessage();
        		header("Location: ../index.html");
    		}
}
?>
<?php

include('../reqs/functions.php');
$max_size = 1024*20000000000; // 20000Mb
$restricted_types= array('bat','vbs');
$dir = '../files/';
$count = 0;

$file_id = $_POST['file_id'];
mkdir($dir.$file_id.'/');

if ($_SERVER['REQUEST_METHOD'] == 'POST' )//and isset($_FILES['files']))

{	
	// loop all files
	foreach ( $_FILES['files']['name'] as $i => $name )
	{
		$file_ext=pathinfo($name,PATHINFO_EXTENSION);
		
		// if file not uploaded then skip it
		if ( !is_uploaded_file($_FILES['files']['tmp_name'][$i]) )
			continue;

		// skip large files
		if ( $_FILES['files']['size'][$i] >= $max_size )
			continue;

		// skip unprotected files
		if( in_array($file_ext,$restricted_types) )
		{continue;}

		// now we can move uploaded files
		
		if( move_uploaded_file($_FILES["files"]["tmp_name"][$i], $dir .$file_id.'/'. $name) )
		{
			$count++;
			$name = $_FILES["files"]["name"][$i];
			$size = $_FILES["files"]["size"][$i];
			$type = $_FILES["files"]["type"][$i];
			$username = 'guest';
			$password=$_POST['password'];
			$password = stripslashes($password);
			$password = mysql_real_escape_string($password);
			$privacy = $_POST['privacy'];
			if($password==""){$pass_flag=0;}
			else{$pass_flag=1;}
			$sql="INSERT INTO files (filename,size,filetype,username,short_id,password,privacy) VALUES('$name','$size','$type','$username','$file_id','$password','$privacy') ";
			mysql_query($sql) or die('Error, query failed');
		}
	}
	
create_zip($dir.$file_id.'/',$file_id);
		
			if($pass_flag==1 && $privacy=="Private")
			{
			$rpath=realpath($dir.$file_id.'/');
			//echo "poop".$rpath."poop";
			$t = '../files/'.$file_id.'/.htaccess';
			$myfile = fopen($t, "w");
			$txt = 'AuthName "Protected Area"
			AuthType Basic
			AuthUserFile '.$rpath.'\.htpasswd
			require valid-user';
			fwrite($myfile, $txt);
			fclose($myfile);
			
			
			$myfile2 = fopen("windows_script.vbs", "w");
			$txt2 = 'Dim oShell
			Set oShell = WScript.CreateObject ("WScript.Shell")
			oShell.run "cmd /k cd/. & cd xampp/apache/bin & htpasswd.exe -c -b '.$rpath.'\.htpasswd user '.$password .'& cd/. & exit "';
			fwrite($myfile2, $txt2);
			fclose($myfile2);
			exec('windows_script.vbs');
			}
if($pass_flag==0)
echo json_encode(array('count' => $count , 'url' => "</br>".$file_id.'/'.$file_id.".zip" , 'pass' =>  ''));
else
echo json_encode(array('count' => $count , 'url' => "</br>".$file_id.'/'.$file_id.".zip" , 'pass' =>  "</br>Your password is".$password));

}
?>
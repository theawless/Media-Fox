<?php

include('session.php');
include('../reqs/functions.php');
$max_size = 1024*20000000000; // 20000Mb
$allowed_types= array('mp4','avi','mkv','flv');
$dir = '../videos/';
$count = 0;
$file_id = $_POST['file_id'];
mkdir($dir.$file_id.'/');

if ($_SERVER['REQUEST_METHOD'] == 'POST' )
{
	//echo "poop";
	// loop all files
	$name=$_FILES['files']['name'];
	{
		$file_ext=pathinfo($name,PATHINFO_EXTENSION);
		
		// skip unprotected files
		if( in_array($file_ext,$allowed_types) )
		{
			move_uploaded_file($_FILES["files"]["tmp_name"], $dir .$file_id.'/'. $name);
			$count++;
			$name = $_FILES["files"]["name"];
			$username = $_SESSION['login_user'];
			$size = $_FILES["files"]["size"];
			$type = $_FILES["files"]["type"];
			$pass_flag=0;$password="";
			$sql="INSERT INTO files (filename,size,filetype,username,short_id,password,privacy,video) VALUES('$name','$size','$type','$username','$file_id','$password','Public','video') ";
			mysql_query($sql) or die('Error, query failed');
		}
	}	
echo json_encode(array('count' => $count , 'url' => "</br>".$file_id.'/'.$file_id.".zip" , 'pass' =>  ''));
}
?>
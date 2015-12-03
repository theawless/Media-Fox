<?php

include('session.php');
include('../reqs/functions.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$awesome_path="";
$flag=0;
$folder_name="";
$file_id="";
if(sizeof($_FILES) > 0 && $_SERVER['REQUEST_METHOD'] == 'POST')
{
	$file_id = $_POST['file_id'];
	$fileUploader = new FileUploader($_FILES);
}

class FileUploader{
	public function __construct($uploads,$uploadDir='../files/'){
		global $folder_name,$flag, $awesome_path,$file_id;
	
		//$file_id = generate_access_id(6);
		//echo json_encode(array('count' => '1' , 'url' => "</br>".$file_id.'/'.$file_id.".zip" , 'pass' =>  ''));
		
		mkdir($uploadDir.$file_id.'/');
		$uploadDir=$uploadDir.$file_id.'/';
		
		// Split the string containing the list of file paths into an array 
		$paths = explode("###",rtrim($_POST['paths'],"###"));
		
		// Loop through files sent
		foreach($uploads as $key => $current)
		{
			// Stores full destination path of file on server
			$this->uploadFile=$uploadDir.rtrim($paths[$key],"/.");
			// Stores containing folder path to check if dir later
			$this->folder = substr($this->uploadFile,0,strrpos($this->uploadFile,"/"));
			
			// Check whether the current entity is an actual file or a folder (With a . for a name)
			if(strlen($current['name'])!=1)
				// Upload current file
				$this->upload($current,$this->uploadFile);
		}
		
		$username = $_SESSION['login_user'];
		$password=$_POST['password'];
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);
		$privacy = $_POST['privacy'];
		$expiry = $_POST['expiry'];
		$sql="INSERT INTO files (filename,size,filetype,username,short_id,password,privacy,expiry) VALUES('$folder_name','NAN','folder','$username','$file_id','$password','$privacy','$expiry') ";
		mysql_query($sql) or die('Error, query failed');
		
		
		create_zip($uploadDir,$file_id);
		if($password!="" && $privacy=="Private")
			{
			$rpath=realpath($uploadDir);
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
			
			$loll = '../files/'.$file_id.'/index.php';
			$file = fopen($loll,"w");
			$codee = '<?php 
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("ftusers", $connection);
$parent = basename(dirname($_SERVER["PHP_SELF"]));
$query = "SELECT * FROM files where short_id= \'$parent\' " ; 
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$countt = $row[\'expiry\'];
if($countt>0){
	$expiryy = $row[\'expiry\'] - 1;
	$sql="Update files SET expiry=\'$expiryy\' where short_id= \'$parent\' ";
	mysql_query($sql) or die(\'Error, query failed\');
	if($countt==1){
		$query2 = "DELETE FROM files WHERE short_id = \'$parent\' "; 
		$result2 = mysql_query($query2);
		if($row[\'expiry\']==0)
		unlink($file_name);
		echo "File has been deleted";
	}
	mysql_close($connection);
	$yy = "Location: ".$parent.".zip" ; 
	header($yy);
}

echo $parent."zip"?>';
			fwrite($file,$codee);
	fclose($file);


			
		if($password=="")
		echo json_encode(array('count' => 1 , 'url' => "</br>".$file_id.'/'.$file_id.".zip" , 'pass' =>  ''));
		else
		echo json_encode(array('count' => 1 , 'url' => "</br>".$file_id.'/'.$file_id.".zip" , 'pass' =>  "</br>Your password is".$password));
		
	}
	
	private function upload($current,$uploadFile){
		// Checks whether the current file's containing folder exists, if not, it will create it.
		global $folder_name,$flag, $awesome_path;
		if(!is_dir($this->folder))
		{
			mkdir($this->folder);
			if($flag==0){$awesome_path=$this->folder;}
			$flag=1;
			$folder_name=get_folder_name($awesome_path);
	
			//$file = fopen("../files/test.txt","a");
			//fwrite($file,$folder_name);
			//fclose($file);
		
		}
		// Moves current file to upload destination
		if(move_uploaded_file($current['tmp_name'],$uploadFile))
			return true;
		else 
			return false;
	}
	
	
}
?>
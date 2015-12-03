<?php

$connection = mysql_connect("localhost", "root", "");
// Selecting Database
$db = mysql_select_db("ftusers", $connection);

function generate_random_letters($length) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= chr(rand(ord('a'), ord('z')));
  }
  
  return $random;
}

function id_is_in_files($access_id) 
{
  $check_query = mysql_query("SELECT * FROM files WHERE (short_id = '$access_id')");
  
  if( mysql_num_rows($check_query) ) 
  {
    return true;
  }
  else
  {
    return false;
  }
}

function generate_access_id($id_length) {
  do {
    $unique_id = generate_random_letters($id_length);
  } while (id_is_in_files($unique_id));
  
  return $unique_id;
}

/* creates a compressed zip file */
function create_zip($destination,$zip_name)
 {
	//if the zip file already exists and overwrite is false, return false
		//if(file_exists($destination) && !$overwrite) { return false; }
		//vars
			
			// Get real path for our folder
	$rootPath = realpath($destination);

	// Initialize archive object
	$zip = new ZipArchive();
	$zip->open($destination.$zip_name.".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

	// Initialize empty "delete list"
	$filesToDelete = array();

	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($rootPath),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ($files as $name => $file)
	{
		// Skip directories (they would be added automatically)
		if (!$file->isDir())
		{
			// Get real and relative path for current file
			$filePath = $file->getRealPath();
			$relativePath = substr($filePath, strlen($rootPath) + 1);

			// Add current file to archive
			$zip->addFile($filePath, $relativePath);

			// Add current file to "delete list"
			// delete it later cause ZipArchive create archive only after calling close function and ZipArchive lock files until archive created)
			if ($file->getFilename() != 'important.txt')
			{
				$filesToDelete[] = $filePath;
			}
		}
	}

// Zip archive will be created only after closing object
	$zip->close();

// Delete all files from "delete list"
	foreach ($filesToDelete as $file)
	{
		unlink($file);
	}	
}

function get_folder_name($src)
{
	$temp='';
	$i=strlen($src)-1;
	while($src[$i]!='/')
	{
		$temp .= $src[$i];
		$i--;
	}
	return strrev($temp);
}

?>
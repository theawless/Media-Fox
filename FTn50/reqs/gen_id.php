<?php

$connection = mysql_connect("localhost", "root", "");
// Selecting Database
$db = mysql_select_db("ftusers", $connection);

echo generate_access_id(6);

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
?>
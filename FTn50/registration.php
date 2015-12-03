<?php

include('connect.php');
If(isset($_REQUEST['submit'])!='')
{
	If($_REQUEST['username']=='' || $_REQUEST['email']=='' || $_REQUEST['password']=='')
	{
		Echo "Please fill the empty field.";
	}
	Else
	{
		$sql="insert into ftusers(username,email,password) values('".$_REQUEST['username']."', '".$_REQUEST['email']."', '".$_REQUEST['password']."')";
		$res=mysql_query($sql);
		If($res)
		{
			Echo "Record successfully inserted";
			header('Location: index.html'); 
			exit;
		}
		Else
		{
			Echo "There is some problem in inserting record";
		}
	}
}
?>

<?php
include('session.php');

$user = $row['username'];
$query = "SELECT * FROM files where username='$user' "; //You don't need a ; like you do in SQL
$result = mysql_query($query);

echo "
<!DOCTYPE html>

<html lang=\"en\">


<head>
	<link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
		
	<link href=\"css/bootstrap.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,700,800,400,600' rel='stylesheet' type='text/css'>
		

    <meta charset=\"utf-8\">

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">

    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

 
   <title style=\"color:black; \">Welcome</title>

	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/pure-min.css\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style2.css\">

	<!--STYLESHEETS-->
	<link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\" />

    <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\" type=\"text/css\">
    <link rel=\"stylesheet\" href=\"font-awesome/css/font-awesome.min.css\" type=\"text/css\">
    <link rel=\"stylesheet\" href=\"css/animate.min.css\" type=\"text/css\">

    <link rel=\"stylesheet\" href=\"../css/creativeshowuploadedfiles.css\" type=\"text/css\">

  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
  <script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js\"></script>


	<link href=\"http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-responsive.min.css\" rel=\"stylesheet\">


</head>



<body>


    <nav id=\"mainNav\" class=\"navbar navbar-default navbar-fixed-top\">

       <div class=\"container-fluid\">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class=\"navbar-header\">

                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">

                    <span class=\"sr-only\">Toggle navigation</span>

                    <span class=\"icon-bar\"></span>

                    <span class=\"icon-bar\"></span>

                    <span class=\"icon-bar\"></span>

                </button>

                <a class=\"navbar-brand page-scroll\" href=\"../index.html\">MediaFox</a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">

          <ul class=\"nav navbar-nav navbar-right\">

             <li><a class=\"page-scroll\" data-toggle=\"modal\" href=\"#\">Welcome <?php echo $login_session; ?></a></li>

             <li><a class=\"page-scroll\"  href=\"../index.html\">Home</a></li>

             <li><a class=\"page-scroll\"  href=\"logout.php\">Sign Out</a></li>

             <li><a class=\"page-scroll\" href=\"#\">Contact</a></li>

          </ul>

        </div>

            <!-- /.navbar-collapse -->

       </div>

        <!-- /.container-fluid -->

    </nav>

<header>
        <div class=\"header-content\">

            <div class=\"header-content-inner\">
<br></br>

";

echo "<form name=\"upload-formm\" action=\"downloader.php\" class=\"upload-formm\" enctype=\"multipart\" method=\"post\">";
echo"<div class=\"header\"><h1>Enter correct password to download this file</h1></div>";
echo"<div class=\"content\">";
echo "<br></br><table id=\"mainTable\" class=\"table table-stripedd\">"; // start a table tag in the HTML
echo "<th>File Name</th><th>File Size</th><th>Download Link</th>";
while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
	echo "<tr><td>" . $row['filename'] . "</td><td>" . $row['size']. "</td><td>" ."<a href='../files/".$row['short_id']."/".$row['short_id'].".zip"."'>Download</a>" . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTM  
echo "</div>";
echo "</div>";
echo "</form>";

echo "


</div>
</div>


</header>


<div id=\"services\" class=\"services\">

<div class=\"container\">
								
<div class=\"col-md-4 services-info wow bounceIn\" data-wow-delay=\"0.4s\">

			<div class=\"col-md-3 img-grid\">
						
<a href=\"upload.php\"><span> </span></a>

			</div>
					
<div class=\"col-md-9 img-grid-text\">
						
<h4>UPLOAD A FILE</h4>

		<p>Click on the icon to upload a file of any size with super fast speed.</p>
					
</div>

			</div>
			
			<div class=\"col-md-4 services-info wow bounceIn\" data-wow-delay=\"0.4s\">

			<div class=\"col-md-3 img-grid\">
						
<a href=\"upload2.php\"><span> </span></a>

			</div>
					
<div class=\"col-md-9 img-grid-text\">
						
<h4>UPLOAD A FOLDER</h4>

		<p>Click on the icon to upload a file of any size with super fast speed.</p>
					
</div>

			</div>

<div class=\"col-md-4 services-info wow bounceIn\" data-wow-delay=\"0.4s\">

					<div class=\"col-md-3 img-grid\">

						<a href=\"#uploadModal\" data-toggle=\"modal\" ><span class=\"food\"> </span></a>

					</div>

					<div class=\"col-md-9 img-grid-text\">

						<h4>DELETE A FILE</h4>

						<p>Click on the icon to delete a file from your uploads list.</p>

					</div>

				</div>

			

				</div>

				<div class=\"clearfix\"> </div>

			</div>
     </body>

</html>";
?>


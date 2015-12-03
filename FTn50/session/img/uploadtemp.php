<?php
  include('../reqs/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,700,800,400,600' rel='stylesheet' type='text/css'>
		
<?php include('session.php');?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

 
   <title style="color:black; ">Upload Multiple Files</title>

	<link rel="stylesheet" type="text/css" href="css/pure-min.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">

	<!--STYLESHEETS-->
	<link href="css/style.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">
    <link rel="stylesheet" href="css/creative.css" type="text/css">



        <script type="text/javascript" src="../js/js_upload1/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="js/jquery.screwdefaultbuttonsV2.js"></script>
	
	
	<script type="text/javascript">
		$(function(){
		
			$('input:radio').screwDefaultButtons({
				image: 'url("images/radioSmall.jpg")',
				width: 43,
				height: 43
			});
			
			$('input:checkbox').screwDefaultButtons({
				image: 'url("images/checkboxSmall.jpg")',
				width: 43,
				height: 43
			});

			
		
		});
	</script>
	
	<style>
	
		body {
			font-family: tahoma, ariel, sans-serif;
			letter-spacing: 0.1em;
			color: #444;
		}
		
		.styledRadio, .styledCheckbox {
			display: inline-block;
		}
		
		
		.example {
			padding: 50px 0 0 20px;
		}
		
		label {
			line-height: 43px;
			font-size: 20px;
			vertical-align: 14px;
			padding-right: 20px;
		}
		
		button{
			display: block;
		}
	
	</style>
	


</head>

<body>








    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">

       <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand page-scroll" href="../index.html">MediaFox</a>

            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">


             <li><a class="page-scroll"  href="profile.php"><?php echo $login_session; ?></a></li>

             <li><a class="page-scroll"  href="logout.php">Sign Out</a>
</li>
          </ul>

        </div>

            <!-- /.navbar-collapse -->

       </div>

        <!-- /.container-fluid -->

    </nav>




    <header>

        <div class="header-content">

            <div class="header-content-inner">
  							<!-- Modal for "File Uploader" form -->

	<br></br><br></br>
	<form name="upload-form" action="uploader.php" class="upload-form" enctype="multipart/form-data" method="post">
    		<div class="header"><h1>Upload Your File</h1></div>
			
    		<div class="content">
			
				
			<div class="status"></div>
			
			<div class="footer">
			<h3 align="left">PASSWORD</h3>
			<input style="float:left" name="password" id="mypassword" type="password" class="input password" value="" onfocus="this.value=''" /><!--END PASSWORD-->
				
				<input style="float:center" type="file" name="files[]" multiple="multiple" id="files">
				<input type="radio" name="privacy" value="Public" id="privacy" >

					<label for="privacy">Public</label>

		
		<input type="radio" name="privacy" value="Secret" id="privacy" >

					<label for="privacy">Secret</label>

		
		<input type="radio" name="privacy" value="Private" id="privacy" >

					<label for="privacy">Private</label>
				<input type="submit" name="submit" value="Upload" class="button" />
			
			</div>
    		</div>
			
	<div class="progress">
		<div class="bar"></div >
		<div class="percent">0%</div >
	</div>
	</form>
	<!-- javascript dependencies -->
	
	<script type="text/javascript" src="../js/js_upload1/jquery.form.min.js"></script>
	
	<!-- main script -->
	<script type="text/javascript" src="../js/script.js"></script>




            </div>

        </div>

    </header>



    
  
</body>

</html>

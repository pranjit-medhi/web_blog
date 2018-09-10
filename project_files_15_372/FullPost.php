<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php 
if(isset($_POST['Submit'])){
	$Name=mysql_real_escape_string( $_POST['Name']);
	$Email =mysql_real_escape_string( $_POST['Email']);
	$Comment =mysql_real_escape_string( $_POST['Comment']);
	date_default_timezone_get("Asia/Kolkata");
	$CurrentTime=time();
	$DateTime = strftime("%d-%B-%Y  %H:%M:%S", $CurrentTime);
	$DateTime;
	$PostId = $_GET['id'];
	if(empty($Name) || empty($Email) || empty($Comment)){
		$_SESSUploadION["ErrorMessage"]="All fields are required";		

	}elseif(strlen($Comment)>300){
		  $_SESSION["ErrorMessage"] = "Comment should be less tahn 300 Character";
		  
	}
	else{
		global $ConnectingDB;
		$PostIdFromUrl= $_GET['id'];
		$Query = "INSERT INTO comments(date_time, name, email, comment,status, admin_panel_id) VALUES('$DateTime', '$Name', 'Email','$Comment','OFF','$PostIdFromUrl')";
		$Execute = mysql_query($Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Comment Submitted Succesfully";
			Redirect_to("FullPost.php?id={$PostId}");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong";
			Redirect_to("FullPost.php?id={$PostId}");
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Full Blog Post</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">

</head>
<body>
<div style = "height: 10px; background: #27aae1;"></div>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" header="blog.php">
				<img src="image/x.jpg" width="200; height30;">
			</a>
		</div>
		<div class="collapse navbar-collapse" id ="collapse">
			<ul class="nav navbar-nav">
				<li><a href="#">Home</a></li>
				<li><a class="active" href="#">Blog</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">Contact Us</a></li>						
				<li><a href="#">Features</a></li>						
			</ul>	
			<form action="blog.php" class="navbar-form navbar-right">
				<div class="form-group">
					<input type="text" name="Search" class="form-control" placeholder="Search">
				</div>
				<button class="btn btn-default" name="SearchButton">Go</button>	
			</form>
		</div>
	</div>
</nav>
<div  class="Line" style = "height: 10px; background: #27aae1;"></div>

<div class="container">
	<div class="blog-header"><h1>The Complete Responsive CMS Blog  </h1>
	<p class="lead">The Complete blog using PHP by Pranjit Medhi</p>
	</div>
	<div class="row">
		<div class="col-sm-8"><!--Blog body-->
			<?php  echo Message();
						echo SuccessMessage();

				?>
			<?php
			global $ConnectingDB;
			if(isset($_GET["SearchButton"])){
				$Search = $_GET["Search"];
				$ViewQuery = "SELECT * FROM  admin_panel WHERE date_time  LIKE '%$Search%' OR title LIKE '%Search%' OR post LIKE '%Search%'  OR category LIKE '%Search%'";}
			else{
				$PostIdFromUrl = $_GET["id"];
				$ViewQuery = "SELECT * FROM admin_panel WHERE id='$PostIdFromUrl' ORDER BY date_time desc";}
				$Execute = mysql_query($ViewQuery);
				 while($DataRows = mysql_fetch_array($Execute)){
				$PostId=$DataRows["id"];
				$DateTime=$DataRows["date_time"];
				$Title=$DataRows["title"];
				$Category=$DataRows["category"];
				$Admin=$DataRows["author"];
				$Image=$DataRows["image"];
				$Post=$DataRows["post"];

			
			?>
			<div class=" blogpost thumbnail">
				<img class ="img-responsive img-rounded" src="Upload/<?php echo $Image;?>">
				<div class="caption">
					<h1 id ="heading"><?php echo htmlentities($Title); ?></h1>
					<p class="description"> Category:<?php echo htmlentities($Category); ?> 
						Published on: <?php  echo htmlentities($DateTime);  ?>
					</p>
					<p class="post"><?php echo nl2br($Post); ?>
					</p>
				</div>
			
			</div>
		<?php  } ?>
		<span class="FieldInfo"> Comments:</span>
		<?php
			$ConnectingDB;
			$PostIdForComments=$_GET["id"];
			$ExtractingCommentsQuery="SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status= 'ON' ";
			$Execute=mysql_query($ExtractingCommentsQuery);
			while($DataRows=mysql_fetch_array($Execute)){
				$CommentDate=$DataRows["date_time"];
				$CommenterName=$DataRows["name"];
				$Comments=$DataRows["comment"];
		?>
		<div class="CommentBlock">
			<img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="image/comment.png" width=70px; height=70px;>
			<p style="margin-left: 90px;" class="Comment-info"><?php echo $CommenterName; ?></p>
			<p style="margin-left: 90px;"class="description"><?php echo $CommentDate; ?></p>
			<p style="margin-left: 90px;" class="Comment"><?php echo nl2br($Comments); ?></p>
			 
		</div>

	<hr>
<?php } ?>
		
		<br><br>
		<span class="FieldInfo"> Share your thoughts about the post</span>
		<br>
		
		<br>
				<div>
					<form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data"> 
							<fieldset>
							<div class="form-group">
								<label for="Name"><span class="FieldInfo">Name:</span></label>
								<input class="form-control" type="text" name="Name" id="TName" placeholder="Name">
							</div>
							
							<div class="form-group">
								<label for="Title"><span class="FieldInfo">Email:</span></label>
								<input class="form-control" type="Email" name="Email" id="Title" placeholder="Email">
							</div>
							
							<div class="form-group">
								<label for= "Commentarea"><span class="FieldInfo">Comment:</span></label>
								<textarea class="form-control" name="Comment" id = "Commentarea"></textarea>
								<br>
								</div>
								<input class="btn btn-success " type="Submit" name="Submit" value="Submit">
								<br>
							</fieldset>
							<br>
						</form>
					</div>

		</div><!--Blog End-->

		<div class="col-sm-offset-1 col-sm-3"><!-- Sidebar-->

			<h2>About me </h2>
	<img class=" img-responsive img-circle imageicon" src="image/Bunny.jpg">		
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit
		, sed do eiusmod tempor incididunt ut labore et dolore magna
		aliqua. Ut enim ad minim veniam, quis nostrud exercitation ul
		lamco laboris nisi ut aliquip ex ea commodo consequat. Duis a
		ute irure dolor in reprehenderit in voluptate velit esse cill
		um dolore eu fugiat nulla pariatur. Excepteur sint occaecat c
		upidatat non proi
		dent, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Categories</h2>
	</div>
	<div class="panel-body">
<?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysql_query($ViewQuery);
while($DataRows=mysql_fetch_array($Execute)){
	$Id=$DataRows['id'];
	$Category=$DataRows['name'];
?>
<a href="Blog.php?Category=<?php echo $Category; ?>">
<span id="heading"><?php echo $Category."<br>"; ?></span>
</a>
<?php } ?>

</div>
	<div class="panel-footer">
		
		
	</div>
</div>




<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Recent Posts</h2>
	</div>
	<div class="panel-body background">
<?php
$ConnectingDB;
$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
$Execute=mysql_query($ViewQuery);
while($DataRows=mysql_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$Title=$DataRows["title"];
	$DateTime=$DataRows["date_time"];
	$Image=$DataRows["image"];
	if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,12);}
	?>
<div>
<img class="pull-left" style="margin-top: 10px; margin-left: 0px;"  src="Upload/<?php echo htmlentities($Image); ?>" width=120; height=60;>
    <a href="FullPost.php?id=<?php echo $Id;?>">
     <p id="heading" style="margin-left: 130px; padding-top: 10px;"><?php echo htmlentities($Title); ?></p>
     </a>
     <p class="description" style="margin-left: 130px;"><?php echo htmlentities($DateTime);?></p>
	<hr>
</div>	
	
	
	
<?php } ?>		
		
	</div>
		</div><!-- Sidebar end-->
	</div><!-- Row end-->
</div><!-- Container End-->
	







<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>
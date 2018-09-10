<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php 
if(isset($_POST['Submit'])){
	$Title=mysql_real_escape_string( $_POST['Title']);
	$category =mysql_real_escape_string( $_POST['category']);
	$Post =mysql_real_escape_string( $_POST['Post']);
	date_default_timezone_get("Asia/Kolkata");
	$CurrentTime=time();
	$DateTime = strftime("%d-%B-%Y  %H:%M:%S", $CurrentTime);
	$DateTime;
	$Admin = "Pm";
	$Image = $_FILES["image"]["name"];
	$Target = "Upload/".basename($_FILES["image"]["name"]);
	
		global $ConnectingDB;
		$DeleteFromUrl= $_GET['Delete'];
		$Query = "DELETE  FROM admin_panel WHERE id='$DeleteFromUrl'";

		$Execute = mysql_query($Query);
		move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
		if($Execute){
			$_SESSION["SuccessMessage"]="Post Deleted Succesfully";
			Redirect_to("dashboard.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong";
			Redirect_to("dashboard.php");
		}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Post </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class= "col-sm-2">
			<br><br>
				<ul id="Side_Menu" class="nav nav-pills nav-stacked">
				<li >
				<a href="Dashboard.php">
				<span class="glyphicon glyphicon-th"></span>
				&nbsp;Dashboard</a></li>
				<li class="active" ><a href="AddNewPost.php">
				<span class="glyphicon glyphicon-list-alt"></span>
				&nbsp;Add New Post</a></li>
				<li ><a href="Categories.php">
				<span class="glyphicon glyphicon-tags"></span>
				&nbsp;Categories</a></li>
				<li><a href="Admins.php">
				<span class="glyphicon glyphicon-user"></span>
				&nbsp;Manage Admins</a></li>
				<li><a href="Comments.php">
				<span class="glyphicon glyphicon-comment"></span>
				&nbsp;Comments
				<li><a href="Blog.php?Page=1" target="_Blank">
				<span class="glyphicon glyphicon-equalizer"></span>
				&nbsp;Live Blog</a></li>
				<li><a href="Logout.php">
				<span class="glyphicon glyphicon-log-out"></span>
				&nbsp;Logout</a></li>	
				</ul>
			</div>
			<div class= "col-sm-10">
				<h1>Delete Post</h1>

				<?php  echo Message();
						echo SuccessMessage();

				?>
					<div>
						<?php
						$SearchQueryParameter= $_GET['Delete'];
						global $ConnectingDB;
						$Query = "SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
						$ExecuteQuery = mysql_query($Query);
						while ($DataRows = mysql_fetch_array($ExecuteQuery)){
							$TitleToBeUpdated = $DataRows['title'];
							$CategoryToBeUpdated= $DataRows['category'];
							$ImageToBeUpdated = $DataRows['image'];
							$PostToBeUpdated = $DataRows['post'];
						} 
						?>
					<form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data"> 
						<fieldset>
						<div class="form-group">
							<label for="Title"><span class="FieldInfo">Title:</span></label>
							<input disabled="true" class="form-control" type="text" name="Title" id="Title" placeholder="Title" value="<?php echo $TitleToBeUpdated; ?>">
						</div>
						<br>
						<div class = "form-group">
							<span class="FieldInfo">Existing Category:</span>
							<?php  echo $CategoryToBeUpdated; ?><br>
							<label for="category"><span class="FieldInfo">Category</span> </label>
							<select  disabled="true"  class="form-control" id ="category" name = "category">
								<?php
									global $ConnectingDB;
									$ViewQuery = "SELECT * FROM category ORDER BY date_time desc";
									$Execute = mysql_query($ViewQuery);
									while($DataRows = mysql_fetch_array($Execute)){
										$CategoryName = $DataRows["name"];
										?>
									<option><?php echo "$CategoryName";?></option>
									<?php  } ?>
								</select>
							</div>
							<br>
							<div class="form-group">
								<span class="FieldInfo">Existing Image:</span>
							<img src="Upload/<?php  echo $ImageToBeUpdated; ?>" width = 170px; height =70px;> <br>
								<label for ="imageselect"><span class="FieldInfo">Select</span> </label>
								<input  disabled="true"  type ="File" class="form-control" name= "image" id="imageselect">
								</div>
								<div class="form-group">
									<label for= "postarea"><span class="FieldInfo">Post:</span></label>
									<textarea  disabled="true" class="form-control" name="Post" id = "postarea"><?php  echo $PostToBeUpdated; ?></textarea>
									<br>
							</div>
							<input class="btn btn-danger btn-block" type="Submit" name="Submit" value="Delete Post">
							<br>
						</fieldset>
						<br>
					</form>
				</div>
			</div>
	</div>

<div id="Footer">
<hr><p>Theme By | Pranjit Medhi |&copy;2018--- All right reserved.
</p>
<a style="color: white; text-decoration: none; cursor: pointer; font-weight:bold;" target="_blank">
<p>
 <br>&trade; &trade;  </p><hr>
</a>
	
</div>	

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
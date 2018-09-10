<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login() ?>
<?php 
if(isset($_POST['Submit'])){
	$category =mysql_real_escape_string( $_POST['category']);
	date_default_timezone_get("Asia/Kolkata");
	$CurrentTime=time();
	$DateTime = strftime("%d-%B-%Y  %H:%M:%S", $CurrentTime);
	$DateTime;
	$Admin =$_SESSION["Username"];
	if(empty($category)){
		$_SESSION["ErrorMessage"]="All field must be filled out";
		Redirect_to("dashboard.php");
		

	}elseif(strlen($category)>99){
		  $_SESSION["ErrorMessage"] = "Too Long Name for category";
		  Redirect_to("Categories.php");
	}
	else{
		global $ConnectingDB;
		$Query="INSERT INTO category(date_time, name, author) VALUES('$DateTime','$category', '$Admin')";
		$Execute = mysql_query($Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Category Added Succesfully";
			Redirect_to("Categories.php");
		}
		else{
			$_SESSION["ErrorMessage"] = "Something went wrong";
			Redirect_to("Categories.php");
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Categories</title>
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
				<li><a href="AddNewPost.php">
				<span class="glyphicon glyphicon-list-alt"></span>
				&nbsp;Add New Post</a></li>
				<li class="active"><a href="Categories.php">
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
		<h1>Manage Categories</h1>

		<?php  echo Message();
				echo SuccessMessage();

		?>
			<div>
			<form action="Categories.php" method="post">
				<fieldset>
				<div class="form-group">
					<label for="categoryname"><span class="FieldInfo">Name of category:</span></label>
					<input class="form-control" type="text" name="category" id="categoryname" placeholder="Name">
				</div>
				<br>
				<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
				<br>
				</fieldset>
				<br>
			</form>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th> Sr. no </th>
					<th> Date & Time </th>
					<th> Category Name </th>
					<th> Author </th>
				</tr>
				<?php
				global $ConnectingDB;
				$ViewQuery = "SELECT * FROM category ORDER BY date_time desc";
				$Execute = mysql_query($ViewQuery);
				$SrNo=0;
				while($DataRows = mysql_fetch_array($Execute)){
					$DateTime = $DataRows["date_time"];
					$CategoryName = $DataRows["name"];
					$author = $DataRows["author"];
					$SrNo++;
				
				?>
				<tr>
					<td><?php echo $SrNo;?></td>
					<td><?php echo $DateTime;?></td>
					<td><?php echo $CategoryName;?></td>
					<td><?php echo $author;?></td>
				</tr>
			

			<?php } ?>
			</table>
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
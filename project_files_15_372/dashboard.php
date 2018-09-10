<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php Confirm_Login() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
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
				<img src="image/x.jpg" width="150;" height="25;">
			</a>
		</div>
		<div class="collapse navbar-collapse" id ="collapse">
			<ul class="nav navbar-nav">
				<li><a class="active" href="blog.php?=1" target="_blank">Blog</a></li>
				<li><a href="#">About Us</a></li>
										
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
<div class="container-fluid">
	<div class="row">
		<div class= "col-sm-2">
			<br><br>
				<ul id="Side_Menu" class="nav nav-pills nav-stacked">
				<li class="active">
				<a href="Dashboard.php">
				<span class="glyphicon glyphicon-th"></span>
				&nbsp;Dashboard</a></li>
				<li><a href="AddNewPost.php">
				<span class="glyphicon glyphicon-list-alt"></span>
				&nbsp;Add New Post</a></li>
				<li><a href="Categories.php">
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

		<div class= "col-sm-10"><!-- Main area-->
			<div ><?php  echo Message();
					echo SuccessMessage();

			?></div>
			
			<h2>Admin Dashboard</h2>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th> No</th>
						<th> Post Title</th>
						<th> Date & Time</th>
						<th> Author</th>
						<th>Category</th>
						<th>&nbsp;&nbsp;Image</th>
						<th>Comments</th>
						<th>Action</th>
						<th>Preview</th>
					</tr>
					<?php
					global $ConnectingDB;
					$ViewQuery ="SELECT * FROM admin_panel ORDER BY date_time desc;";
					$Execute = mysql_query($ViewQuery);
					$SrNo=0;
					while($DataRows = mysql_fetch_array($Execute)){
						$Id = $DataRows["id"];
						$DateTime = $DataRows["date_time"];
						$Title = $DataRows["title"];
						$Category = $DataRows["category"];
						$Admin = $DataRows["author"];
						$Image = $DataRows["image"];
						$Post = $DataRows["post"];
						$SrNo++;
					?>
					<tr>
						<td><?php echo $SrNo; ?></td>
						<td style="color:#5e5eff;"><?php if(strlen($Title)>20){
							$Title = substr($Title,0,20).'...';
						} echo $Title; ?></td>
						<td><?php if(strlen($DateTime)>12){$DateTime = substr($DateTime,0,12);
						}echo $DateTime; ?></td>
						<td><?php if(strlen($Admin)>6){	$Admin= substr($Admin, 0,6); } echo $Admin; ?></td>
						<td><?php echo $Category; ?></td>
						<td><img src = "Upload/<?php echo $Image; ?>" width="160px"; height="46px;"></td>
						<td>
							<?php
								$ConnectingDB;
								$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
								$ExecuteApproved=mysql_query($QueryApproved);
								$RowsApproved=mysql_fetch_array($ExecuteApproved);
								$TotalApproved=array_shift($RowsApproved);
								if($TotalApproved>0){
								?>
								<span class="label pull-right label-success">
								<?php echo $TotalApproved;?>
								</span>
										
								<?php } ?>

								<?php
								$ConnectingDB;
								$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
								$ExecuteUnApproved=mysql_query($QueryUnApproved);
								$RowsUnApproved=mysql_fetch_array($ExecuteUnApproved);
								$TotalUnApproved=array_shift($RowsUnApproved);
								if($TotalUnApproved>0){
								?>
								<span class="label  label-danger">
								<?php echo $TotalUnApproved;?>
								</span>
										
								<?php } ?>

						</td>
						<td><a href="EditPost.php?Edit=<?php echo $Id;?>"><span class ="btn btn-warning"> Edit </span></a>
							<a href="DeletePost.php?Delete=<?php echo $Id;?>"><span class ="btn btn-danger"> Delete</span></a>
						</td>
						<td><a href="FullPost.php?id=<?php echo $Id;?>"><span class ="btn btn-primary"> Live Preview</span></a> </td>
					</tr> 
				<?php } ?>
				</table>
			</div>
			
		</div>
	</div>
</div>

<div id="Footer">
<hr><p>Theme By | Pranjit Medhi |&copy;2018--- All right reserved.
</p>
<a style="color: white; text-decoration: none; cursor: pointer; font-weight:bold;" href="http://jazebakram.com/coupons/" target="_blank">
<p>
 <br>&trade; &trade;  </p><hr>
</a>
	
</div>	

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php Confirm_Login() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Comments</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
</head>
<body>
	<div style = "height: 10px; background: #27aae1;"></div>

<div  class="Line" style = "height: 10px; background: #27aae1;"></div>
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
				<li><a href="Categories.php">
				<span class="glyphicon glyphicon-tags"></span>
				&nbsp;Categories</a></li>
				<li><a href="Admins.php">
				<span class="glyphicon glyphicon-user"></span>
				&nbsp;Manage Admins</a></li>
				<li class="active"><a href="Comments.php">
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
					echo SuccessMessage();?>
			</div>
			
			<h2>Unapproved Comments</h2>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date</th>
						<th>Comment</th>
						<th>Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>
					<?php
					global $ConnectingDb;
					$Query ="SELECT * FROM comments WHERE status='OFF' ORDER BY date_time DESC";
					$Execute = mysql_query($Query);
					$SrNo = 0;
					while($Datarows = mysql_fetch_array($Execute)){
						$CommentId = $Datarows['id'];
						$DateTime = $Datarows['date_time'];
						$Name = $Datarows['name'];
						$Comment = $Datarows['comment'];
						$PostId= $Datarows['admin_panel_id'];
						$SrNo++;
						if(strlen($Comment)> 20){$Comment = substr($Comment, 0,18).'...';}
						if(strlen($Name)>10) {$Name = substr($Name,0,10).'...';}
						if(strlen($DateTime)>10) {$DateTime = substr($DateTime,0,12);}
						?>
					<tr>
						 <td><?php echo htmlentities($SrNo);?></td>
						 <td><?php echo htmlentities($Name);?></td>
						 <td><?php echo htmlentities($DateTime);?></td>
						 <td><?php echo htmlentities($Comment);?></td>
						 <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>" ><span class="btn btn-success">Approve</span></a> </td>
						 <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" ><span class="btn btn-danger">Delete</span></a> </td>
						 <td><a href="FullPost.php?id=<?php  echo $PostId; ?>" ><span class="btn btn-primary">Live Preview</span></a> </td>
					</tr>
				<?php }?>
				</table>
			</div>


			<h2>Approved Comments</h2>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date</th>
						<th>Comment</th>
						<th>Approve</th>
						<th>Delete Comment</th>
						<th>Details</th>
					</tr>
					<?php
					global $ConnectingDb;
					$Query ="SELECT * FROM comments WHERE status='ON' ORDER BY date_time DESC";
					$Execute = mysql_query($Query);
					$SrNo = 0;
					while($Datarows = mysql_fetch_array($Execute)){
						$CommentId = $Datarows['id'];
						$DateTime = $Datarows['date_time'];
						$Name = $Datarows['name'];
						$Comment = $Datarows['comment'];
						$PostId= $Datarows['admin_panel_id'];
						$SrNo++;
						if(strlen($Comment)> 20){$Comment = substr($Comment, 0,18).'...';}
						if(strlen($Name)>10) {$Name = substr($Name,0,10).'...';}
						if(strlen($DateTime)>10) {$DateTime = substr($DateTime,0,12);}
						?>
					<tr>
						 <td><?php echo htmlentities($SrNo);?></td>
						 <td><?php echo htmlentities($Name);?></td>
						 <td><?php echo htmlentities($DateTime);?></td>
						 <td><?php echo htmlentities($Comment);?></td>
						 <td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?>" ><span class="btn btn-warning">Dis-Approve</span></a> </td>
						 <td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" ><span class="btn btn-danger">Delete</span></a> </td>
						 <td><a href="FullPost.php?id=<?php echo $PostId; ?>" ><span class="btn btn-primary">Live Preview</span></a> </td>
					</tr>
				<?php }?>
				</table>
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
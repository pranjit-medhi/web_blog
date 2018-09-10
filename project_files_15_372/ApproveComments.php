<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>

<?php
if(isset($_GET['id'])){
	$IdFromUrl = $_GET['id'];
	global $ConnectingDB;
	$Query = "UPDATE comments SET status ='ON' WHERE ID=$IdFromUrl";
	$Execute = mysql_query($Query);
	if($Execute){
		$_SESSION["SuccessMessage"] = "Comments Approeved Successfully";
		Redirect_to("Comments.php");
	}
	else{
		$_SESSION["ErrorMessage"]= "Something Went Wrong. Try Again !";
		Redirect_to("Comments.php");
	}
}
?>
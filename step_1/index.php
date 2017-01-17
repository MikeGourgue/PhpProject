<?php include_once('utility/dbconfig.php');?>
<?php include_once('utility/my_password_utility.php');?>
<?php include_once('header.php');?>


<?php
if(!isset($_SESSION['auth'])) {
	if (isset($_COOKIE['auth'])) {
		set_session();
	} else {
		header('Location: login.php');
		exit;
	}
} else {
?>

	<div class='clearfix'></div>
	<div class='clearfix'></div><br/>

	<div class='container'>
		<h1>Welcome <?php echo json_decode($_SESSION['auth'])->{'username'};  ?></h1>

	</div>

	<div class='clearfix'></div><br />
	<?php include_once('footer.php'); }?>

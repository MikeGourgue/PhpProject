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
	<div class='clearfix'></div><br/>

	<div class='container'>
		<h1>Welcome <?php echo json_decode($_SESSION['auth'])->{'username'};  ?></h1>
	</div>

	<div class='clearfix'></div><br />

	<div class='container'>
		<table class='table table-bordered table-responsive'>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Price</th>
				<th>Category</th>
			</tr>
			<?php
			$query = 'SELECT * FROM products';
			$records_per_page=3;
			$newquery = $product->paging($query,$records_per_page);
			$product->dataview($newquery);
			?>
			<tr>
				<td colspan='7' align='center'>
					<div class='pagination-wrap'>
						<?php $product->paginglink($query,$records_per_page); ?>
					</div>
				</td>
			</tr>

		</table>


	</div>

	<?php include_once 'footer.php'; }?>

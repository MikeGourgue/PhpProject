<?php include_once('utility/dbconfig.php'); ?>
<?php include_once('header.php'); ?>

<?php
if(!isset($_SESSION['auth'])) {
	if (isset($_COOKIE['auth'])) {
		set_session();
	}
	if (!intval(json_decode($_SESSION['auth'])->{'admin'})) {
		header('Location: login.php');
		exit;
	}
} else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = test_input($_POST['name']);
		$price = intval($_POST['price']);

		if ($name && $price) {
			$query = $product->create($name, $price, $category_id);
			header('Location: add-product.php?inserted');

		} else {
			$query = 'mismatching passwordz... douche';
			header('Location: add-product.php?failure');
		}
	}


	?>
	<div class='clearfix'></div>

	<?php
	if(isset($_GET['inserted']))
	{
		?>
		<div class='container'>
			<div class='alert alert-info'>
				<strong>WOW!</strong> Record was inserted successfully !
			</div>
		</div>
		<?php
	}
	else if(isset($_GET['failure']))
	{
		?>
		<div class='container'>
			<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while inserting product !<?php echo "POPO"; ?>
			</div>
		</div>
		<?php
	}
	?>

	<div class='clearfix'></div><br />

	<div class='container'>
		<h2>Create a new Product</h2>

		<form method='post'>

			<table class='table table-bordered'>

				<tr>
					<td>Name</td>
					<td><input type='text' name='username' class='form-control' required></td>
				</tr>

				<tr>
					<td>Price</td>
					<td><input type='text' name='price' class='form-control' required></td>
				</tr>

				<tr>
					<td>Category</td>
					<td><select class="selectpicker">
						<?php
						foreach ($categories as $option) {
							echo "<option>$option</option>";
						}

						?>
					</select>
				</td>
			</tr>
		</tr>

		<tr>
			<td colspan='2'>
				<button type='submit' class='btn btn-primary' name='btn-save'>
					<span class='glyphicon glyphicon-plus'></span> Create New Product
				</button>
				<a href='admin.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; Back to dashboard</a>
			</td>
		</tr>

	</table>
</form>


</div>

<?php include_once('footer.php'); } ?>

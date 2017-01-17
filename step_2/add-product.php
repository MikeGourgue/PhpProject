<?php
include_once('utility/dbconfig.php');
include_once('header.php');
include_once('class.category.php');

$category = new Category($dbh);

if(!isset($_SESSION['auth'])) {
	if (isset($_COOKIE['auth'])) {
		set_session();
	}
	if (json_decode($_SESSION['auth'])->{'admin'} == "0" || !isset($_SESSION['auth'])) {
		header('Location: index.php');
		exit;
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = test_input($_POST['name']);
	$price = intval($_POST['price']);
	$category_id = intval($_POST['category_id']);
	if ($name && $price && $category_id) {
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
if(isset($_GET['inserted'])) {
	?>
	<div class='container'>
		<div class='alert alert-info'>
			<strong>WOW!</strong> Product was inserted successfully !
		</div>
	</div>
	<?php
} else if(isset($_GET['failure'])) {
	?>
	<div class='container'>
		<div class='alert alert-warning'>
			<strong>SORRY!</strong> ERROR while inserting product !
		</div>
	</div>
	<?php
}
?>

<div class='clearfix'></div><br />

<div class='container'>
	<h2>Create a new Product</h2>

	<form method='post' action='add-product.php'>

		<table class='table table-bordered'>

			<tr>
				<td>Name</td>
				<td><input type='text' name='name' class='form-control' required></td>
			</tr>

			<tr>
				<td>Price</td>
				<td><input type='text' name='price' class='form-control' required></td>
			</tr>

			<tr>
				<td>Category</td>
				<td>
					<select class="selectpicker" data-live-search="true">
						<option></option>
						<?php
						$list = $category->getList();
              foreach($list AS $cat) {?>
							<option><?php echo $cat['name']; ?></option>;
							<?php	} ?>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan='2'>
					<button type='submit' class='btn btn-primary' name='btn-save'>
						<span class='glyphicon glyphicon-plus'></span> Create New Category
					</button>
					<a href='admin.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'>
					</i> &nbsp; Back to dashboard</a>
				</td>
			</tr>

		</table>
	</form>
</div>

<?php include_once('footer.php'); ?>

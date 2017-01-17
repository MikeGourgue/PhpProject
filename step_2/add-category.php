<?php
include_once('utility/dbconfig.php');
include_once('header.php');
include_once('class.category.php');

// $category = new Category($dbh);

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
	$category_id = intval($_POST['category_id']);
	if ($name && $parent_id) {
		$query = $category->create($name, $parent_id);
		header('Location: add-category.php?inserted');

	} else {
		$query = 'mismatching passwordz... douche';
		header('Location: add-category.php?failure');
	}
}

?>
<div class='clearfix'></div>

<?php
if(isset($_GET['inserted'])) {
	?>
	<div class='container'>
		<div class='alert alert-info'>
			<strong>WOW!</strong> Category was inserted successfully !
		</div>
	</div>
	<?php
} else if(isset($_GET['failure'])) {
	?>
	<div class='container'>
		<div class='alert alert-warning'>
			<strong>SORRY!</strong> ERROR while inserting category !
		</div>
	</div>
	<?php
}
?>

<div class='clearfix'></div><br />

<div class='container'>
	<h2>Create a new Category</h2>

	<form method='post' action='add-product.php'>

		<table class='table table-bordered'>

			<tr>
				<td>Name</td>
				<td><input type='text' name='name' class='form-control' required></td>
			</tr>

			<tr>
				<td>Parent</td>
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
						<span class='glyphicon glyphicon-plus'></span> Create New Product
					</button>
					<a href='admin.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'>
					</i> &nbsp; Back to dashboard</a>
				</td>
			</tr>

		</table>
	</form>
</div>

<?php include_once('footer.php'); ?>

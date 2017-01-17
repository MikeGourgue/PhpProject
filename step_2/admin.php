<?php include_once('utility/dbconfig.php'); ?>
<?php include_once ('header.php'); ?>

<?php
// var_dump($_SESSION['auth']);
if(!isset($_SESSION['auth'])) {
	echo "POPO";
	if (isset($_COOKIE['auth'])) {
		set_session();
	} else {
		header('Location: login.php');
	}
}
if (json_decode($_SESSION['auth'])->{'admin'} == '0') {
	header('Location: index.php');
	exit;
} else { ?>
	<div class='clearfix'></div>
	<div class='container'>
		<h2>Administration dashboard</h2>
		<div class='clearfix'></div>


		<a href='add-user.php' class='btn btn-large btn-info'><i class='glyphicon glyphicon-plus'></i> &nbsp; Create users</a>
	</div>

	<div class='clearfix'></div><br />

	<div class='container'>
		<table class='table table-bordered table-responsive'>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Is Admin</th>
				<th colspan='2' align='center'>Actions</th>
			</tr>
			<?php
			$query = 'SELECT * FROM users';
			$records_per_page=3;
			$newquery = $user->paging($query,$records_per_page);
			$user->dataview($newquery);
			?>
			<tr>
				<td colspan='7' align='center'>
					<div class='pagination-wrap'>
						<?php $user->paginglink($query,$records_per_page); ?>
					</div>
				</td>
			</tr>

		</table>
	</div>

	<div class='clearfix'></div>

	<div class='container'>
		<a href='add-product.php' class='btn btn-large btn-info'><i class='glyphicon glyphicon-plus'></i> &nbsp; Create product</a>
	</div>

	<div class='clearfix'></div><br />

	<div class='container'>
		<table class='table table-bordered table-responsive'>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Price</th>
				<th>Category</th>
				<th colspan='2' align='center'>Actions</th>
			</tr>
			<?php
			$query = 'SELECT * FROM products';
			$records_per_page=3;
			$newquery = $product->paging($query,$records_per_page);
			$product->adminview($newquery);
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
	<div class='clearfix'></div>

	<div class='container'>
		<a href='add-category.php' class='btn btn-large btn-info'><i class='glyphicon glyphicon-plus'></i> &nbsp; Create category</a>
	</div>

	<div class='clearfix'></div><br />

	<div class='container'>
		<table class='table table-bordered table-responsive'>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Parent</th>
				<th colspan='2' align='center'>Actions</th>
			</tr>
			<?php
			$query = 'SELECT * FROM categories';
			$records_per_page=3;
			$newquery = $category->paging($query,$records_per_page);
			$category->adminview($newquery);
			?>
			<tr>
				<td colspan='7' align='center'>
					<div class='pagination-wrap'>
						<?php $category->paginglink($query,$records_per_page); ?>
					</div>
				</td>
			</tr>

		</table>


	</div>

	<?php include_once('footer.php'); } ?>

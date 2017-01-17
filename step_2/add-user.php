<?php
include_once('utility/dbconfig.php');
include_once('header.php');

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
	$name = test_input($_POST['username']);
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
	(strcmp($_POST['admin'], 'on')) ? $admin = false : $admin = true;
	if (!is_null($email)) {
		$hash = my_password_check_n_hash($_POST['password'], $_POST['verify_password']);
		if ($name && $email && $hash) {
			$query = $user->create($name, $email, $hash, $admin);
			header('Location: add-user.php?inserted');
		} else {
			$query = 'mismatching passwordz... douche';
			header('Location: add-user.php?failure');
		}
	} else {
		$query = 'invalid email, google it for syntax';
		header('Location: add-user.php?failure');
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
			<strong>WOW!</strong> Record was inserted successfully!
		</div>
	</div>
	<?php
}
else if(isset($_GET['failure']))
{
	?>
	<div class='container'>
		<div class='alert alert-warning'>
			<strong>SORRY!</strong> ERROR while inserting record !
		</div>
	</div>
	<?php
}
?>

<div class='clearfix'></div><br />

<div class='container'>

	<h2>Create a new User</h2>
	<form method='post'>

		<table class='table table-bordered'>

			<tr>
				<td>Name</td>
				<td><input type='text' name='username' class='form-control' required></td>
			</tr>

			<tr>
				<td>Email</td>
				<td><input type='email' name='email' class='form-control' required></td>
			</tr>

			<tr>
				<td>Password</td>
				<td><input type='password' name='password' class='form-control' required></td>
			</tr>

			<tr>
				<td>Verify Password</td>
				<td><input type='password' name='verify_password' class='form-control' required></td>
			</tr>
			<tr>
				<td>
					<h5><strong>Is Admin</strong></h5>
				</td>
				<td>
					<input name='admin' data-toggle='toggle' type='checkbox' data-on='Yes' data-off='No'>
				</td>
			</tr>

			<tr>
				<td colspan='2'>
					<button type='submit' class='btn btn-primary' name='btn-save'>
						<span class='glyphicon glyphicon-plus'></span> Create New User
					</button>
					<a href='admin.php' class='btn btn-large btn-success'>
						<i class='glyphicon glyphicon-backward'></i> &nbsp; Back to dashboard</a>
					</td>
				</tr>

			</table>
		</form>


	</div>

	<?php include_once('footer.php'); ?>

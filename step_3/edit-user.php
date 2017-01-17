<?php
include_once('utility/dbconfig.php');
include_once('utility/my_password_utility.php');
include_once('header.php');

// var_dump($_SESSION['auth']);

if(!isset($_SESSION['auth'])) {
	if (isset($_COOKIE['auth'])) {
		set_session();
	}
	if (json_decode($_SESSION['auth'])->{'admin'} == "0") {
		header('Location: index.php');
		exit;
	}
}
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$name = $_POST['username'];
	$email = $_POST['email'];
	$hash = my_password_check_n_hash($_POST['password'], $_POST['password_verify']);
	if (isset($_POST['is_admin'])) {
		$admin = 1;
	} else {
		$admin = 0;
	}

	if($user->update($id,$name,$email,$hash, $admin)) {
		$msg = "<div class='alert alert-info'>
				<strong>WOW!</strong> Record was updated successfully <a href='index.php'>HOME</a>!
				</div>";
	}	else	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($user->getID($id));
}

?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
<h2>Edit selected User</h2>
     <form method='post'>

    <table class='table table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='username' class='form-control' value="<?php echo $username; ?>" required></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' value="<?php echo $email; ?>" required></td>
        </tr>

				<tr>
            <td>Password</td>
            <td><input type='password' name='password' class='form-control' placeholder="password" required></td>
        </tr>
				<tr>
				    <td>Password Verify</td>
		        <td><input type='password' name='password_verify' class='form-control' placeholder="password" required></td>
				</tr>

        <tr>
            <td>Is Admin</td>
            <td><input name='is_admin' data-toggle='toggle' type='checkbox' data-on='Yes' data-off='No'></td>
        </tr>

        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update this User
				</button>
                <a href="admin.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>

    </table>
</form>


</div>

<?php include_once 'footer.php'; ?>

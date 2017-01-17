<?php
include_once("utility/dbconfig.php");

if(isset($_POST['btn-update']))
{
	var_dump($_POST['btn-update']);
	$id = $_GET['edit_id'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$category_id = $_POST['category_id'];

	if($product->update($id,$name,$price,$category_id))
	{
		$msg = "<div class='alert alert-info'>
				<strong>WOW!</strong> Record was updated successfully <a href='index.php'>HOME</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	echo $_GET['edit_id'];
	extract($product->getID($id));
}

?>
<?php include_once 'header.php'; ?>

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
<h2>Update selected products</h2>
     <form method='post'>

    <table class='table table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value="<?php echo $name; ?>" required></td>
        </tr>

        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' value="<?php echo $price; ?>" required></td>
        </tr>

        <tr>
            <td>Category</td>
            <td><input type='text' name='category_id' class='form-control' value="<?php echo $category_id; ?>" required></td>
        </tr>

        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update this product
				</button>
                <a href="admin.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>

    </table>
</form>


</div>

<?php include_once 'footer.php'; ?>

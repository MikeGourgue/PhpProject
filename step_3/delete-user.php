<?php
include_once('utility/dbconfig.php');

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$user->delete($id);
	header('Location: delete-user.php?deleted');
}

?>

<?php include_once 'header.php'; ?>

<div class='clearfix'></div>

<div class='container'>

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class='alert alert-success'>
    	<strong>Success!</strong> record was deleted...
		</div>
        <?php
	}
	else
	{
		?>
        <div class='alert alert-danger'>
    	<strong>Sure !</strong> to remove the following record ?
		</div>
        <?php
	}
	?>
</div>

<div class='clearfix'></div>

<div class='container'>

	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
         <th>#</th>
         <th>Name</th>
         <th>Email</th>
         <th>was admin</th>
         </tr>
         <?php
         $stmt = $dbh->prepare('SELECT * FROM users WHERE id=:id');
         $stmt->execute(array(':id'=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['username']); ?></td>
             <td><?php print($row['email']); ?></td>
         	 	 <td><?php print($row['admin']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class='container'>
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method='post'>
    <input type='hidden' name='id' value="<?php echo $row['id']; ?>" />
    <button class='btn btn-large btn-primary' type='submit' name='btn-del'><i class='glyphicon glyphicon-trash'></i> &nbsp; YES</button>
    <a href='admin.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; NO</a>
    </form>
	<?php
}
else
{
	?>
    <a href='admin.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div>
<?php include_once 'footer.php'; ?>

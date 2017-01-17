<?php
include_once('utility/dbconfig.php');

if(isset($_POST['btn-del']))
{
  $id = $_GET['delete_id'];
  $product->delete($id);
  header('Location: delete-category.php?deleted');
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
      <strong>Success!</strong> Category was deleted...
    </div>
    <?php
  }
  else
  {
    ?>
    <div class='alert alert-danger'>
      <strong>Sure !</strong> to remove the following Category ?
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
        <th>Parent</th>

      </tr>
      <?php
      $stmt = $dbh->prepare('SELECT * FROM categories WHERE id=:id');
      $stmt->execute(array(':id'=>$_GET['delete_id']));
      while($row=$stmt->fetch(PDO::FETCH_BOTH))
      {
        $nested = $dbh->prepare('SELECT name FROM categories WHERE id= :parent');
        $nested->execute(array(':parent' => $row["parent_id"]));
        $parent = $nested->fetch(PDO::FETCH_ASSOC);
        ?>
        <tr>
          <td><?php print($row['id']); ?></td>
          <td><?php print($row['name']); ?></td>
          <td><?php print($parent['name']); ?></td>
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
      <a href='admin.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; Back to dashboard</a>
      <?php
    }
    ?>
  </p>
</div>
<?php include_once 'footer.php'; ?>

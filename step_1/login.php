<?php include_once('utility/dbconfig.php');?>
<?php include_once('utility/my_password_utility.php'); ?>
<?php include_once('class.crud.php'); ?>
<?php include_once('header.php'); ?>

<div class='container'><h1>Welcome to the page</h1></div>
<div class='clearfix'></div><br/>

<?php
if(isset($_POST['email']) && isset($_POST['password'])) {
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
  if (!is_null($email)) {
    $returned = $crud->login(filter_var($email, FILTER_SANITIZE_EMAIL), $_POST['password'], $_POST['remember']);
    if (is_string($returned) && intval($returned) > 0) {
      header('Location: index.php', 302);
    }
  } else {
    $returned = 'no such mail';
  }
}?>


<div class='container'>
  <div class='row'>
    <div class='col-sm-10'>


      <form method='post'>
        <table class='table table-bordered'>

          <tr>
            <td><h5>Email</h5></td>
            <td><div class='col-sm-6'>
              <input type='email' name='email' class='form-control' id='mail_input'
              placeholder='Your mail, so we can sell it' onclick='error_popov('42')'  required>
            </div><?php if (isset($returned) && $returned == 'no such mail') {?>

              <h5>
                <?php echo $returned; }?>
              </h5>

            </td>
          </tr>

          <tr>
            <td><h5>Password</h5></td>
            <td><div class='col-sm-6'>
              <input type='password' name='password' class='form-control'
              id='pass_input' onload='error_popov()' required>
            </div><?php if (isset($returned) && $returned == 'wrong password') {?>
              <h5>
                <?php echo $returned; }?>
              </h5></td>
            </tr>

            <tr>
              <td>

                <h5><strong>Remember me</strong></h5>
              </td>
              <td>
                <link href='https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css' rel='stylesheet'>
                <script src='https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js'></script>
                <!-- <input checked data-toggle="toggle" data-onstyle="success" type="checkbox"> -->
                <input data-toggle="toggle" data-on="Yes i do!" data-off="No thank's!"
                type="checkbox" data-onstyle="success" data-offstyle="danger">
              </td>
            </tr>

            <tr>
              <td colspan='2'>
                <button type='submit' class='btn btn-primary' name='btn-login'>
                  <span class='glyphicon glyphicon-log-in'></span>  Login <strong></strong>
                </button>
                <a href='inscription.php' class='btn btn-large btn-success'>
                  <i class='glyphicon glyphicon-plus'></i> &nbsp; <strong>Join us</strong></a>
                </td>
              </tr>

            </table>
          </form>
        </div>
      </div>
    </div>
    <?php include_once('footer.php'); ?>

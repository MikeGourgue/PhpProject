<?php include_once('utility/dbconfig.php');?>
<?php include_once('header.php'); ?>
<?php include_once('utility/my_password_utility.php'); ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = test_input($_POST['username']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
  if (!is_null($email)) {
    $hash = my_password_check_n_hash($_POST['password'], $_POST['verify_password']);
    if ($name && $email && $hash) {
      $query = $user->create($name, $email, $hash);
    } else {
      $query = 'mismatching passwordz... douche';
    }
  } else {
    $query = 'invalid email, google it for syntax';
  }
}

?>

<div class='container'><h1>Please fill in to suscribe</h1></div>
<div class='clearfix'></div><br/>

<div class='container'>
  <div class='row'>
    <div class='col-sm-10'>
      <form method='post'>

        <table class='table table-bordered'>
          <tr>
            <td><h5>First Name</h5></td>
            <td>
              <div class='col-sm-6'>
                <input type='text' name='username' class='form-control' placeholder='Your wicked username' required>
              </div>
            </td>
          </tr>

          <tr>
            <td><h5>Email</h5></td>
            <td>
              <div class='col-sm-6'>
                <input type='email' name='email' class='form-control' placeholder='Your mail, so we cann sell it' required>
                <?php if (isset($query) && $query == 'invalid email, google it for syntax') {?>
                  <h5>
                    <?php echo $query; }?>
                  </h5>
                </div>
              </td>
            </tr>

            <tr>
              <td><h5>Password</h5></td>
              <td>
                <div class='col-sm-6'>
                  <input type='password' name='password' class='form-control' required>
                  <?php if (isset($query) && $query == 'mismatching passwordz... douche') {?>
                    <h5>
                      <?php echo $query; }?>
                    </h5>
                  </div>
                </td>
              </tr>

              <tr>
                <td><h5>Verify password</h5></td>
                <td>
                  <div class='col-sm-6'>
                    <input type='password' name='verify_password' class='form-control' required>
                  </div>
                </td>
              </tr>
            </div>

            <tr>
              <td colspan='2'>
                <button type='submit' class='btn btn-primary' name='btn-update'>
                  <span class='glyphicon glyphicon-ok'></span>  Create User
                </button>
                <a href='index.php' class='btn btn-large btn-success'><i class='glyphicon glyphicon-backward'></i> &nbsp; CANCEL</a>
                <h5>
                  <?php if (isset($query) && (($query == 'user sucressfully create!') || ($query == 'you screwed somewhere'))) {
                  echo $query;} ?>
                </h5>
              </td>
            </tr>

          </table>
        </form>
      </div>
    </div>
    <?php include_once 'footer.php'; ?>

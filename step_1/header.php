<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>


  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Winner FTW, Inc</title>
  <script src='jQuery/js/jquery-3.1.1.min.js'></script>
  <link href='bootstrap/css/bootstrap.min.css' rel='stylesheet' media='screen'>
  <script src='bootstrap/js/bootstrap.min.js'></script>

</head>
<body>
  <header>
    <div class='container navbar navbar-default navbar-static-top' role='navigation'>
      <ul class='nav navbar-nav navbar-right'>
        <?php if(isset($_SESSION['auth'])) { ?>
          <li class='dropdown'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'
            aria-haspopup='true' aria-expanded='false'>
            <i class='glyphicon glyphicon-user'></i> &nbsp;MENU<span class='caret'></span></a>
            <ul class='dropdown-menu'>
              <li><a href='index.php'>Home</a></li>
              <li role='separator' class='divider'></li>
              <li><a href='logout.php'>Logout</a></li>
            </ul>
          </li>
          <?php    } else { ?>
            <li class='dropdown'>
              <a href='login.php' class='dropdown-toggle' data-toggle='dropdown' role='button'
              aria-haspopup='true' aria-expanded='false'>
              <i class='glyphicon glyphicon-user'></i> &nbsp; <strong>Register</strong></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </header>

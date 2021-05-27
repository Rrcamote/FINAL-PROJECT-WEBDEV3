<?php
include("functions.php");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AMS</title>
  <link rel="stylesheet" href="./style.css">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>
<body class="hold-transition login-page">

<div class="panel_blur"></div>
        <div class="panel">
        <div class="panel__form-wrapper">
            <ul class="panel__headers">
                <li class="panel__header active"><i class="fas fa-user"></i>Admin</li>
            </ul>
            <div class="panel__forms">
      <form method="POST">
      <div class="form__row">
                        <input type="text" class="form__input" name="log_username">
                        <label for="username" class="form__label"><span class="fas fa-user-lock"></span> Username</label>
                    </div>
                    <div class="form__row">
                        <input type="password" class="form__input" name="log_password">
                        <label for="password" class="form__label"><span class="fas fa-user-lock"></span>  Password</label>
                        <span class="form__error"></span>
                    </div>
                    <div class="form__row">
                    <input  type="submit" class="form__submit" name="Sign_in" value="Login">
                        <a style="color: white;" href="./login.php" class="form__retrieve-pass" role="button">Cancel</a>
                    </div>
        <!-- <div class="input-group mb-3">
          <input type="text" name="log_username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="log_password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-lock"></span>
            </div>
          </div>
        </div>

        <div align="right">
          <button type="submit" class="btn btn-primary btn-flat" name="Sign_in"><i class="fas fa-sign-in-alt"></i> Sign In</button>
        </div> -->

      </form>
    </div>

  </div>
</div>
<br><br><br><br><br><br>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>



<script type="text/javascript">
var interval = setInterval(function() {
   var momentNow = moment();
   $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
   $('#time').html(momentNow.format('hh:mm:ss A'));
 }, 100);
</script>


</body>
</html>

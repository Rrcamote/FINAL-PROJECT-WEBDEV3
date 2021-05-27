<?php 

if(isset($_POST['attendace'])){
  
}

?>
<?php
include("../admin/functions.php");
ini_set('display_errors', 0);
ini_set('display_errors', false);

date_default_timezone_set('Asia/Manila');
$time = date("h:i:s");
$today = date("D - F d, Y");
$date = date("Y-m-d");
$in = date("H:i:s");
$out = "12:00:00";

if(isset($_POST['attendance']))
{
  $_SESSION['expire'] =  date("H:i:s", time() + 1);
  $code = $_POST['operation'];
  if($code == "time-in")
  {
    $id = $_POST['emp_id'];
    $sql = "SELECT * FROM emp_list WHERE emp_card = '$id'";
    $result = mysqli_query($db, $sql);
    if(!$row = $result->fetch_assoc()) {
      $_SESSION['mess'] = "<div id='time' class='alert alert-danger' role='alert'>
                              <i class='fas fa-times'></i>  Employee ID is not registered !
                              </div>";
      header("Location: index.php");
    }
    else {
      $sql2 = "SELECT * FROM emp_attendance WHERE employee_id = '$id' AND attendance_date = '$date'";
      $result2 = mysqli_query($db, $sql2);
      if(!$row2 = $result2->fetch_assoc()) {
        $fname = $row['emp_fname'];
        $lname = $row['emp_lname'];
        $full = $lname . ', ' . $fname;
        $card = $row['emp_card'];

        $first = new DateTime($in);
        $second = new DateTime($out);
        $interval = $first->diff($second);
        $hrs = $interval->format('%h');
        $mins = $interval->format('%i');
        $mins = $mins/60;
        $int = $hrs + $mins;
        if($int > 4){
          $int = $int - 1;
        }

        $sql3 = "INSERT INTO emp_attendance (employee_id, employee_name, attendance_date, attendance_timein, attendance_timeout, attendance_hour)
                                     VALUES ('$id', '$full', '$date', '$in', '$out', '$int')";
        $result3 = mysqli_query($db, $sql3);
        $_SESSION['mess'] = "<div id='time' class='alert alert-success' role='alert'>
                              <i class='fas fa-check'></i>  Time in: $full
                             </div>";
        header("Location: index.php");
      }
      else {
        $_SESSION['mess'] = "<div id='time' class='alert alert-warning' role='alert'>
                                <i class='fas fa-exclamation'></i>  You already have Timed In
                                </div>";

        header("Location: index.php");
      }
    }
  }

  if($code == "time-out")
  {
    $id = $_POST['emp_id'];

    $sql = "SELECT * FROM emp_attendance WHERE employee_id = '$id' AND attendance_date = '$date'";
    $result = mysqli_query($db, $sql);
    if(!$row = $result->fetch_assoc()) {
      $_SESSION['mess'] = "<div id='time' class='alert alert-danger' role='alert'>
                              <i class='fas fa-times'></i>  You did not Timed in !
                              </div>";
      header("Location: index.php");
    }
    else {
      $query = "SELECT * FROM emp_attendance WHERE employee_id = '$id' AND attendance_date = '$date'";
      $queryres = mysqli_query($db, $query);
      while($rowres = mysqli_fetch_array($queryres))
      {
        $timein = $row['attendance_timein'];
      }
      $first = new DateTime($timein);
      $second = new DateTime($in);
      $interval = $first->diff($second);
      $hrs = $interval->format('%h');
      $mins = $interval->format('%i');
      $mins = $mins/60;
      $int = $hrs + $mins;
      if($int > 4){
        $int = $int - 1;
      }

      $sql2 = "UPDATE emp_attendance SET attendance_timeout = '$in', attendance_hour = '$int' WHERE employee_id = '$id' AND attendance_date = '$date'";
      $result2 = mysqli_query($db, $sql2);
      $_SESSION['mess'] = "<div id='time' class='alert alert-success' role='alert'>
                            <i class='fas fa-check'></i>  Timed Out
                           </div>";
      header("Location: index.php");
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AMS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="admin/dist/js/1.js"></script>
    <script src="admin/dist/js/2.js"></script>
    <script src="admin/dist/js/3.js"></script>
    <style>
    .login-page {

        background-image: url('data:image/jpeg;base64,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');
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
</head>
<nav class="navbar bg-white">
    <h2 class="text-center text-dark">EMPLOYEE ATTENDANCE</h2>
</nav>
<body class="login-page">
<div class="float-left">
<img src="https://i.ibb.co/1L7M3jh/removal-ai-tmp-60aa3f09d621e.png" alt="">
</div>
    <div class="login-box bg-info">
        <div class="login-logo">
            <p id="date"><?php echo $today; ?></p>
            <p id="time" class="bold"><?php echo $time; ?></p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body bg-dark">
                <p class="login-box-msg">EMPLOYEE REGISTER</p>
                <form method="POST">
                    <div class="input-group mb-3">
                        <select name="operation" class="form-control">
                            <option value="time-in">Time In</option>
                            <option value="time-out">Time Out</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="emp_id" class="form-control" placeholder="Employee ID">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="attendance">SUBMIT</button>
                </form>
            </div>
  
            <?php
    echo $_SESSION['mess'];
    echo $_SESSION['success'];

    $dd = date("H:i:s");

    if($dd == $_SESSION['expire'])
    {
      session_unset();
    }
    ?>

        </div>
    </div>
    <br><br>

    <script src="../admin/plugins/jquery/jquery.min.js"></script>
    <script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/dist/js/adminlte.min.js"></script>
    <script src="../admin/plugins/moment/moment.min.js"></script>
    <script src="../admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="../admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../admin/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../admin/plugins/toastr/toastr.min.js"></script>


    <script type="text/javascript">
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date').html(momentNow.format('dddd').substring(0, 3).toUpperCase() + ' - ' + momentNow.format(
            'MMMM DD, YYYY'));
        $('#time').html(momentNow.format('hh:mm:ss A'));
    }, 100);
    </script>
</body>

</html>
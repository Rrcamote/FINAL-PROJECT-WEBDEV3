<?php
include "Database/config.php";

date_default_timezone_set('Asia/Manila');

//admin sign in
if (isset($_POST['Sign_in'])) {
    $username = mysqli_real_escape_string($db, $_POST['log_username']);
    $password = mysqli_real_escape_string($db, $_POST['log_password']);

    $sql = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $sql);

    if (!$row = $result->fetch_assoc()) {
          echo '<div><h4>Incorect username/password</h4></div>';

        //   echo '<script>alert("Successfull Login");</script>';
        //  echo '<script>window.location.href="home.php";</script>';

    } else {
        echo '<script>alert("Login Successfully");</script>';
        echo '<script>window.location.href="home.php";</script>';
        $_SESSION['name'] = $row['name'];

    }
}

//admin logout
if (isset($_POST['logout'])) {
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header("Location: index.php");
    exit;
}

//add employee
if (isset($_POST['add_employee'])) {

    $tag = $_POST['emp_tag'];
    $fname = $_POST['emp_name'];
    $lname = $_POST['emp_lastname'];
    $address = $_POST['emp_address'];
    $sched = $_POST['emp_schedule'];
    $scheduleID = $_POST['emp_scheduleId'];
    $salary = $_POST['emp_salary'];
    $regdate = date("Y-m-d");

    $sql = "SELECT sched_in, sched_out FROM emp_sched WHERE sched_id = '$sched'";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $in = $row['sched_in'];
        $out = $row['sched_out'];
    }

    $query = "INSERT INTO emp_list (emp_card, emp_fname, emp_lname, emp_address, emp_salary,emp_timein, emp_timeout, sched_id, emp_regdate)
                          VALUES ('$tag', '$fname', '$lname', '$address','$salary', '$in', '$out', '$scheduleID', '$regdate')";
    $resquery = mysqli_query($db, $query);

    
    $sql3 = "SELECT employee_id,employee_name,COUNT(employee_id) as totaldays FROM emp_attendance GROUP BY employee_id,employee_name HAVING COUNT(employee_id) >= 1";
    $result3 = mysqli_query($db, $sql3);
    while ($row = mysqli_fetch_array($result3)) {
        $totalDays = $row['totaldays'];
    }
    $sql = "INSERT INTO emp_salary (salary_id,total_days,per_month)
    VALUES ('$tag','$totalDays','$salary')";
    $query = mysqli_query($db, $sql);

    echo '<script>
    setTimeout(function() {
        Swal.fire({
            title: "Success !",
            text: "New Employee has been ADded!",
            type: "success"
          }).then(function() {
              window.location = "employee_list.php";
          });
    }, 30);
</script>';

}
//add schedule
if (isset($_POST['add_sched'])) {

    $in = $_POST['sched_timein'];
    $out = $_POST['sched_timeout'];
    $emp_id = $_POST['sched_id'];

    $in_24 = date("H:i", strtotime($in));
    $out_24 = date("H:i", strtotime($out));

    $chkquery = "SELECT * FROM emp_sched WHERE sched_in = '$in_24' AND sched_out = '$out_24'";
    $chkresult = mysqli_query($db, $chkquery);

    if (!$row = $chkresult->fetch_assoc()) {
        $sql = "INSERT INTO emp_sched (sched_id,sched_in, sched_out) VALUES ('$emp_id','$in_24', '$out_24')";
        $result = mysqli_query($db, $sql);

        $_SESSION['success'] = "New Schedule has been added ! ";
        $_SESSION['expire'] = date("H:i:s", time() + 1);

    } else {
        $_SESSION['error'] = "Failed to add new schedule ! ";
        $_SESSION['expire'] = date("H:i:s", time() + 1);
    }
    header('location: employee_sched.php');

}

//edit employee
if (isset($_POST["emp_edit_id"])) {
    $output = '';
    $sql = "SELECT * FROM emp_list WHERE emp_id = '" . $_POST["emp_edit_id"] . "'";
    $result = mysqli_query($db, $sql);
    $output .= '
    <form method="POST">';
    while ($row = mysqli_fetch_array($result)) {
        $card = $row["emp_id"];
        $emp = $row['emp_card'];
        $fname = $row['emp_fname'];
        $lname = $row['emp_lname'];
        $address = $row['emp_address'];

        $output .= '
              <input type="text" name="id" class="form-control" value="' . $card . '" hidden>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"></label>
                <label class="col-sm-3 col-form-label">Employee ID</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="emp_card" value="' . $emp . '" placeholder="" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"></label>
                <label class="col-sm-3 col-form-label">Firstname</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="update_fname" value="' . $fname . '" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"></label>
                <label class="col-sm-3 col-form-label">Lastname</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="update_lname" value="' . $lname . '" placeholder="">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"></label>
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="update_address" value="' . $address . '" placeholder="">
                </div>
              </div>

              </div>
              ';
    }
    $output .= "</form>";
    echo $output;

}
//update employee
if (isset($_POST["emp_update"])) {
    $card = $_POST["id"];
    $fname = $_POST['update_fname'];
    $lname = $_POST['update_lname'];
    $address = $_POST['update_address'];

    $sql = "UPDATE emp_list SET emp_fname = '" . $fname . "', emp_lname = '" . $lname . "', emp_address = '" . $address . "'
   WHERE emp_id = '" . $card . "'";
    $result = mysqli_query($db, $sql);

    echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Success !",
                    text: "Employee Information has been updated !",
                    type: "success"
                  }).then(function() {
                      window.location = "employee_list.php";
                  });
            }, 30);
        </script>';
}

if (isset($_POST["emp_del_id"])) {
    $output = '';
    $sql = "SELECT * FROM emp_list WHERE emp_id = '" . $_POST["emp_del_id"] . "'";
    $result = mysqli_query($db, $sql);
    $output .= '
    <form method="POST">';
    while ($row = mysqli_fetch_array($result)) {
        $id = $row["emp_id"];

        $output .= '
              <input type="text" name="del_id" class="form-control" value="' . $id . '" hidden>
              <div class="text-center">
	                	<p>DELETE EMPLOYEE</p>
	                	<h2>' . $row['emp_fname'] . ' ' . ' ' . $row['emp_lname'] . '</h2>
	            </div>
              ';
    }
    $output .= "</form>";
    echo $output;

}
//delete employee
if (isset($_POST["emp_delete"])) {
    $id = $_POST['del_id'];

    $sql = "DELETE FROM emp_list WHERE emp_id = '$id'";
    $result = mysqli_query($db, $sql);
    $sql1 = "DELETE FROM emp_salary WHERE salary_id = '$id'";
    $result1 = mysqli_query($db,$sql1);
    $sql2 = "DELETE FROM emp_sched WHERE sched_id = '$id'";
    $result2 = mysqli_query($db,$sql2);
    $sql3 = "DELETE FROM emp_attendance WHERE  employee_id = '$id'";
    $result3 = mysqli_query($db,$sql3);
    echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Success !",
                    text: "Employee has been Deleted !",
                    type: "success"
                  }).then(function() {
                      window.location = "employee_list.php";
                  });
            }, 30);
        </script>';
}

if (isset($_POST["sched_id"])) {
    $output = '';
    $sql = "SELECT * FROM emp_sched WHERE sched_id = '" . $_POST["sched_id"] . "'";
    $result = mysqli_query($db, $sql);
    $output .= '
    <form method="POST">';
    while ($row = mysqli_fetch_array($result)) {
        $id = $row["sched_id"];

        $output .= '
              <input type="text" name="del_id" class="form-control" value="' . $id . '" hidden>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"></label>
                <label class="col-sm-3 col-form-label">Time in</label>
                <div class="col-sm-7">
                  <div class="bootstrap-timepicker">
                    <div class="input-group date" id="thirdpicker" data-target-input="nearest">
                      <input type="time" value="' . $row['sched_in'] . '" name="sched_update_in" class="form-control datetimepicker-input" data-target="#timepicker" data-toggle="datetimepicker" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label"></label>
                <label class="col-sm-3 col-form-label">Time out</label>
                <div class="col-sm-7">
                  <div class="bootstrap-timepicker">
                    <div class="input-group date" id="fourthpicker" data-target-input="nearest">
                      <input type="time" value="' . $row['sched_out'] . '" name="sched_update_out" class="form-control datetimepicker-input" data-target="#secondpicker" data-toggle="datetimepicker" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
              ';
    }
    $output .= "</form>";
    echo $output;

}

if (isset($_POST["edit_sched"])) {
    $id = $_POST['del_id'];
    $in = $_POST['sched_update_in'];
    $out = $_POST['sched_update_out'];

    $sql = "UPDATE emp_sched SET sched_in = '$in', sched_out = '$out' WHERE sched_id = '$id'";
    $result = mysqli_query($db, $sql);

    echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Success !",
                    text: "Schedule has been updated !",
                    type: "success"
                  }).then(function() {
                      window.location = "employee_sched.php";
                  });
            }, 30);
        </script>';
}

if (isset($_POST["delsched_id"])) {
    $output = '';
    $sql = "SELECT * FROM emp_sched WHERE sched_id = '" . $_POST["delsched_id"] . "'";
    $result = mysqli_query($db, $sql);
    $output .= '
    <form method="POST">';
    while ($row = mysqli_fetch_array($result)) {
        $id = $row["sched_id"];

        $output .= '
              <input type="text" name="del_id" class="form-control" value="' . $id . '" hidden>
              <div class="text-center">
	                	<p>DELETE SCHEDULE</p>
	                	<h2>' . $row['sched_in'] . ' ' . '-' . ' ' . $row['sched_out'] . '</h2>
	            </div>
              ';
    }
    $output .= "</form>";
    echo $output;

}

if (isset($_POST["delete_sched"])) {
    $id = $_POST['del_id'];

    $sql = "DELETE FROM emp_sched WHERE sched_id = '$id'";
    $result = mysqli_query($db, $sql);

    echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Success !",
                    text: "Schedule has been Deleted !",
                    type: "success"
                  }).then(function() {
                      window.location = "employee_sched.php";
                  });
            }, 30);
        </script>';
}

// if(isset($_POST['apply_date']))
// {
//   $_SESSION['start_month'] = $_POST['startmonth'];
//   $_SESSION['end_month'] = $_POST['endmonth'];

//   header('location: print_payroll.php');
// }

// empoyee login and time out
if (isset($_POST["change_id"])) {
    $output = '';
    $sql = "SELECT * FROM emp_sched";
    $result = mysqli_query($db, $sql);
    $output .= '
    <form method="POST">
    <br>
    <input type="text" name="change_sched_id" class="form-control" value="' . $_POST['change_id'] . '" hidden>
    <div class="form-group row">
      <label class="col-sm-1 col-form-label"></label>
      <label class="col-sm-3 col-form-label">Schedule</label>
      <div class="col-sm-7">
        <select class="form-control" name="new_sched">
    ';
    while ($row = mysqli_fetch_array($result)) {
        $hold = $_POST['change_id'];
        $output .= '

                  <option value=' . $row['sched_id'] . '>' . $row['sched_in'] . ' - ' . $row['sched_out'] . '</option>

              ';
    }
    $output .= "
    </div>
    </div>
    </form>";
    echo $output;

}

if (isset($_POST["change"])) {
    $id = $_POST['change_sched_id'];
    $new = $_POST['new_sched'];

    $sql = "UPDATE emp_list SET sched_id = '$new' WHERE emp_id = '$id'";
    $result = mysqli_query($db, $sql);

    echo '<script>
            setTimeout(function() {
                Swal.fire({
                    title: "Success !",
                    text: "Schedule information has been updated !",
                    type: "success"
                  }).then(function() {
                      window.location = "print_sched.php";
                  });
            }, 30);
        </script>';
}

if (isset($_POST['new_payslip'])) {
    $_SESSION['card'] = $_POST['new_payslip'];
    header("location: print_payslip.php");
}

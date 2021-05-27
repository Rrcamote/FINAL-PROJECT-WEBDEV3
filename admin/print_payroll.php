<?php
include("functions.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AMS</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <nav class="main-header navbar navbar-expand navbar-dark pb-4 pt-4 navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">

                </div>
            </form>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                        <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"
                            style="max-height: 150px; overflow:hidden; background:darkslategrey;">
                            <div class="image">
                                <img src="img/tony.jpg" style="border-radius: 50%;width: 100x;height: 100px;"
                                    alt="User Image">
                            </div>
                        </span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">Settings</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST">
                            <button type="submit" name="logout" class="dropdown-item dropdown-footer">Logout</a>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>



        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: grey;">
            <a href="home.php" class="brand-link pb-2">
                <br>
                <img src="img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AMS PROJECT</span>
            </a>
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="img/tony.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['name']; ?></a>
                    </div>
                </div>


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-legacy nav-compact"
                        data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">REPORTS</li>
                        <li class="nav-item">
                            <a href="home.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MANAGE</li>
                        <li class="nav-item">
                            <a href="employee_attendance.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Attendance
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Employees
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="employee_list.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Employee List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="employee_sched.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Set Schedules</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">CASH</li>
                        <li class="nav-item">
                            <a href="print_payroll.php" class="nav-link active">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>Payroll</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="print_sched.php" class="nav-link">
                                <i class="nav-icon far fa-clock"></i>
                                <p>Schedules</p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper" style="background-color: #134b5f">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-warning">PAYROLL</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Payroll</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered dataTable no-footer" role="grid"
                                    aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Employee Position</th>
                                            <th>Salary per Month</th>
                                            <th>Work Days</th>
                                            <th>Salary per Day</th>
                                            <th>Total Salary</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                $sql = "SELECT * FROM emp_salary,emp_list WHERE emp_salary.salary_id = emp_list.emp_card";
                $result = mysqli_query($db, $sql);
                while($row = mysqli_fetch_array($result))
                {
                  $totalDays = $row['total_days'];  
                  $perMonth = $row['per_month'];
                  $perDay = 0;
                  $type = "";
                  
                  if($perMonth == 20000){
                      $type = "Senior Developer";
                      $perDay = 909.10;
                      $totalsalary =  $perDay * $totalDays;
                      if($totalDays == 11){
                          $totalsalary = 10000;
                      }
                  }else if($perMonth == 15000){
                    $type = "Junior Developer";
                      $perDay = 681.82;
                      $totalsalary =  $perDay * $totalDays;
                  }
                ?>
                                        <tr class="text-center">
                                            <td><?php echo $row['emp_fname']; ?> <?php echo $row['emp_lname']; ?></td>
                                            <td><?php echo "$type"?></td>                                      
                                            <td><?php echo "₱ $perMonth"?></td>
                                            <td><?php echo $row['total_days']; ?></td>
                                            <td><?php echo  "₱ $perDay" ?></td>
                                            <td><?php echo  "₱ $totalsalary" ?></td>
                                        </tr>
                                        <?php
                }
                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>

    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

    <script src="plugins/moment/moment.min.js"></script>

    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

    <script src="plugins/daterangepicker/daterangepicker.js"></script>

    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script>
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d'
    });
    </script>
    <script>
    $(function() {
        $('#example1').DataTable({
            "lengthMenu": [
                [15, 30, -1],
                [15, 30, "All"]
            ],
            "searching": false,
        });
    });
    </script>
</body>

</html>
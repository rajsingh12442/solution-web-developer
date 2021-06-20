<?php
require_once "config.php";
session_start();
if (isset($_SESSION["name"])) {
  $username = $_SESSION["name"];
} else {
  echo "<script>location.href='index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?php echo TITLE; ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" rel="stylesheet" />


</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
     <img class="nav-profile-img mr-2" alt="" src="assets/images/faces/face1.jpg" />-->
      <span class="profile-name">
        <div class="logo"><a href="dashboard.php" class="simple-text logo-normal">
            <?php
            $sql = "SELECT * FROM admin_login";
            $result = mysqli_query($db, $sql) or die("Query Failed.");
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo $row['name']; ?>
      </span>
  <?php }
            }
  ?>
  </a>
    </div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item <?php if (PAGE == 'dashboard') {
                              echo 'active';
                            } ?>">
          <a class="nav-link" href="dashboard.php">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item <?php if (PAGE == 'report') {
                              echo 'active';
                            } ?>">
          <a class="nav-link" href="report.php">
            <i class="material-icons">Report</i>
            <p>Report</p>
          </a>
        </li>
        <li class="nav-item <?php if (PAGE == 'logout') {
                              echo 'active';
                            } ?>">
          <a class="nav-link" href="logout.php">
            <i class="material-icons">logout</i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
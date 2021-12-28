<?php session_start();
include('projectclass/saloonmanagementclass.php');
if (!isset($_SESSION['email'])) {

  header("Location: http://localhost/pro20/adminlogin.php?msg=Kindly Log in to continue.");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Prosper Ibe">
    <title>Admin DashBoard</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link type='text/css' rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img src="images/logoheader.png" height="50px" height="50px"></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#"></a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admindb.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item" id="show">
            <a class="nav-link" href="admindb.php" class="btn btn-sm btn-primary">
              <span data-feather="file"></span>
              Back
            </a>
          </li>
        </ul>
       
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="alert alert-success" role="alert">
          <?php 
            echo " You are logged in with ".$_SESSION['email'].".";

          ?>
          </div>
          <div class="btn-toolbar mb-2 mb-md-0">
          <a href="" class="btn btn-sm btn-outline-primary">
            <span data-feather="calendar"></span>
            This week
          </a>
        </div>
      </div>
        <h4>Admin Dashboard</h4>
        <div class="row">
        <hr>
      <div class="table-responsive" id="bookings">
        <h4 align="center">Users</h4>
        <hr>
        <table class="table table-striped table-hover table-dark table-sm" id="myTable">
          <thead>
            <tr>
              <th scope="col">Customer ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Tel</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // instantiating class
            $objUsers = new SaloonManagement;

            $viewUsers = $objUsers->adminViewCustomer();
              // echo "<pre>";
              // print_r($viewUsers);
              // echo "</pre>";
              foreach ($viewUsers as $key => $value) {
           ?> 
           <tr>
            <td><?php echo $value['customer_id']?></td>
            <td><?php echo $value['customer_name']?></td>
            <td><?php echo $value['customer_email']?></td>
            <td><?php echo $value['customer_tel']?></td>
            <td>
              <?php 
                if ($value['account_status'] == 'active') {
              ?>
              <button class="btn btn-sm btn-success">Active</button>
              <?php 
            }else{
              ?>
            <button class="btn btn-sm btn-warning">Inactive</button>
          <?php } ?>
            </td>
            <td>
              <a href='#' class='btn btn-sm btn-link'><i class='fa fa-list'></i>&nbsp; Analytics</a>
            </td>
          </tr>
          <?php } ?>
          </tbody>
      </div>
    </main>
  </div>
</div>

<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="css/dashboard.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<script type="text/javascript">

      // $(document).ready(function(){

      //   $('#forms').hide();
      //   $('#show').click(function(){
      //     $('#serviceprovider').hide();
      //     $('#forms').show();
      //   });
      // });
</script>
</body>
</html>

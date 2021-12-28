<?php 
session_start();
include('projectclass/saloonmanagementclass.php');
// checking that the user is logged in with email;

if (empty($_SESSION['email'])) {

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
    <link rel="stylesheet" href="bootstrap/css/animate.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

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
      <a class="nav-link px-3" href="adminlogout.php">Sign out</a>
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
          <li class="nav-item">
            <a class="nav-link" id="book" style="cursor:pointer">
              <span data-feather="file"></span>
              Bookings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="service" style="cursor:pointer">
              <span data-feather="shopping-cart"></span>
              Services
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- card start -->
          <div class="alert alert-success" role="alert">
            <?php 
                 echo " You are logged in with ".$_SESSION['email'].".";
              ?>
          </div>
        <!-- card stop -->
        <!-- <h1 class="h2">Service-Provider DashBoard</h1> -->
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a class="btn btn-sm btn-primary">Share</a>&nbsp
            <a class="btn btn-sm btn-primary">Export</a>
          </div>
          <a href="#" class="btn btn-sm btn-outline-primary">
            <span data-feather="bell"></span>
            Email
          </a>
        </div>
      </div>
      <h4>Service Provider Details</h4>
      <hr>
<!--  -->
      <div class="row">
           <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa fa-comment" style='font-size:24px'></i>
                </div>
                <?php 
                  $_SESSION['saloon'] = $_GET['saloonid'];

                  // instantiating class
                  $objOne = new SaloonManagement;

                  // instantiating method
                  $outOne = $objOne->viewTotalBookings($_SESSION['saloon']);
                  if (!empty($outOne)) {
                    // echo "<pre>";
                    // print_r($outOne);
                    // echo "</pre>";
                    foreach ($outOne as $key => $value) {
                      foreach ($value as $key => $val) {
                        print_r($val);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Active Bookings.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa fa-users"></i>
                </div>
                <?php 
                  // instantiating class
                  $objTwo = new SaloonManagement;

                  // instantiating method
                  $outTwo = $objTwo->viewConfirmedBookings($_SESSION['saloon']);
                  if (!empty($outTwo)) {
                    foreach ($outTwo as $key => $value) {
                      foreach ($value as $key => $vals) {
                        print_r($vals);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Delivered Bookings</div>
             
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-warning o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa  fa-list"></i>
                </div>
                <?php 
                  // instantiating class
                  $objThird = new SaloonManagement;

                  // instantiating method
                  $outThird = $objThird->viewPendingBookings($_SESSION['saloon']);
                  if (!empty($outThird)) {
                    foreach ($outThird as $key => $value) {
                      foreach ($value as $key => $one) {
                        print_r($one);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Pending Bookings</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <!-- jasdfghjkl -->
          <!-- xcvgbhjkl -->
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-info o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa  fa-shopping-cart"></i>
                </div>
                  <?php 
                    // instantiating class
                    $objFourth = new SaloonManagement;

                    // instantiating method
                    $outFourth = $objFourth->ViewNoOfferS($_SESSION['saloon']);
                    if (!empty($outFourth)) {
                      foreach ($outFourth as $key => $value) {
                        foreach ($value as $key => $four) {
                          print_r($four);
                        }
                      }
                    }
                  ?>
                <div class="mr-5">Offered Service</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-info o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa  fa-money"></i>
                </div>
                <?php 
                  // instantiating class
                  $objDailyRev = new SaloonManagement;

                  // instantiating method
                  $outDailyRev = $objDailyRev->viewDailyRev($_SESSION['saloon']);
                  if (!empty($outDailyRev)) {
                    foreach ($outDailyRev as $key => $value) {
                      foreach ($value as $key => $daily) {
                        print_r($daily);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Total Daily Income</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-primary o-hidden h-100" style="--bs-bg-opacity: .5;">
              <div class="card-body">
                <div>
                  <i class="fa  fa-dollar"></i>
                </div>
                <?php 
                  // instantiating class
                  $objcashPay = new SaloonManagement;

                  // instantiating method
                  $outCashPay = $objcashPay->viewCashRev($_SESSION['saloon']);
                  if (!empty($outCashPay)) {
                    foreach ($outCashPay as $key => $value) {
                      foreach ($value as $key => $cash) {
                        print_r($cash);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Total Cash Payment</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
      </div>
      <hr>
      <div class="table-responsive" id="bookings">
        <h4 align="center">Booking Details</h4>
        <hr>
        <table class="table table-striped table-sm table-dark">
          <thead>
            <tr>
             <th scope="col">Booking ID</th>
              <th scope="col">Service Type</th>
              <th scope="col">Customer Email</th>
              <th scope="col">Booking Time</th>
              <th scope="col">Booking Date</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // instantiating class
              $objTotal = new SaloonManagement;

              // instantiating method
              $outTotal = $objTotal->viewBookings($_SESSION['saloon']);
              // echo "<pre>";
              // print_r($outTotal);
              // echo "</pre>";
              foreach ($outTotal as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value['booking_id']?></td>
              <td><?php echo $value['service_type']?></td>
              <td><?php echo $value['customer_email']?></td>
              <td><?php echo date('h:i:s a', strtotime($value['booking_time']))?></td>
              <td><?php echo date('d-m-Y', strtotime($value['booking_date']))?></td>
              <td>
                <?php 
                  if ($value['booking_status'] == 'pending') {
                ?>
                <button class="btn btn-sm btn-warning">Pending</button>
                <?php 
                  }else{
                ?>
                <button class="btn btn-sm btn-success">Confirmed</button>
              <?php } ?>
              </td>
            <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="table-responsive" id="viewservices">
        <h4 align="center">Offered Services</h4>
        <hr>
        <table class="table table-striped table-sm table-dark">
          <thead>
            <tr>
              <th scope="col">Service ID</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
              <th scope="col">Date Created</th>
            </tr>
          </thead>
          <tbody>
          <?php
            // method for agent to view his offered services
            $objdisplay = new SaloonManagement;

            $result = $objdisplay->displayServices($_SESSION['saloon']);
            
              // echo "<pre>";
              // echo print_r($result);
              // echo "</pre>";
            // var_dump($result);
            // die('i got here');
              foreach ($result as $key => $value) {
              
          ?>
            <tr>
              <td><?php echo $value['service_id']?></td>
              <td><?php echo $value['service_type']?></td>
              <td><?php echo $value['service_desc']?></td>
              <td><?php echo $value['price']?></td>
              <td>
                <?php 
                if ($value['service_status'] == 'active') {
                  // code...
                  ?>
                <button class="btn btn-sm btn-success">Active</button>
              <?php 
              }else{
                ?>
                <button class="btn btn-sm btn-danger">Inactive</button>
              <?php } ?>
              </td>
              <td><?php echo date('jS, M, Y h:i:s a', strtotime($value['updated_at']))?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<!-- Scrollable modal -->

<!-- JS Script -->
<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="css/dashboard.js"></script>
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){


      $('#viewservices').hide()

      $('#service').click(function(){

        $('#bookings').hide()
        $('#viewservices').addClass('animate__animated animate__rotateIn')
        $('#viewservices').show()
      })

      // $('#viewbookings').hide()
      $('#book').click(function(){
        
        $('#viewservices').hide()
        $('#bookings').addClass('animate__animated animate__rotateIn')
        $('#bookings').show()
      })
    });
</script>

</body>
</html>

<?php 
session_start();
include('projectclass/saloonmanagementclass.php');
// checking that the user is logged in with email;

if (empty($_SESSION['saloon_email']) && empty($_SESSION['saloon_id'])) {
  header("Location: http://localhost/pro20/agentlogin.php?msg=Kindly Log in to continue.");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Prosper Ibe">
    <title>Service-Provider DashBoard</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link type='text/css' rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="bootstrap/css/animate.min.css">

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
      <a class="nav-link px-3" href="agentlogout.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="agentdashboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="viewbooking" style="cursor:pointer">
              <span data-feather="shopping-cart"></span>
              All Bookings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="viewservice" style="cursor:pointer">
              <span data-feather="file"></span>
              Recent Bookings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="agentaddservice.php">
              <span data-feather="layers"></span>
              Add Service
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="agentviewservices.php">
              <span data-feather="file-text"></span>
              Offered Services
            </a>
          </li>
        </ul>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="agentuploadphoto.php">
              <span data-feather="bar-chart-2"></span>
              Upload Image
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
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
                echo "Welcome ".$_SESSION['saloon_name'].". You are logged in with ".$_SESSION['saloon_email'].".";

              ?>
          </div>
        <!-- card stop -->
        <!-- <h1 class="h2">Service-Provider DashBoard</h1> -->
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a class="btn btn-sm btn-primary">Share</a>&nbsp
            <a class="btn btn-sm btn-primary">Export</a>
          </div>
          <a class="btn btn-sm btn-primary" href="agentpaysub.php">
            <span data-feather="calendar"></span>
            Subscription
          </a>
        </div>
      </div>
      <h4>Service Provider Dashboard</h4>
      <hr>
<!--  -->
      <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa fa-comment"></i>
                </div>
                <?php 
                // instantiating class
                $objactive = new SaloonManagement;

                // instantiating method
                $totalbookings = $objactive->viewTotalBookings($_SESSION['saloon_id']);
                if (!empty($totalbookings)) {
                  // echo "<pre>";
                  // print_r($totalbookings);
                  // echo "</pre>";
                  foreach ($totalbookings as $key => $value) {
                    // print_r($value);

                    foreach ($value as $key => $total) {
                      print_r($total);
                    }
                  }
                }
                ?>
                <div class="mr-5">Active Bookings.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="">
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
                  <i class="fa fa-users" style='font-size:24px'></i>
                </div>
                <?php 
                  // Instantiating class
                  $objconfirmed = new SaloonManagement;

                  // instantiating method
                  $ojbcon = $objconfirmed->viewConfirmedBookings($_SESSION['saloon_id']);
                  if (!empty($ojbcon)) {
                    // echo "<pre>";
                    // print_r($ojbcon);
                    // echo "</pre>";

                    foreach ($ojbcon as $key => $value) {
                     // print_r($value);

                    foreach ($value as $key => $val) {
                        print_r($val);
                     }

                    }

                  }
                ?>
                <div class="mr-5">Delivered Bookings.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin.html">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa fa-list"></i>
                </div>
              <?php 
                  // calling class
                  $objpending = new SaloonManagement;

                  $obfresult = $objpending->viewPendingBookings($_SESSION['saloon_id']);
                  if (!empty($obfresult)) {
                    // echo "<pre>";
                    // print_r($obfresult);
                    // echo "</pre>"; 
                    foreach ($obfresult as $key => $value) {
                      // print_r($value);

                      foreach ($value as $key => $figure) {
                        print_r($figure);
                      }
                  }
                }
              ?>
                <div class="mr-5">Pending Bookings</div>
             
              </div>
              <a class="card-footer text-white clearfix small z-1" href="report.html">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa  fa-ban"></i>
                </div>
                <?php 
                  // instantiating class
                  $objOffS = new SaloonManagement;

                  $OffServe = $objOffS->ViewNoOfferS($_SESSION['saloon_id']);
                  if (!empty($OffServe)) {
                    // echo "<pre>";
                    // print_r($OffServe);
                    // echo "</pre>";
                    foreach ($OffServe as $key => $value) {
                      foreach ($value as $key => $offer) {
                       print_r($offer);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Offered Services</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
      </div>
      <hr>
      <div class="table-responsive" id="viewservices">
        <h4 align="center">Recent Bookings</h4>
        <hr>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
             <th scope="col">Booking ID</th>
              <th scope="col">service Type</th>
              <th scope="col">Customer Email</th>
              <th scope="col">Booking Time</th>
              <th scope="col">Booking Date</th>
              <th scope="col">Status</th>
              <th scope="col">Date Created</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            // method for agent to view his offered services
            $objdisplay = new SaloonManagement;

            $result = $objdisplay->viewRecentBookings($_SESSION['saloon_id']);
            
              // echo "<pre>";
              // echo print_r($result);
              // echo "</pre>";
            foreach ($result as $key => $value) {
          ?>
            <tr>
              <td><?php echo $value['booking_id']?></td>
              <td><?php echo $value['service_type']?></td>
              <td><?php echo $value['customer_email']?></td>
              <td><?php echo $value['booking_time']?></td>
              <td><?php echo $value['booking_date']?></td>
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
              <td><?php echo $value['created_at']?></td>
              <td>
                <a href='agentacceptbooking.php?saloonid=<?php echo $_SESSION['saloon_id']?>' class='btn btn-sm btn-link'><i class='fa fa-edit'></i>&nbsp; Accept</a>&nbsp;<br>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="table-responsive" id="viewbookings">
        <h4 align="center">Bookings</h4>
        <hr>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Booking ID</th>
              <th scope="col">service Type</th>
              <th scope="col">Customer Email</th>
              <th scope="col">Booking Time</th>
              <th scope="col">Booking Date</th>
              <th scope="col">Status</th>
              <th scope="col">Date Created</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // method for agent to see his bookings
              $objviewbookings = new SaloonManagement;

              $output = $objviewbookings->viewBookings($_SESSION['saloon_id']);
              // echo "<pre>";
              // echo print_r($output);
              // echo "</pre>";
              foreach ($output as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value['booking_id']?></td>
              <td><?php echo $value['service_type']?></td>
              <td><?php echo $value['customer_email']?></td>
              <td><?php echo date('h:i:s a', strtotime($value['booking_time']))?></td>
              <td><?php echo date('jS F, Y', strtotime($value['booking_date']))?></td>
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
              <td><?php echo $value['created_at']?></td>
              <td>
                <a href='agentacceptbooking.php?saloonid=<?php echo $_SESSION['saloon_id']?>' class='btn btn-sm btn-link'><i class='fa fa-edit'></i>&nbsp; Accept</a>&nbsp;<br>
              </td>
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
<script type="text/javascript">

    $(document).ready(function(){

      $('#viewservices').hide()

      $('#viewservice').click(function(){

        $('#viewbookings').hide()
        $('#viewservices').addClass('animate__animated animate__rotateIn')
        $('#viewservices').show()
      })

      // $('#viewbookings').hide()
      $('#viewbooking').click(function(){
        
        $('#viewservices').hide()
        $('#viewbookings').addClass('animate__animated animate__rotateIn')
        $('#viewbookings').show()
      })
    });
</script>

</body>
</html>

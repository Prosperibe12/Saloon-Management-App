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
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminaddcategory.php">
              <span data-feather="shopping-cart"></span>
              Add Service
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="serviceprovider" style="cursor:pointer">
              <span data-feather="file"></span>
              Service Providers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminviewusers.php">
              <span data-feather="file-text"></span>
              Users
            </a>
          </li>
        </ul>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" id="viewbooking" style="cursor:pointer">
              <span data-feather="bar-chart-2"></span>
              View Bookings
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
      <h4>Admin Dashboard</h4>
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

                $active = $objactive->adminViewAllBookings();
                if (!empty($active)) {
                 // echo "<pre>";
                 // print_r($active);
                 // echo "</pre>";
                 foreach ($active as $key => $value) {
                   // print_r($value);

                  foreach ($value as $key => $vals) {
                    print_r($vals);
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
                  // instantiating class
                $objconfir = new SaloonManagement;
                $confirmed = $objconfir->adminViewConfirmedBookings();
                if (!empty($confirmed)) {
                  foreach ($confirmed as $key => $out) {
                    foreach ($out as $key => $in) {
                      print_r($in);
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
            <div class="card text-dark bg-warning o-hidden h-100">
              <div class="card-body">
                <div>
                  <i class="fa fa-list"></i>
                </div>
                <?php 
                  // instantiating class
                  $objpending = new SaloonManagement;

                  $pending = $objpending->adminViewPendingBookings();
                  if (!empty($pending)) {
                    foreach ($pending as $key => $answer) {

                      foreach ($answer as $key => $no) {
                        print_r($no);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Pending Bookings</div>
             
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="report.html">
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
                  <i class="fa  fa-cog fa-spin fa-1x fa-fw"></i>
                </div>
                <?php 
                  // instantiating class
                $objSP = new SaloonManagement;

                $serviceP = $objSP->adminCountSp();
                if (!empty($serviceP)) {
                  foreach ($serviceP as $key => $value) {
                    foreach ($value as $key => $view) {
                      print_r($view);
                    }
                  }
                }
                ?>
                <div class="mr-5">Service Providers</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="">
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
                  <i class="fa  fa-shopping-cart"></i>
                </div>
                <?php 
                  // instantiating class
                  $objAusers = new SaloonManagement;

                  $activeU = $objAusers->adminViewUser();
                  if (!empty($activeU)) {
                    foreach ($activeU as $key => $value) {
                      foreach ($value as $key => $aU) {
                        print_r($aU);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Active Users</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <!-- jasdfghjkl -->
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-success o-hidden h-100" style="--bs-bg-opacity: .5;">
              <div class="card-body">
                <div>
                  <i class="fa  fa-refresh fa-spin fa-1x fa-fw"></i>
                </div>
                <?php 
                  // instantiating class
                  $objStype = new SaloonManagement;

                  $sType = $objStype->adminCountServe();
                  if (!empty($sType)) {
                    foreach ($sType as $key => $value) {
                      foreach ($value as $key => $aD) {
                        print_r($aD);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Offered Services</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <!-- xcvgbhjkl -->
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-warning o-hidden h-100" style="--bs-bg-opacity: .5;">
              <div class="card-body">
                <div>
                  <i class="fa  fa-money"></i>
                </div>$
                <?php 
                  // instantiating class
                  $objPay = new SaloonManagement;

                  $payStack = $objPay->adminViewPay();
                  if (!empty($payStack)) {
                    foreach ($payStack as $key => $value) {
                      foreach ($value as $key => $pay) {
                        print_r($pay);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Paystack Revenue</div>
              </div>
              <a class="card-footer text-dark clearfix small z-1" href="">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fa fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-dark bg-info o-hidden h-100" style="--bs-bg-opacity: .5;">
              <div class="card-body">
                <div>
                  <i class="fa  fa-money"></i>
                </div>$
                <?php 
                  // instantiating class
                  $objCash = new SaloonManagement;

                  $payCash = $objCash->adminViewCash();
                  if (!empty($payCash)) {
                    foreach ($payCash as $key => $value) {
                      foreach ($value as $key => $cash) {
                        print_r($cash);
                      }
                    }
                  }
                ?>
                <div class="mr-5">Total Cash Revenue</div>
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
      <div class="table-responsive" id="serviceproviders">
        <h4 align="center">Approved Service Providers</h4>
        <hr>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
             <th scope="col">Saloon ID</th>
              <th scope="col">Service Provider</th>
              <th scope="col">Address</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Account Status</th>
              <th scope="col">Date Registered</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php 
      $objviewproviders = new SaloonManagement;

      $output = $objviewproviders->viewServiceProviders();
      // echo "<pre>";
      // print_r($output);
      // echo "</pre>";
      foreach ($output as $key => $value) {

        $_SESSION['salonid'] = $value['saloon_id'];
    ?>
            <tr>
              <td><?php echo $value['saloon_id'] ?></td>
              <td><?php echo $value['saloon_name'] ?></td>
              <td><?php echo $value['saloon_address'] ?></td>
              <td><?php echo $value['saloon_email'] ?></td>
              <td><?php echo $value['saloon_telephone'] ?></td>
              <td>
                <?php 
                  if ($value['account_status'] == 'active') {
                ?>
                <button class="btn btn-sm btn-success">Active</button>
                <?php 
                  }else{
                ?>
                 <button class="btn btn-sm btn-danger">Inactive</button>
                 <?php 
                   } 
                 ?>
              </td>
              <td><?php echo $value['created_at'] ?></td>
              <td>
                <a href='adminanalytics.php?saloonid=<?php echo $_SESSION['salonid']?>' class='btn btn-sm btn-link'><i class='fa fa-list'></i>&nbsp; Analytics</a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="table-responsive" id="bookings">
        <h4 align="center">Bookings</h4>
        <hr>
        <table class="table table-striped table-hover table-dark table-sm" id="myTable">
          <thead>
            <tr>
              <th scope="col">Booking ID</th>
              <th scope="col">Status</th>
              <th scope="col">Service Type</th>
              <th scope="col">Time</th>
              <th scope="col">Date</th>
              <th scope="col">Customer Email</th>
              <th scope="col">Saloon ID</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              // creating instance of class
            $objinput = new SaloonManagement;

            // creating instance of method
            $outcome = $objinput->adminViewBookings();

              // echo "<pre>";
              // print_r($outcome);
              // echo "</pre>";
              foreach ($outcome as $key => $value) {
            ?>
            <tr>
              <td><?php echo $value['booking_id']?></td>
              <td>
                <?php 
                if ($value['booking_status']=='pending') {
                 ?>
                 <button class="btn btn-sm btn-warning">Pending</button>
                 <?php 
               }else{
                ?>
                <button class="btn btn-sm btn-info">Confirmed</button>
              <?php } ?>
              </td>
              <td><?php echo $value['service_type']?></td>
              <td><?php echo date('h:i:s a', strtotime($value['booking_time']))?></td>
              <td><?php echo date('d-m-Y', strtotime($value['booking_date']))?></td>
              <td><?php echo $value['customer_email']?></td>
              <td><?php echo $value['saloon_id']?></td>
            </tr>
          <?php }?>
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

      $('#myTable').DataTable();

      $('#serviceproviders').hide()

      $('#serviceprovider').click(function(){

        $('#bookings').hide()
        $('#serviceproviders').addClass('animate__animated animate__rotateIn')
        $('#serviceproviders').show()
      })

      // $('#viewbookings').hide()
      $('#viewbooking').click(function(){
        
        $('#serviceproviders').hide()
        $('#bookings').addClass('animate__animated animate__rotateIn')
        $('#bookings').show()
      })
    });
</script>

</body>
</html>

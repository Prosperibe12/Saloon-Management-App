<?php 
session_start();
include('projectclass/saloonmanagementclass.php');
// checking that the user is logged in with email;

if (empty($_SESSION['saloon_email']) || empty($_SESSION['saloon_id'])) {
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
            <a class="nav-link active" aria-current="page" href="agentdashboard.php">
              <span data-feather="home"></span>
              Go to Dashboard
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
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
      <div class="row">
         <div class="table-responsive" id="viewservices">
        <h4 align="center">Offered Services</h4>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Service ID</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
              <th scope="col">Date Created</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            // method for agent to view his offered services
            $objdisplay = new SaloonManagement;

            $result = $objdisplay->displayServices($_SESSION['saloon_id']);
            
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
              <td>
                <a href='agenteditservice.php?saloonid=<?php echo $_SESSION['saloon_id']?>' class='btn btn-sm btn-link'><i class='fa fa-edit'></i>&nbsp; Edit</a>&nbsp;<br>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      </div>
               
        
  </div>
</div>
<!-- JS Script -->
<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="css/dashboard.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

      // writing the .load method for Service ID
    //     $('#Serviceid').change(function(){

    //       var accept = $(this).val();
    //       // alert(accept);
    //       $('#Servicetype').load("servicedata.php", {services: accept});
    //       // $('$Serviceid').val(accept);
    //     });
          
    // });
</script>

</body>
</html>

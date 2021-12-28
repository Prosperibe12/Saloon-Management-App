<?php 
ob_start();
session_start();
include 'projectclass/saloonmanagementclass.php';
if (!empty($_SESSION['custid']) && !empty($_SESSION['customer_email'])) {
include('css/signinheader.php');
}else{
  include('css/header.php');
}
?>
<br><br><br>

<main>

  <div class="container-fluid marketing">
    <div class="row" style="height:500px">
      <div class="col-md-12 darken-20" style="background-image:url('images/16379358121045470106.jpg');background-size: cover;background-repeat: no-repeat;">
        <div style="position: absolute;top: 150px;min-height: 50px;left: 90px;min-width: 60px;">
          <h1 style="color:white;font-size: 50px;">Beauty & Salon</h1>
          <h5 style="color:white">Lets make you an appointment and keep you attractive</h5>
        </div>
        <?php 
        // displaying services offered by service providers
            $_SESSION['saloonid']=$_GET['saloonid'];
            $objshow = new SaloonManagement;
            $response = $objshow->serviceProviderPage($_SESSION['saloonid']);
            if (!empty($response)) {
             // echo "<pre>";

             // echo print_r($response);
             //  echo "</pre>";
          ?>
        <div class="row g-3" style="position:absolute;top: 270px;left: 90px;width:85%;min-height: 100px;border-radius: 5px;background-color: white;">
          <?php 
          // form validation for booking
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

              $errormsg = array();

              if (empty($_POST['customeremail'])) {

                $errormsg[] = "Email is required";
              }

              if (empty($_POST['servicetype'])) {

                $errormsg[] = "Please Choose a Service";
              }

              if (empty($_POST['date'])) {

                $errormsg[] = "Please pick your preferred date";
              }

              if (empty($_POST['time'])) {

                $errormsg[] = "Please pick your preferred time";
              }

              if (empty($_POST['saloonid'])) {

                $errormsg[] = "This field is required";
              }

              if (!empty($errormsg)) {
                echo "<ul class='alert alert-danger'>";

                foreach ($errormsg as $key => $value) {
                  echo "<li>$value</li>";
                }
                echo "</ul>";
              }else{
                $objbook = new SaloonManagement;
                  // checking if time has been booked
                if ($objbook->checkTime($_POST['time']) == true) {
                  echo "<div class='alert alert-danger'>Time taken, Choose another time</div>";
                }else{

                  $output = $objbook->userbooking($_POST['customerid'],$_POST['saloonid'], $_POST['servicetype'],$_POST['customeremail'],$_POST['time'],$_POST['date']);

                    $_SESSION['servicet'] = $_POST['servicetype'];
                    
                    echo "<pre>";
                    print_r($output);
                    echo "</pre>";
                  // if ($output == true) {
                  //  echo "<div class='alert alert-success'>Service Succesfully Booked</div>";

                  //  header("Location: http://localhost/pro20/bookingsummary.php");
                  //  exit;
                  // }
                }
              }

            }
          ?>
          <form class="row g-3" action="" method="post">
              <div class="col-md-6">
                <input type="hidden" class="form-control" name="customerid" value="<?php echo $_SESSION['custid']??'';?>">
              </div>
              <div class="col-md-6">
                <input type="hidden" class="form-control" name="customeremail" value="<?php echo $_SESSION['customer_email']??'';?>">
              </div>
              <div class="col-md-6">
                <select id="servicetype" class="form-select" name="servicetype" style="border-color: #FE7F9B;color: #FE7F9B;">
                  <option selected>Choose Service</option>
                  <?php foreach ($response as $key => $value) {
                    ?>
                  <option value="<?php echo $value['service_type']?>"><?php echo $value['service_type']?></option>
                <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <input type="date" class="form-control" name="date" style="border-color:#FE7F9B;color:#FE7F9B">
              </div>
              <div class="col-md-2">
                <input type="time" class="form-control" name="time" style="border-color:#FE7F9B;color:#FE7F9B">
              </div>
              <div class="col-12">
                <input type="hidden" class="form-control" name="saloonid" value="<?php echo $value['saloon_id']?>">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary" id="continue">Continue</button>
              </div><br>
        </form>
        </div>
      </div>
    </div>
    <hr class="header-divider">
  <div>
    <div class="col-md-6 offset-1 mb-5">
       <h2>Our Services _</h2>
       <p style="font-size:18px">You can book service from the cart view easily.</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-9 offset-2">
     <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php 
        foreach ($response as $key => $value) {
      ?>
  <div class="col">
    <div class="card h-100">
      <img src="images/16385065361148635391.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $value['service_type'];?></h5>
        <small class="text-muted"><i><?php echo $value['saloon_name']?></i></small>
        <h5 class="pt-1">Price</h5>
        <div class="pb-3">
          <i class="fas fa-dollar-sign"></i>
          <span class="card-text"><?php echo $value['price'];?></span>
        </div>
        <a href="#" class="btn" style="background-color:#FE7F9B;color:white"><strong>Book Service</strong></a>
      </div>
    </div>
  </div>
  <?php 
}
  ?>
</div> 
</div> 
</div><br><br>
<!-- FOOTER -->
  <footer class="container-fluid" style="background-color:rgb(244, 243, 238)">
      <div class="row">
      <div class="col-4">
       <div class="widget text-center">
          <h5>Visit Us</h5>
          <div class="widget-icon-wrapper">
          <i class="fas fa-map-marker-alt"></i>
        </div>
          <p><?php echo $value['saloon_address']?></p>
      </div>
      </div>

      <div class="col-4">
        <div class="widget text-center">
          <h5>Call Us</h5>
        <div class="widget-icon-wrapper">
          <i class="fa fa-phone"></i>
        </div>
          <p><?php echo $value['saloon_telephone']?></p>
      </div>
      </div>

      <div class="col-4">
        <div class="widget text-center">
          <h5>Mail Us</h5>
          <div class="widget-icon-wrapper">
          <i class="far fa-envelope"></i>
        </div>
          <p><?php echo $value['saloon_email']?></p>
      </div>
      </div>
    </div>
  <?php 
  }
  ?>

    <div class="d-flex justify-content-center border-top">
      <p>&copy; 2021 Company, Inc. All rights reserved.</p>
    </div>
  </footer>    
<!-- END FOOTER -->
</main>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
      
    $(document).ready(function(){

      $('#continue').hide();
      $('#servicetype').change(function(){
        $('#continue').show();
      });

      $('#showservices').hide();

      $('#displayserv').keyup(function(){

        // get serach box value;
      var searchservice = $('#displayserv').val();

      // send search data to search.php using $.ajax method
      $.ajax({
        url: "searchservice.php",
        type: "post",
        data: "names="+searchservice,
        success: function(response){
          $('#showservices').show();
          $('#showservices').html(response);
        }

      });

      });

      $('#displayserv').blur(function(){
        $('#showservices').hide();
      }); 

    });
    
  </script>

  <?php 
ob_flush();
  ?> 
  </body>
</html>

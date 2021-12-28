<?php
ob_start();
session_start();
if (!empty($_SESSION['custid']) && !empty($_SESSION['customer_email'])) {
  include 'css/signinheader.php';
}else{
  include('css/header.php');
}
include 'projectclass/saloonmanagementclass.php';
?><br><br><br><br><br>
<main>
  <div class="container-fluid">
    <div class="row" style="color:rgb(153, 153, 153);">
      <div class="col-md-8 px-5" style="min-height: 200px;">
        <div class="row flex-column px-5">
          <?php 
          // // var_dump($_SESSION['booking_id']);
          $objsum = new SaloonManagement;

          $output = $objsum->bookingSummary($_SESSION['booking_id']);

          if (!empty($output)) {
            // echo "<pre>";
            // print_r($output);
            // echo "</pre>";
              $_SESSION['amount'] = $output['price'];
              $_SESSION['servicetype'] = $output['service_type'];
           ?>
      <h5 align="center">Booking Summary Page</h5>
        <div class="card mb-3" style="min-width: 540px;">
          <div class="row g-0">
                <div class="col-md-4">
                  <img src="images/B6otIn.default.jpg" class="img-fluid rounded-start" alt="...">
                </div>
            <div class="col-md-8">
              <div class="card-body">
                <h6 class="card-title" align="center">Booking Details</h6>
                <hr>
                <span><strong>Booking ID:</strong></span> <span><?php echo $output['booking_id']?></span><br>
              <span><strong>User Email:</strong></span> <span><?php echo $_SESSION['customer_email']?></span><br>
              <span><strong>Service Type:</strong></span> <span><?php echo $output['service_type']?></span><br>
              <span><strong>Booking Date:</strong></span> <span><?php echo date('d F, Y', strtotime($output['booking_date']))?></span><br>
              <span><strong>Booking Time:</strong></span> <span><?php echo date('h:i:s a', strtotime($output['booking_time']))?></span><br>
              </div>
            </div>
          </div>
        </div>
      <div class="card mb-3" style="min-width: 340px;">
        <div class="row g-0">
            <div class="col-md-4">
              <?php 
                if (empty($output['saloon_image'])) {
              ?>
              <img src="images/1587119952404_images (1).jpg" class="img-fluid rounded-start" alt="...">
            <?php } else{
              ?>
              <img src="images/<?php echo $output['saloon_image']?>" class="img-fluid rounded-start" alt="...">
            <?php } ?>
            </div>
        <div class="col-md-6">
          <div class="card-body">
            <h6 class="card-title" align="center">Saloon Details</h6>
                <hr>
            <span><strong>Saloon Name:</strong></span> <span><?php echo $output['saloon_name']?></span><br>
            <span><strong>Saloon Address:</strong></span> <span><?php echo $output['saloon_address']?></span><br>
            <span><strong>Saloon Email:</strong></span> <span><?php echo $output['saloon_email']?>@mail</span>
          </div>
        </div>
        </div>
      </div>
        </div>
      </div>

      <div class="col-md-4" style="min-height: 200px;">
        <div class="row flex-column">

          <!-- Price details column -->
          <div class="col-md-6 my-3 mx-5" style="border:1px solid black;min-height: 200px;border-radius: 10px;width: 300px;">
                <h6 style="padding-top: 5px;text-align: center;">Price Details</h6>
                <hr>
                <span>Sub total:</span> &nbsp &nbsp <span>$<?php echo $output['price']?></span><br>
                <span>Tax:</span>  &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<span>$0.00</span>
                <hr>
                <span><strong>Net Total:</strong></span> &nbsp &nbsp <span>$<?php echo $output['price']?></span>
          </div>
        
          <!-- Paymrnt details column -->
        <div class="col-md-6 my-3 mx-5" style="border:1px solid black;min-height: 300px;border-radius: 10px;width: 300px;">
                <h6 style="padding-top: 5px;text-align: center;">Payment Method</h6>
                <small class="text-muted" style="text-align: center;">Please choose your preferred payment method</small>
                <hr>
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                  $objconfirm = new SaloonManagement;

                  $outcome = $objconfirm->cashPay($_POST['bookingid'],$_POST['saloonid'],$_POST['servicetype'],$_POST['serviceprice'],$_POST['customeremail'],$_POST['paymethod']);

                  if ($outcome == true) {
                    
                    echo "<div class='alert alert-success'>You can now visit the saloon.</div>";
                    // header("Location: home.php?msg=Succesfully booked.");
                  }

                }
            ?>
    <form method="post" action="">
          <div class="form-check">
                <input class="form-check-input" type="radio" name="paymethod" id="onlinepay" value="paystack">
                <label class="form-check-label" for="onlinepay">
                  Online
                </label>
          </div><br>
          <div class="form-check">
                <input class="form-check-input" type="radio" name="paymethod" id="cash" value="cashpay" style="color:red">
                <label class="form-check-label" for="cash">
                  Pay at Saloon
                </label>
          </div>
          <div class="form-group">
                <input type="hidden" name="bookingid" value="<?php echo $output['booking_id']?>" class="form-control">
          </div>
          <div class="form-group">
                <input type="hidden" name="saloonid" value="<?php echo $output['saloon_id']?>" class="form-control">
          </div>
          <div class="form-group">
                <input type="hidden" name="servicetype" value="<?php echo $output['service_type']?>" class="form-control">
          </div>
          <div class="form-group">
                <input type="hidden" name="serviceprice" value="<?php echo $output['price']?>" class="form-control">
          </div>
          <div class="form-group">
                <input type="hidden" name="customeremail" value="<?php echo $_SESSION['customer_email']?>" class="form-control">
          </div>
              <hr>
            <a href="userpay.php?msg=bookingsummary" class="btn btn-primary mx-5" id="stack">PAY</a>
            <button class="btn btn-primary mx-5" type="submit" id="shop">BOOK NOW</button>
      </form>
        </div>
      </div>
    </div>
    </div>
<?php 
  }
  ?>
  </div>
  <hr>
</main>
<?php 
include('css/footer.php');
?>

<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#stack').hide();
    $('#shop').hide();


      $('#onlinepay').click(function(){

        $('#stack').show()
        $('#shop').hide()
      })

      $('#shop').hide()
      $('#cash').click(function(){
        
        $('#shop').show()
        $('#stack').hide()
      })
  });
</script>
<?php 
ob_flush();
?>
</body>
</html>
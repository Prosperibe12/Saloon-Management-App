<?php
session_start();
if (!empty($_SESSION['custid']) && !empty($_SESSION['customer_email'])) {
  include 'css/signinheader.php';
}else{
  include('css/header.php');
}
include 'projectclass/saloonmanagementclass.php';
?>
<hr class="header-divider">
<br><br><br><br>
<main>

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">
    <div class="row" style="height:50px;">
      <div class="col-md-3">
        <div>
          <a href="home.php" class="btn btn-sm" style="background-color:#FE7F9B;color:white">BACK</a>
          <h5>Hairstyles</h5>
          <h6>CHOOSE SERVICE PROVIDER</h6>
        </div>
      </div>
    </div><br>
    <hr class="header-divider">
    <div class="row">
      <div class="col-lg-3" id="services" style="background-color:white;">
          <div class="Beauty" style="background-color: #FE7F9B;">
            <a href="#" class="sidebars" id="feature" style="color:white">Hair Styles</a>
          </div>
          <div class="Beauty">
            <a href="mensection.php" class="sidebars" id="feature" style="color:#FE7F9B">Men's Care</a>
          </div>
      </div>
    <div class="col-lg-9">
        <h3 style="color:#FE7F9B">Women Section</h3>
        <!-- Card Bodies -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php 
            // instantiating class
            $objWomen = new SaloonManagement;
            $showStyle = $objWomen->womenSection();

            if (!empty($showStyle)) {
              // echo "<pre>";
              // print_r($showMen);
              // echo "</pre>";

              foreach ($showStyle as $key => $value) {
          ?>
          <div class="col">
            <div class="card h-100">
              <?php 
                if (empty($value['saloon_image'])) {
              ?>
              <img src="images/1637903745285166657.jpg" class="card-img-top" alt="...">
              <?php 
                }else{
              ?>
              <img src="images/<?php echo $value['saloon_image']?>" class="card-img-top" height='160px'>
            <?php } ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $value['saloon_name']?></h5>
                <h6><i><?php echo $value['saloon_address']?></i></h6>
                <a href="saloons.php?saloonid=<?php echo $value['saloon_id']?>" class="btn" style="background-color:#FE7F9B;color:white"><strong>Visit Saloon&raquo;</strong></a>
              </div>
            </div>
          </div>
        <?php } 
          }
        ?>
      </div>
    </div>
    <br>
    <hr class="featurette-divider">
  </div>
</main>
<?php 
include('css/footer.php');
?>

    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
      
    $(document).ready(function(){

      
    });
    
  </script>

      
  </body>
</html>

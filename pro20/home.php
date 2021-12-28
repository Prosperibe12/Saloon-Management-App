<?php
session_start();
if (!empty($_SESSION['custid']) && !empty($_SESSION['customer_email'])) {
  include 'css/signinheader.php';
}else{
  include('css/header.php');
}
include 'projectclass/saloonmanagementclass.php';
?>
<main>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/wellness-g3a55bfe6a_640.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5><i>Oma's Beauty Saloon</i></h5>
        <p>Want to have you nails done! This service will provide you manicures, pedicures, and nail enhancements.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="images/1588001067537_beauty_store5.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5><i>MaeBee Beauty Lounge</i></h5>
        <p><i>Get yourself relaxed with our spa service. Great spa manicures and pedicures, massages, facials body treatments like exfoliation are available for you.</i></p>
        <p><a class="btn btn-lg btn-primary" href="">VISIT THIS SPA</a></p>

      </div>
    </div>
    <div class="carousel-item">
      <img src="images/barber-gc2fa76e01_640.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5><i>First Class Cutz</i></h5>
        <p><i>Great customer service is a must for us, a friendly environment serving the best of your interest!</i></p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
</div>
</div>
<br>
  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">
    <div class="row">
      <div class="col-lg-3" id="services" style="background-color:white;">
        <div class="Beauty" style="background-color: #FE7F9B;">
          <a href="" class="sidebars" id="feature" style="color:white">Most Booked</a>
        </div>
        <div class="Beauty"><a href="#serviceprovider" class="sidebars">Top Service Provider</a></div>
        <div class="Beauty"><a href="#shops" class="sidebars">Sponsored Shops</a></div>
        <div class="Beauty"><a href="hairstyles.php" class="sidebars">Hair Styles</a></div>
        <div class="Beauty"><a href="mensection.php" class="sidebars">Men's Care</a></div>
      </div>
    <div class="col-lg-9">
        <h3 id="serviceprovider">TOP SERVICE PROVIDERS</h3>
        <!-- head -->
  <div class="row row-cols-1 row-cols-md-3 g-4">
  <?php 
      $objget = new SaloonManagement;

      $output = $objget->homePage();
      if (!empty($output)) {
        // echo "<pre>";
        // echo print_r($output);
        // echo "</pre>";
        foreach ($output as $key => $value) {
          // code...
  ?>
  <div class="col">
    <div class="card">
      <?php 
      if (empty($value['saloon_image'])) {
        ?>
      <img src="images/1637903745285166657.jpg" class="card-img-top" alt="...">
      <?php }else{
        ?>
      <img src="images/<?php echo $value['saloon_image']?>" class="card-img-top" height='160px'>
    <?php } ?>
      <div class="card-body">
        <h6 class="card-title"><?php echo $value['saloon_name']?></h6>
        <h6><i><?php echo $value['saloon_address']?></i></h6>
        <a href="saloons.php?saloonid=<?php echo $value['saloon_id']?>" class="btn" style="background-color:#FE7F9B;color:white"><strong>Visit Saloon&raquo;</strong></a>
      </div>
    </div>
  </div>
  <?php 
  }
?>
  
  
</div>
     <!-- tail -->
    </div>
    <br><br>

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">
    <h3 id="shops">SPONSORED SHOPS</h3>
    <hr>
    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Face Makeup. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Makeup is an essential part of a woman's personality, which is why Eye makeup is the most important soul of makeup and should be done.
          </p>
        <div  class="booknow" style="width:30%">
        <p><a class="btn" href="saloons.php?saloonid=<?php echo $value['saloon_id']?>" style="color: white; font-weight:bold">View More Products &raquo;</a></p>
      </div>
      </div>
      <div class="col-md-5">
       <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" style="height:300px">
                <img src="images/spa.jpg" class="img-thumbnail" alt="...">
              </div>
              <div class="carousel-item" style="height:300px">
                <img src="images/1587119072740_Salon-At-Home-Manicure-Pedicure-Home-Salon-Services-In-Bhopal-Beauty-On-Duty-Services.jpg" class="img-thumbnail" alt="...">
              </div>
              <div class="carousel-item" style="height:300px">
                <img src="images/cream-g895ec0c36_640.jpg" class="img-thumbnail" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
      </div>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Body Massage? Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Reduced stress,anxiety and depression with massage and get complete Relaxation & Freshness & improve sleep.....we are providing all type of massage like 1) Head massage 2) Shoulder & both hand massage 3) Both legs & foot massage 4) Back & Front full body massage 5) Sensual massage.</p>
        <div  class="booknow" style="width:30%">
        <p><a class="btn" href="saloons.php?saloonid=<?php echo $value['saloon_id']?>" style="color: white; font-weight:bold">Book a Session &raquo;</a></p>
      </div>
      </div>
      <div class="col-md-5 order-md-1">
          <img src="images/wellness-g3a55bfe6a_640.jpg" class="img-thumbnail">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">We have a line of hair treatments designed exclusively for the benefit of your hair and give you your “dream hairstyle” and give your hair the “dream look”. From deep-condition, streak, dye, style to polish, flatten or curl your hair according to your hair’s need and your requirement.</p>
        <div  class="booknow" style="width:30%">
        <p><a class="btn" href="saloons.php?saloonid=<?php echo $value['saloon_id']?>" style="color: white; font-weight:bold">Visit Shop &raquo;</a></p>
      </div>
      </div>
      <div class="col-md-5">
          <img src="images/haircut.jpg" class="img-thumbnail">        

      </div>
    </div>
  <?php
  }
  ?>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->
  </div>
</div>
<!-- /.container -->
  <!-- FOOTER -->
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
 
      
  </body>
</html>

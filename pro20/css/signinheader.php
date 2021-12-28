<!doctype html>
<html lang="en">
  <head>
    <title>HAIRSTYLES|ONLINE SALOON AND SPA BOOKING</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keyword" content="saloon,spa,near me,online spa,online saloon,saloon booking,online saloon booking, saloon management, online pedicure and manicure booking">
    <meta name="description" content="Online Saloon/Spa Booking">
    <meta name="author" content="Prosper Ibe">
    <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/cascade.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css">
    <link rel="stylesheet" type="text/css" href="icons/css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="canonical" href="bootstrap-5.1.3-examples/carousel/carousel.rtl.css">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap/css/animate.min.css">
    <script src="https://kit.fontawesome.com/c9f8e4d2b3.js" crossorigin="anonymous"></script>
    <style>
      
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #showservices{
        position: absolute;
        top: 1px;
        left: 490px;
        width: 350px;
        /*border: 1px solid red;*/
        height: 30px;
        border-radius: 5px;
        background-color: white;
      }
    </style>
    <link href="bootstrap-5.1.3-examples/carousel/carousel.css" rel="stylesheet">
  </head>

<body>
    
<header>
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container-fluid">
      <div class="flex-row">
        <div class="col-md-2">
              <a class="navbar-brand" href="home.php"><img src="images/logoheader.png" id="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
      </div>
          <div class="col-md-7">
             <div class="collapse navbar-collapse" id="navbarCollapse">
              <form class="d-flex">
              <input class="st-default-search-input form-control" style="width: 470px;" type="search" placeholder="Search Services" id="displayserv">
              <div id="showservices"></div>
              </form>
              </div>
          </div>
          <div class="col-md-3">
              <div class="dropdown text-end">
                <a href="home.php" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo "Welcome ".$_SESSION['customer_email']?>
                  <img src="images/B6otIn.default.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                  <li><a class="dropdown-item" href="#">Home</a></li>
                  <li><a class="dropdown-item" href="hairstyles.php">Hair Styles</a></li>
                  <li><a class="dropdown-item" href="mensection.php">Men's Care</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
              </div>
        </div>
  </nav>
</header>
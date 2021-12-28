<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {

  header("Location: http://localhost/pro20/adminlogin.php?msg=Kindly Log in to continue.");
}
include 'projectclass/constant.php'

?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Prosper Ibe">
    <title>Admin DashBoard</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link type='text/css' rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    
  </head>
  <body><br>
    <div class="row">
      <a href="admindashboard.php" class="btn btn-success">DASHBOARD</a>
      <div class="col-md-6 offset-3">
        <h4 align="center">Send Email Notifications</h4>

        <?php 
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            }

        ?>
    <form method="post" action="">
          <div class="form-floating mb-3">
             <input type="text" class="form-control rounded-4" id="emailadress" name="emailadress">
             <label for="emailadress">To </label>
          </div>
          <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-4" id="subject" name="subject">
              <label for="subject">Subject</label>
          </div>
          <div class="form-floating">
            <textarea class="form-control" name="body" id="summernote"></textarea>
            <label for="body"></label>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">SEND</button><br>
        </form><br>
      </div>
    </div>

    <script>
      $('#summernote').summernote({
        placeholder: 'Your Message.....',
        tabsize: 2,
        height: 100
      });
    </script>
<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="css/dashboard.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<?php
ob_flush(); 
?>
  </body>
</html>
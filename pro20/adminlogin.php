<?php session_start();
include('css/loginheader.php');
?>
  	<main>

  <?php 
  	// Validating login form;
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
  		
  		if (empty(strip_tags(trim($_POST['Email']))) && empty(strip_tags(trim($_POST['Password'])))) {
  			
  			$errormsg = "<div class='alert alert-danger'>Email and Password field is Empty.</div>";
  		}else{

  			// including class file 
  			include('projectclass/saloonmanagementclass.php');

  			// creating an object of class
  			$objlogin = new SaloonManagement;
  			$result = $objlogin->adminlogin($_POST['Email'], $_POST['Password']);

  			if ($result == true) {

  				var_dump($result);
  				// echo "<pre>";
  				// print_r($result);
  				// echo "</pre>";

  				echo "<div class='alert alert-danger'>Login Succesfull</div>";

  				// setting items in session; 
  				// $_SESSION['fullname'] = $_POST['fullname'];
  				$_SESSION['email'] = $_POST['Email'];
  				// $_SESSION['roleid'] =$_POST['role_id'];

  				// redirecting to a location
  				header("Location: http://localhost/pro20/admindb.php?msg=Succesfully Logged in.");
  				exit;

  			}else{

  						$errormsg = "<div class='alert alert-danger'>Invalid Login Details.</div>";
  		}
  			}
	}
  ?>
  		<div class="container-fluid">
  			<div class="row">
  				<div id="saloon">

	  				<div class="col-md-6 gift offset-1">
	  <?php 
  	// echoing the error message;
  	if (!empty($errormsg)) {
  		echo $errormsg;
  	}
  	?>
	  					<br>
	  					<h3>Amin Login</h3>
	  					<br>
	  					<form method="post" action="" name="registerform" id="registerform">
			          <div class="form-floating mb-3">
			            <input type="email" class="form-control rounded-4" id="floatingInput" placeholder="name@example.com" name="Email" required>
			            <label for="floatingInput">name@example.com</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password" name="Password">
			            <label for="floatingPassword">Password</label>
			          </div>
			          <button class="w-100 mb-2 btn btn-lg btn-primary" id="butt" type="submit" value="Submit">Register</button>
	  					</form>
	  					<a href="" style="text-decoration:none">Forgot your Password?</a>
	  				</div>
  				</div>
  			</div>
  		</div>
  	</main>
  	<?php 
  	include('css/loginfooter.php');
  	?>

<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
      
    $(document).ready(function(){
    	// checking that password is filled

   //  	$('#butt').click(function(){
			// 			var user= $('.rounded-4').val();
			// 			var pass=$('.rounded-4').val();

			// 			if ((user=='') || (pass=='')) {
			// 				alert('Please input your details')
			// 			}
			// })
      
   //  });
    
  </script>
</body>
</html>
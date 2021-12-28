<?php 
session_start();
include 'projectclass/saloonmanagementclass.php';
include('css/loginheader.php');
?>
  	<main>
  		<div class="container-fluid">
  			<div class="row">
  				<div id="saloon">
	  				<div class="col-md-6 gift offset-1">
	  					<br>
	  					<h3>Login</h3>
	  					<h6>Dont have an account? <span><a style="text-decoration:none" href="createaccount.php"> Register</a></span></h6>
	  					<br>
	  	<?php 
	  	// var_dump($_SESSION);
	  	// checking method for submission
	  	if ($_SERVER['REQUEST_METHOD'] == "POST") {
	  		
	  		$errormsg = array();

	  		if (empty($_POST['Email'])) {
	  			$errormsg[] = "Email field is required.";
	  		}

	  		if (empty($_POST['Password'])) {
	  			$errormsg[] = "Password is required.";
	  		}

	  		if (empty($errormsg)) {
	  			
	  			$objlogin = new SaloonManagement;

	  			$output = $objlogin->userlogin($_POST['Email'], $_POST['Password']);

	  			if (!empty($output)) {
	  				// echo "<pre>";
	  				// print_r($output);
	  				// echo "</pre>";
	  				// var_dump($output);

	  				// set items in session

	  				$_SESSION['custid'] = $output['customer_id'];
	  				$_SESSION['customer_name'] = $output['customer_name'];
	  				$_SESSION['custaddress'] = $output['customer_address'];
	  				$_SESSION['customer_email'] = $_POST['Email'];
	  				$_SESSION['custtel'] = $output['customer_tel'];

	  				header("Location: http://localhost/pro20/home.php");
	  				exit;
	  
	 	 }
	 	 else{

	  			echo "<div class='alert alert-danger'>Invalid Username and password</div>";
	  		}			
	  	}
	  	else{

	  		echo "<ul>";

	  		foreach ($errormsg as $key => $value) {
	  			echo "<li>$value</li>";
	  		}

	  		echo "</ul>";
	  	}
	 }

	  	?>
	  		<form method="post" action="">
			    <div class="form-floating mb-3">
			        <input type="email" class="form-control rounded-4" id="floatingInput" placeholder="name@example.com" name="Email">
			        <label for="floatingInput">name@example.com</label>
			    </div>
			    <div class="form-floating mb-3">
			        <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password" name="Password">
			        <label for="floatingPassword">Password</label>
			    </div>
			        <button class="w-100 mb-2 btn btn-lg btn-primary" id="butt" type="submit">Login</button>
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

    	$('#butt').click(function(){
						var user= $('.rounded-4').val();
						var pass=$('.rounded-4').val();

						if ((user=='') || (pass=='')) {
							alert('Please input your details')
						}
			})
      
    });
    
  </script>
</body>
</html>
<?php 
session_start();
include 'projectclass/saloonmanagementclass.php';
include('css/registerheader.php');
?>
  	<main>
  		<div class="container-fluid">
  			<div class="row">
  				<div id="saloon" style="height:950px">
	  				<div class="col-md-6 gift" id="writeup">
	  					<h2 class="featurette-heading">Helping You Find the Best Beauty Palace. </h2>
       					 <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
	  				</div>
	  				<div class="col-md-6 gift" style="height:850px">
	  					<br>
	  					<h3>Register</h3>
	  					<h6>Already have an account? <span><a style="text-decoration:none" href="login.php"> Login</a></span></h6><br>
	  <?php 
	  // form validation
	  if ($_SERVER['REQUEST_METHOD'] == "POST") {
	  	
	  	$errormsg = array();

	  	if (empty($_POST['fullname'])) {
	  		$errormsg[] = "Input your fullname";
	  	}

	  	if (empty($_POST['address'])) {
	  		$errormsg[] = "Address field is required";
	  	}

	  	if (empty($_POST['email'])) {
	  		$errormsg[] = "Email field is required";
	  	}

	  	if (empty($_POST['phonenumber'])) {
	  		$errormsg[] = "Phone Number field is required";
	  	}

	  	if (empty($_POST['password'])) {
	  		$errormsg[] = "This field is required";
	  	}elseif (strlen($_POST['password']) < 7 ) {
	  		$errormsg[] = "Password Must be atleast 7 characters";
	  	}

	  	if (!empty($errormsg)) {
	  		echo "<ul class='alert alert-danger'>";
	  				foreach ($errormsg as $key => $value) {
	  					echo "<li>$value</li>";
	  				}
	  		echo "</ul>";
	  	}else{

	  		$objemail = new SaloonManagement;

	  		if ($objemail->checkEmailaddress($_POST['email']) == true) {
	  			echo "<div class='alert alert-danger'>Email already Taken</div>";
	  		}else{

	  			$result = $objemail->userRegister($_POST['fullname'], $_POST['address'], $_POST['email'], $_POST['phonenumber'], $_POST['password']);

	  			var_dump($result);

	  			$_SESSION['fullname'] = $_POST['fullname'];
	  			$_SESSION['email'] = $_POST['email'];

	  		}

	  	}

	}
?>
	  					<form method="post" action="">
	  					<div class="form-floating mb-3">
				            <input type="text" class="form-control rounded-4" id="Input" name="fullname" placeholder="Enter fullname">
				            <label for="Input">Enter FullName</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="text" class="form-control rounded-4" id="address" placeholder="Enter Address" name="address">
			            <label for="floating">Address</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="email" class="form-control rounded-4" id="floating" placeholder="name@example.com" name="email">
			            <label for="floating">name@example.com</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="text" class="form-control rounded-4" id="phonenumber" placeholder="PhoneNumber" name="phonenumber">
			            <label for="Password">Phone Number</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="password" class="form-control rounded-4" id="Password" placeholder="Password" name="password">
			            <label for="Password">Password</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="password" class="form-control rounded-4" id="Pass" placeholder="Confirm Password" name="ConfirmPassword">
			            <label for="Pass">Confirm Password</label>
			          </div>
			          <input type="checkbox" name="checkbox" id="check">
			          <small class="text-muted">By registering I confirm I have read and agree to <a href="" style="text-decoration: none">Royal Beauty Terms of Use.</a> We send occasional marketing messages which can be switched off in account settings. We manage personal data as set out in our <a href="" style="text-decoration: none">Privacy Notice.</a></small>
			          <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" value="Submit" id='butt' type="submit" disabled>Register</button>
	  					</form>
	  				</div>
  				</div>
  			</div>
  		</div>
  		<?php 
  		include('css/loginfooter.php');
  		?>

  	</main>






<script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">

      $(document).ready(function(){
			// checking property of prop

      	$('#check').click(function(){

				var tick= $('#check').prop('checked')

				if(tick==true){

					$('#butt').prop('disabled',false)
			}
				else{

						$('#butt').prop('disabled',true)
				}
			})

      	// checking password is not empty

      		$('#butt').click(function(){
						var user= $('#floating').val()
						var pass=$('#Password').val()

						if ((user=='') || (pass=='')) {
							alert('Please input your details')
						}
						

						if (true) {}
			})


  })
    
    
  </script>
</body>
</html>
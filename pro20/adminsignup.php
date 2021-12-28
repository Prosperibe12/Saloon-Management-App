<?php 
include('css/registerheader.php');
include('projectclass/saloonmanagementclass.php');
?>
  	<main>
  		<div class="container-fluid">
  			<div class="row">
  				<div id="saloon" style="height:900px">
	  				<div class="col-md-6 gift" id="writeup">
	  					<h2 class="featurette-heading">Helping You Find the Best Beauty Palace. </h2>
       					 <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting prose here.</p>
	  				</div>
	  				<div class="col-md-6 gift" style="min-height:750px">
	  					<br>
	  					<h3 style="color:blue;">Admin Signup</h3>
	  					<small>Please Supply the correct Info</small>
<?php 
		// validating form using $_SERVER
	
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			// validate form fields

			$errormsg = array();

			if (empty($_POST['role'])) {
				$errormsg[]= "Please Select Your Role";
			}

			if (empty($_POST['fullname'])) {
				$errormsg[]= "Your Name Field is Empty";
			}

			if (empty($_POST['Email'])) {
				$errormsg[]= "Email field is empty";
			}

			if (empty($_POST['Password'])) {
				$errormsg[]= "Password Field is Required";
			}elseif (strlen($_POST['Password']) < 8) {
				$errormsg[] = "Password must be atleast 8 Characters";
			}

			if (!empty($errormsg)) {
				echo "<ul class='alert alert-danger alert-dismissible fade-show' role='alert'>";
					foreach ($errormsg as $key => $value) {
						echo "<li>$value</li>";
					}
				echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
				echo "</ul>";
			}else{
				// creating object of user class
				$objreg = new SaloonManagement;
						$result = $objreg->adminsignUp($_POST['role'], $_POST['fullname'], $_POST['Email'],$_POST['Password']);

						var_dump($result);
					}
			}
?>
	  					<form method="post" action="" name="registerform" id="registerform">
	  					<div class="form-floating mb-3">
	  							<label for="Input"></label>
	  								<select class="form-control rounded-4" name="role" id="input">
	  									<option value="">Choose Role</option>
	  									<option value="superadmin">Super Admin</option>
	  									<option value="admin">Admin</option>
	  								</select>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="text" class="form-control rounded-4" id="fullname" placeholder="Enter Address" name="fullname" required>
			            <label for="fullname">Enter Full Name</label>
			          </div>
			          <div class="form-floating mb-3">
			            <input type="email" class="form-control rounded-4" id="floating" placeholder="name@example.com" name="Email" required>
			            <label for="floating">name@example.com</label>
			          </div>
			          
			          <div class="form-floating mb-3">
			            <input type="password" class="form-control rounded-4" id="Password" placeholder="Password" name="Password">
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
	  					<h6>Already a Registerd Admin? <span><a style="text-decoration:none" href="adminlogin.php"> Login</a></span></h6>
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

   //    		$('#butt').click(function(){
			// 			var user= $('#floating').val()
			// 			var pass=$('#Password').val()

			// 			if ((user=='') || (pass=='')) {
			// 				alert('Please input your details')
			// 			}
				
			// })


  })
    
    
  </script>
</body>
</html>
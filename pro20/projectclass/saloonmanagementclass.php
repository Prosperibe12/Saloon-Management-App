<?php 
// Defining my classes;
include('constant.php');

class SaloonManagement{

		public $dbconn;

		// Database connection handler
		function __construct(){

			$this->dbconn = new MySqli(SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

			if ($this->dbconn->connect_error) {
				die('System Encountered an Error'.$this->dbconn->connect_error);
			}else{
				// echo "Connected Succesfully";
			}
		}

		// Creating method for Service-Provider Registration;
		public function agentRegister($name, $address, $email, $phone, $password){

			$password = md5($password);

			$sql= "INSERT INTO saloon_spa (saloon_name, saloon_address, saloon_email,saloon_telephone, saloon_password) VALUES ('$name','$address','$email','$phone','$password')";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				header("Location: http://localhost/pro20/agentlogin.php");
				exit;
			}else{
				echo "Oops! Try again Later";
			}
		}

		// creating method for service-provider login;
		public function agentlogin($email, $password){

			$password = md5($password);

			$sql = "SELECT * FROM saloon_spa WHERE saloon_email='$email' && saloon_password='$password'";
			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)){
				// send a mail to admin
				die("There is a system error, Please check back later ".$this->dbconn->error);
			}
			// fetching associative array;
			$output = $result->fetch_assoc();
			if ($result->num_rows == 1) {
				return $output;
			}else{
				return $output.$this->dbconn->error;
			}
		}

		// checking if email already exist;
		public function checkAgentEmail($email){

			$sql = "SELECT * FROM saloon_spa WHERE saloon_email='$email'";
			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die("There is a system error, Please check back later ".$this->dbcon->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				return true;
			}else{
				return false;
			}
		}

		// method for service provider to add service;
		public function addService($saloonid, $serviceid, $price, $description){

			$sql = "INSERT INTO spa_services(saloon_id, service_id, price, service_desc) VALUES('$saloonid','$serviceid', '$price','$description')";

			// die($sql);

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die("System Error".$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				return true;
			}
			return false;
		}

		// getting all Services displayed on servicetable
		public function getServices(){

			$sql = "SELECT * FROM servicetable";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				// code...
				die('Connection Error');
			}

			$rows= array();

			if ($this->dbconn->affected_rows > 0) {
				// code...

				while ($row=$output->fetch_assoc()) {
					// code...
					$rows[]=$row;
				}
				return $rows;
			}else{
				return $rows;
			}
			
		}


		// creating method for updating saloon image
		public function uploadImage($saloonid){

			// file variables
			$filename = $_FILES['mypix']['name'];
			$file_type = $_FILES['mypix']['type'];
			$file_tmp_name = $_FILES['mypix']['tmp_name'];
			$file_error = $_FILES['mypix']['error'];
			$file_size = $_FILES['mypix']['size'];

			// validating for error
			if (empty($filename)) {
				
				throw new Exception("Please upload a file");
				
			}

			// validating file size
			if ($file_size > 2097152) {
				throw new Exception("Your file size is too big");
			}

			// checking for file extension
			$extensions = array("png", "jpeg", "jpg", "svg", "gif");
			$newfiles = explode(".", $filename);
			$newfile = end($newfiles);

			// checking if exploded format is in array
			if (!in_array(strtolower($newfile), $extensions)) {

				$error = $newfile."File type not supported";

				return $error;
			}

			// uploading the file
			$folder = "images/";
			$newfilename = time().rand().".".$newfile;
			$destination = $folder.$newfilename;
			if (move_uploaded_file($file_tmp_name, $destination)) {
				
				$sql = "UPDATE saloon_spa SET saloon_image='$newfilename' WHERE saloon_id='$saloonid'";

				$output = $this->dbconn->query($sql);

				if (empty($output)) {

					die("Connection Error".$this->dbconn->error);
				}

				if ($this->dbconn->affected_rows == 1) {
					
					return true;
				}else{
					return "Error Uploading File".$this->dbconn->error;
				}
			}
		}

		// creating method to fetch services offered by service provide(display on agent dashboard)
		public function displayServices($saloonid){

			$sql = "SELECT spa_services.saloon_id,spa_services.price,spa_services.service_desc,spa_services.service_status,spa_services.updated_at,servicetable.service_id,servicetable.service_type FROM spa_services 
			JOIN servicetable ON servicetable.service_id=spa_services.service_id 
			WHERE saloon_id='$saloonid'";

			// die($sql);

			$result = $this->dbconn->query($sql);
			$output = array();

			if ($this->dbconn->affected_rows > 0) {
				
				while ($row=$result->fetch_assoc()) {
					$output[]=$row;
				}
				return $output;
			}else{
				return $output;
			}
		}

		// method for agent to update services
		public function agentUpdateService($price, $servicedesc, $servicestat, $saloonid, $serviceid){

			$sql = "UPDATE spa_services SET price='$price',service_desc='$servicedesc',service_status='$servicestat' WHERE saloon_id='$saloonid' AND service_id='$serviceid'";

			$result = $this->dbconn->query($sql);
			$output = array();
			if ($this->dbconn->affected_rows==1) {
				// code...
				$output['success']="Successfully updated";
			}elseif($this->dbconn->affected_rows==0){
				$output['success']="No changes made";
			}else{
				$output['error']="Ooops! Something Happened".$this->dbconn->error;
			}
			return $output;
		}

		// method for agent to view bookings
		public function viewBookings($saloonid){

			// $sql = "SELECT * FROM bookings WHERE saloon_id='$saloonid'";
			$sql = "SELECT * FROM bookings WHERE saloon_id='$saloonid' ORDER BY booking_id DESC";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('There was a Connection Error'.$this->dbconn->error);
			}

			$rows = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $output->fetch_assoc()) {
					$rows[] = $row;
				}
				return $rows;
			}else{
				return $rows;
			}
		}

		// method for agent to accept booking
		public function acceptBooking($bookingid){

			$sql = "UPDATE bookings SET booking_status= 'confirmed' WHERE booking_id='$bookingid'";

			$result = $this->dbconn->query($sql);

			if ($this->dbconn->affected_rows== 1) {

				return true;
			}else{
				return false;
			}
		}

		// --------------admin methods section -----------
		// creating method for admin signup
		public function adminsignUp($role, $fullname, $email, $pass){

			// encrypting the password
			$password = md5($pass);

			$sql = "INSERT INTO admin_table(role_name, fullname, email, password) VALUES ('$role','$fullname','$email','$password')";
			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('System Encountered a Problem'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {

				header("Location: http://localhost/pro20/adminlogin.php?msg=Registration succesfull");
			}else{
				die('Oops, There was a system error.');
			}	
		}

		// creating method for admin login
		public function adminlogin($email, $password){

			// encrypting password
			$pass = md5($password);

			$sql = "SELECT * FROM admin_table WHERE email='$email' AND password='$pass'";
			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row=$result->fetch_assoc()) {
					$output[]=$row;
				}
				return $output;
			}else{
				return $output;
			}
		}

		// method for admin to add service to service table
		public function adminAddService($serviceid, $servicetype){

			$sql = "INSERT INTO servicetable(service_id, service_type) VALUES ('$serviceid','$servicetype')";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				
				die('Connection Error'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				
				return true;
			}

			return false;
		}

		// method for admin to view all service providers
		public function viewServiceProviders(){

			$sql = "SELECT * FROM saloon_spa";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				
				die('Ooops! Connection Error'.$this->dbconn->error);
			}
				$rows = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $output->fetch_assoc()) {
					
					$rows[]= $row;
				}
				return $rows;
			}else{
				return $rows;
			}
		}

		// method for admin to view all booking
		public function adminViewBookings(){

			// $sql = "SELECT * FROM bookings";
			$sql = "SELECT * FROM bookings ORDER BY booking_id ASC";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				
				die('Ooops! Connection Error'.$this->dbconn->error);
			}
				$rows = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $output->fetch_assoc()) {
					
					$rows[]= $row;
				}
				return $rows;
			}else{
				return $rows;
			}
		}

		// method for admin to view users
		public function adminViewCustomer(){

			$sql = "SELECT * FROM customer_details ORDER BY rand()";

			$outcome = $this->dbconn->query($sql);

			$result = array();

			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $outcome->fetch_assoc()) {
					$result[]=$row;
				}

				return $result;
			}else{
				return $result;
			}
		}

			// ---------------methods for users section---------------------------
			// Creating method Users Registration;
		public function userRegister($name, $address, $email, $phone, $password){

			$password = md5($password);

			$sql= "INSERT INTO customer_details (customer_name, customer_address, customer_email,customer_tel, password) VALUES ('$name','$address','$email','$phone','$password')";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {

				// create session variable
				// session_start();
				// session_destroy();
				// $_SESSION['user_id']= $this->dbconnect->insert_id;
				// $_SESSION['fullname']=$name;
				// $_SESSION['email']=$email;

				header("Location: http://localhost/pro20/login.php");
				exit;
			}else{
					echo "Oops! Try again Later";
			}
		}

		// checking if email already exist

		public function checkEmailaddress($email){
			// write query
			$sql = "SELECT emailaddress FROM customer_details WHERE customer_email='$email'";
			$result = $this->dbconn->query($sql);

			if ($this->dbconn->affected_rows == 1) {
				// code...
				return true;
			}else{
				return false;
			}
		}

		// method for users login
		public function userlogin($email, $password){

			$pass = md5($password);

			$sql = "SELECT * FROM customer_details WHERE customer_email='$email' AND password='$pass'";
			$output = $this->dbconn->query($sql);

				// $row = array();
			if ($this->dbconn->affected_rows == 1) {
				
				$row = $output->fetch_assoc();
					
				return $row;
				//return true;
			}
			// else{
			// 	return $row.$this->dbconn->error;
			// }
			return false;
		}

		// method to display dynamic page for each saloon
		public function serviceProviderPage($saloonid){

			$sql = "SELECT spa_services.*,servicetable.service_type,saloon_spa.saloon_name,saloon_spa.saloon_address,saloon_spa.saloon_email,saloon_spa.saloon_telephone,saloon_spa.saloon_image,saloon_spa.account_status FROM spa_services
				LEFT JOIN servicetable ON servicetable.service_id=spa_services.service_id
				LEFT JOIN saloon_spa ON saloon_spa.saloon_id=spa_services.saloon_id 
				WHERE spa_services.saloon_id='$saloonid'";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('There was a Connection Error'.$this->dbconn->error);
			}

				$rows = array();
			if ($this->dbconn->affected_rows > 1) {
				
				while ($row = $output->fetch_assoc()) {
					$rows[] = $row; 
				}

				return $rows;
			}else{
				return $rows;
			}
		}

		// method to display dynamic homepage
		public function homePage(){

			$sql = "SELECT * FROM saloon_spa order by rand()";

			$result = $this->dbconn->query($sql);

				$output = array();
			if ($this->dbconn->affected_rows > 1) {
				
				while ($rows = $result->fetch_assoc()) {
					$output[] = $rows;
				}
				return $output;
			}else{
				return $output;
			}
		}

		// method to display section page for men
		public function menSection(){

			$sql = "SELECT * FROM saloon_spa WHERE category = 'men'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to display section page for men
		public function womenSection(){

			$sql = "SELECT * FROM saloon_spa WHERE category = 'women'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[] = $row;
				}

				return $output;
			}else{
				return $output;
			}
		}


		// method to search for services
		public function searchService($searchservice){

			$sql = "SELECT * FROM servicetable WHERE service_type like '%$searchservice%'";
			// var_dump($sql);
			$result = $this->dbconn->query($sql);

			$rows= array();

			if ($this->dbconn->affected_rows > 0) {
				// code...

				while ($row=$result->fetch_assoc()) {
					// code...
					$rows[]=$row;
				}
				return $rows;
			}else{
				return $rows;
			}
		}

		// methods for users to book service
		// public function userbooking($customerid,$customeremail, $servicetype, $bookingdate,$bookingtime, $saloonid){

		// 	$sql = "INSERT INTO bookings(customer_id,saloon_id, service_type, customer_email, booking_time, booking_date) VALUES ('$customerid','$saloonid','$servicetype','$customeremail','$bookingtime','$bookingdate')";

		// 	$result = $this->dbconn->query($sql);

		// 	if (!empty($this->dbconn->error)) {
		// 		die('Connection Error'.$this->dbconn->error);
		// 	}

		// 	if ($this->dbconn->affected_rows == 1) {
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
			
		// }

		// updated method for booking
		public function userbooking($customerid, $saloonid, $servicetype, $customeremail, $bookingtime, $bookingdate){

			$sql = "INSERT INTO bookings(customer_id,saloon_id, service_type, customer_email, booking_time, booking_date) VALUES ('$customerid','$saloonid','$servicetype','$customeremail','$bookingtime','$bookingdate')";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {

				session_start();

				$_SESSION['booking_id']= $this->dbconn->insert_id;
				$_SESSION['servicetype'] = $servicetype;

				header("Location: http://localhost/pro20/bookingsummary.php");
                exit;
			}else{
				return "Oops!Booking was not completed";
			}
			
		}

		// checking if time choosen has been used by previous user
		public function checkTime($bookingtime){

			$sql = "SELECT booking_time FROM bookings WHERE booking_time='$bookingtime'";
			$result = $this->dbconn->query($sql);

			if ($this->dbconn->affected_rows == 1) {
				// code...
				return true;
			}else{
				return false;
			}
		}

		// method for booking summary
		public function bookingSummary($bookingid){

			$sql = "SELECT bookings.*,spa_services.saloon_id,spa_services.service_id,spa_services.service_desc,spa_services.price,saloon_spa.saloon_name,saloon_spa.saloon_email,saloon_spa.saloon_telephone,saloon_spa.saloon_address,saloon_spa.saloon_image FROM bookings
				LEFT JOIN spa_services ON spa_services.saloon_id=bookings.saloon_id
				LEFT JOIN saloon_spa ON saloon_spa.saloon_id=bookings.saloon_id
				WHERE booking_id = '$bookingid'";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {

				die("Error connecting to server".$this->dbconn->error);
			}
				// $rows = array();
			if ($this->dbconn->affected_rows > 0) {
				
				$row = $output->fetch_assoc();
					
				return $row;
			}

			return false;
		}

		// method for saving cash transaction
		function cashPay($bookingid, $saloonid, $servicetype, $price, $customeremail, $paymode){

			$sql = "INSERT INTO cashpayment(booking_id, saloon_id, service_type, price, customer_email, payment_mode) VALUES ('$bookingid','$saloonid','$servicetype','$price','$customeremail','$paymode')";

			$response = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				return true;
			}else{
				return false;
			}
		}

		// ----------Method for all paystack transaction-----------//
		// paystack payment method
		public function userinitializepaystack($email, $amount){

			$url = "https://api.paystack.co/transaction/initialize";
			$reference = "IPI".time().rand();
			$callbackurl = "http://localhost/pro20/usercallback.php";

			$fields = [
		    'email' => $email,
		    'amount' => $amount * 470 * 100,
		    'reference' => $reference,
		    'callback_url' => $callbackurl
		  	];

		  	$fields_string = http_build_query($fields);
		  	$secretkey = "sk_test_e5247a3d48a8ceaa0940d847fc47c3458aec92ca";

		  	//open connection
  			$ch = curl_init();

  			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, true);
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			 "Authorization: Bearer $secretkey",
			 "Cache-Control: no-cache",
			  ));

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //we used this to ignore SSL certificate since our site is on local host. But for live projects, enable "true"
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			// step3 execute connection
			$response = curl_exec($ch);

			// validate or check if there is anything inside it
			if (curl_error($ch)) {
			 	echo curl_error($ch);
			}

			// step4 close connection
			curl_close($ch);

			// step 5: convert json to object
			 $result = json_decode($response);

			return $result;

		}

		// inserting transaction details to database
		public function insertPaystackDetails($bookingid, $custemail, $amount, $servicetype, $transref){

			$paymentmode = "paystack";
			$status = "pending";
			$datepaid = date('Y-m-d h:i:s');

			$sql = "INSERT INTO onlinpayment_ref(booking_id, customer_email, amount, service_type, datepaid, payment_mode, transref, status) VALUES ('$bookingid','$custemail','$amount','$servicetype','$datepaid','$paymentmode','$transref','$status')";

			$response = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				return true;
			}else{
				return false;
			}
		}

		// verifying paystack transaction
		public function verifyUserPayment($reference){

			$url = "https://api.paystack.co/transaction/verify/".$reference;
			$secretkey = "sk_test_e5247a3d48a8ceaa0940d847fc47c3458aec92ca";

			// step 1: open connection
			$ch = curl_init();

			// step 2: set curl options
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Authorization: Bearer $secretkey",
			"Cache-Control: no-cache",
			));	
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //we used this to ignore SSL certificate since our site is on local host. But for live projects, enable "true"
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			// step 3 
			$response = curl_exec($ch);

			// validate or check if there is anything inside it
			if (curl_error($ch)) {
				echo curl_error($ch);
			}

			// step4 
			curl_close($ch);

			// step 5: convert json to object
			$result = json_decode($response);

			return $result;
		}

		// method for verifying user payment
		public function updateUserPayment($reference){

			$sql = "UPDATE onlinpayment_ref SET status='completed' WHERE transref = '$reference'";

			$output = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {

				die('Connection Error'.$this->dbconn->error);
			}

			if ($this->dbconn->affected_rows == 1) {
				return true;
			}else{
				return false;
			}
		}

		// -----------Analytics sections(service provider)-------------------

		// method to echo pending bookings on agent dashboard
		public function viewPendingBookings($saloonid){

			$sql = "SELECT COUNT(booking_status) FROM bookings WHERE booking_status = 'pending' AND saloon_id='$saloonid'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}
				$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {

					$output[]= $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to echo confirmed bookings on agent dashboard
		public function viewConfirmedBookings($saloonid){

			$sql = "SELECT COUNT(booking_status) FROM bookings WHERE booking_status = 'confirmed' AND saloon_id='$saloonid'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}
				$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {

					$output[]= $row;
				}

				return $output;
			}else{
				return $output;
			}
		}


		// method to echo total bookings on agent dashboard
		public function viewTotalBookings($saloonid){

			$sql = "SELECT COUNT(booking_status) FROM bookings WHERE saloon_id='$saloonid'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}
				$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {

					$output[]= $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to echo total bookings on agent dashboard
		public function viewRecentBookings($saloonid){

			$sql = "SELECT * FROM bookings WHERE DATE_SUB(CURDATE(),INTERVAL 5 DAY) = booking_date AND saloon_id ='$saloonid'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}
				$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {

					$output[]= $row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to see no of offeres service
		public function ViewNoOfferS($saloonid){

			$sql = "SELECT COUNT(service_id) FROM spa_services WHERE saloon_id='$saloonid'";

			$resultado = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$outcome = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($row = $resultado->fetch_assoc()) {
					$outcome[]=$row;
				}
				return $outcome;
			}else{
				return $outcome;
			}
		}

		// method to see cash revenue
		public function viewCashRev($saloonid){

			$sql = "SELECT SUM(price) FROM cashpayment WHERE saloon_id='$saloonid'";

			$resultado = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$outcome = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($row = $resultado->fetch_assoc()) {
					$outcome[]=$row;
				}
				return $outcome;
			}else{
				return $outcome;
			}
		}

		// method to view daily rev by saloons
		public function viewDailyRev($saloonid){

			$sql = "SELECT SUM(price) FROM cashpayment WHERE saloon_id='$saloonid' AND DATE_SUB(CURDATE(),INTERVAL 1 DAY)";

			$resultado = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$outcome = array();
			if ($this->dbconn->affected_rows > 0) {
				while ($row = $resultado->fetch_assoc()) {
					$outcome[]=$row;
				}
				return $outcome;
			}else{
				return $outcome;
			}
		}

		// -----------Analytics Section(Admin)------------
		// method to display total number of bookings
		public function adminViewAllBookings(){

			$sql = "SELECT COUNT(booking_status) FROM bookings";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to display pending bookings
		public function adminViewPendingBookings(){

			$sql = "SELECT COUNT(booking_status) FROM bookings WHERE booking_status='pending'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to display confirmed bookings
		public function adminViewConfirmedBookings(){

			$sql = "SELECT COUNT(booking_status) FROM bookings WHERE booking_status='confirmed'";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count service providers
		public function adminCountSp(){

			$sql = "SELECT COUNT(saloon_name) FROM saloon_spa";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count services
		public function adminCountServe(){

			$sql = "SELECT COUNT(service_type) FROM servicetable";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to see total paystack payment
		public function adminViewPay(){

			$sql = "SELECT SUM(amount) FROM onlinpayment_ref";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to see total cash payment
		public function adminViewCash(){

			$sql = "SELECT SUM(price) FROM cashpayment";

			$result = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Error Connecting to server'.$this->dbconn->error);
			}

			$output = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $result->fetch_assoc()) {
					$output[]=$row;
				}

				return $output;
			}else{
				return $output;
			}
		}

		// method to count total active customer
		public function adminViewUser(){

			$sql = "SELECT COUNT(customer_name) FROM customer_details WHERE account_status = 'active'";

			$customer = $this->dbconn->query($sql);

			if (!empty($this->dbconn->error)) {
				die('Connection Error'.$this->dbconn->error);
			}

			$connectado = array();
			if ($this->dbconn->affected_rows > 0) {
				
				while ($row = $customer->fetch_assoc()) {
					$connectado[] = $row;
				}

				return $connectado;
			}else{
				return $connectado;
			}
		}



}
?>
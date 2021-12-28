<?php 
include 'constant.php';

/**
 * 
 */
class Payment {
	
	public $amount;
	public $email;
	public $dbconn;

	function __construct(){
		
		$this->dbconn = new MySqli(SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

		if ($this->dbconn->connect_error) {
			
			die("System Encountered a Problem".$this->dbconn->connect_error);
		}else{
			// Connected Succesfully.
		}
	}

	// Paystack Initialization
	// 1st leg initialization
	public function initializePaystack($email, $amount){

			$url = "https://api.paystack.co/transaction/initialize";

			$reference = "SLN".time().rand(); 
			$callbackurl = "http://localhost/pro20/projectclass/paystackcallback.php";

			$fields = [
		    'email' => $email,
		    'amount' => $amount * 100,
		    'reference' => $reference,
		    'callback_url' => $callbackurl
		  	];

		  	$fields_string = http_build_query($fields);
		  	$secretkey = "sk_test_e5247a3d48a8ceaa0940d847fc47c3458aec92ca";

		  	// step1 open connection step1
		  	$ch = curl_init();

		  	// step2 set the urls, number of POST vars, POST data
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

	// inserting into database table
	public function insertTransactionDetails($saloonname, $amount, $reference){

		$paymentmode = "paystack";
		$status = "pending";
		$dueyear = "2021";
		$datepaid = date('Y-m-d h:i:s');

		$sql = "INSERT INTO saloon_payment(saloon_name, amount, payment_year, datepaid, paymentmode, transref, status) VALUES ('$saloonname','$amount','$dueyear','$datepaid','$paymentmode','$reference','$status')";

		$response = $this->dbconn->query($sql);
		if($this->dbconn->error){
			die($this->dbconn->error);
		}

		if ($this->dbconn->affected_rows == 1) {
			
			return true;
		}else{

			return false;
		}
	}

	// method for verifying transaction
	public function verifyPaystack($reference){

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

	// update payment transaction details
	public function updateTransactionDetails($reference) {

		$sql = "UPDATE saloon_payment SET status='completed' WHERE transref='$reference'";

		$result = $this->dbconn->query($sql);
		if ($this->dbconn->affected_rows == 1) {
				return true;
		}
		else {
			return false;
		}
	}
}
?>
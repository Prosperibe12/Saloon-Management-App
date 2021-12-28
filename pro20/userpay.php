<?php 
ob_start();
session_start();
if (!empty($_SESSION['custid']) && !empty($_SESSION['customer_email'])) {
  include 'css/signinheader.php';
}else{
  include('css/header.php');
}
include 'projectclass/saloonmanagementclass.php';
?><br><br><br><br>
<main>
	<div class="container-fluid">
		<div class="row">
			<div class="alert alert-success" style="text-align: center;">Welcome <?php echo $_SESSION['customer_email']?></div>
			<div class="col-md-6 offset-5">
				<small>Click on Pay to continue with your Payment</small><br>
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						
						$objinitialise = new SaloonManagement;

						$init = $objinitialise->userinitializepaystack($_SESSION['customer_email'],$_SESSION['amount']);

						echo "<pre>";
						print_r($init->data->authorization_url);
						echo "</pre>";

						$redirect = $init->data->authorization_url;
						$reference = $init->data->reference;

						if (!empty($redirect)) {
							
							if ($objinitialise->insertPaystackDetails($_SESSION['booking_id'],$_SESSION['customer_email'],$_SESSION['amount'],$_SESSION['servicetype'],$reference)) {
								
								header("Location: $redirect");
							}
						}
					}
				?>
				<form method="post" action="">
					<br>
					<label>You are about to be debited $<?php echo $_SESSION['amount']?></label><br>
					<input type="hidden" name="bookingid" value="<?php echo $_SESSION['booking_id']?>">
					<input type="hidden" name="email" value="<?php echo $_SESSION['customer_email']?>">
					<input type="hidden" name="amount" value="<?php echo $_SESSION['amount']?>">
					<input type="hidden" name="servicetype" value="<?php echo $_SESSION['servicetype']?>">
					<button class="btn btn-primary" type="submit">PAY</button>
				</form>
				<br><br>
				<small>This site is secure and your details are not stored.</small>
			</div>
		</div>
	</div>
</main>
<?php 
ob_flush();
?>
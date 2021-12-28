<?php 

var_dump($_REQUEST);
include("paymentclass.php");

$payobj = new Payment;
$outcome = $payobj->verifyPaystack($_REQUEST['reference']);

if ($outcome->data->status==='success') {
	$updatetrans = $payobj->updateTransactionDetails($_REQUEST['reference']);

	if ($updatetrans === true) {
		header("Location: http://localhost/pro20/agentdashboard.php");
		exit;
	}
}

echo "<pre>";
print_r($output);
echo "</pre>";
?>
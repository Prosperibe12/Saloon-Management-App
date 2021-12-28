<?php 
var_dump($_REQUEST);

include('projectclass/saloonmanagementclass.php');

	$objverify = new SaloonManagement;

	$output = $objverify->verifyUserPayment($_REQUEST['reference']);

		if ($output->data->status === 'success') {
			
			$updateref = $objverify->updateUserPayment($_REQUEST['reference']);

			if ($updateref === true) {
					
				header("Location: http://localhost/pro20/home.php?msg=Succesfully booked");
					exit;
			}
		}

echo "<pre>";
print_r($output);
echo "</pre>";
?>
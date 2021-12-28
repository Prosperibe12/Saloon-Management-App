<?php 
include 'projectclass/saloonmanagementclass.php';


$objsearch = new SaloonManagement;

	if (!empty($_REQUEST['names'])) {
		
		$output = $objsearch->searchService($_REQUEST['names']);

		if (!empty($output)) {
			
			foreach ($output as $key => $value) {
?>
	<div style="background-color: white;border-radius: 5px;">
		<?php echo $value['service_type']?>
	</div>
	<?php 
		}
	}
}
?> 



			

		




              
              
              
              
              
              
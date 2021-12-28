<?php 
session_start();
session_destroy();

header("Location: adminlogin.php?msg=Login in to Continue");

?>
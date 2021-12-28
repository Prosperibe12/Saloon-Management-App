<?php 
session_start();
session_destroy();

header("Location: agentlogin.php?msg=Login in to Continue");

?>
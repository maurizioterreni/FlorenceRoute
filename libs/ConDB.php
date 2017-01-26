<?php
include_once "def_var.php";
$con=mysqli_connect(nomehost,nomeuser,password,nomedb);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
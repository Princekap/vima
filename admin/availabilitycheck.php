<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.html');
} else {

	if(!empty($_POST["idnumber"]) ) {
		$idnumber=$_POST["idnumber"];

		$sql= "SELECT idnumber FROM records WHERE idnumber = :idnumber";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':idnumber',$idnumber, PDO::PARAM_STR);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			echo "<span style='color:red'> ID Number already given </span>";

		}else
		{ 
			echo "<span style='color:green'> Available</span>";            
		}

		}
} ?>
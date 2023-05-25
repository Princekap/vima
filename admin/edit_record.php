<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.html');
} else {

	
	if(isset($_GET['edit']))
	{
		$editid=$_GET['edit'];
	}

	if (isset($_POST['submit']) && $_POST['randcheck']==$_SESSION['rand']) {
	
		$fullname = $_POST['fullname'];
		$dob = $_POST['dob'];
		$Gender = $_POST['Gender'];
		 $Passport_Picture = "";
		$idnumber = $_POST['idnumber'];
		$parentsalive = $_POST['parentsalive'];
		$fatherfullname = $_POST['fatherfullname'];
		$fatherresisdence = $_POST['fatherresisdence'];
		$fatheroccupation = $_POST['fatheroccupation'];
		$fatheragebracket = $_POST['fatheragebracket'];
		$fathercontact = $_POST['fathercontact'];
	 $fatherpicture = "";
		$motherfullname = $_POST['motherfullname'];
		$motherresisdence = $_POST['motherresisdence'];
		$motheroccupation = $_POST['motheroccupation'];
		$motheragebracket = $_POST['motheragebracket'];
		$mothercontact = $_POST['mothercontact'];
		 $motherpicture = "";
		$guardianfullname = $_POST['guardianfullname'];
		$guardianresisdence = $_POST['guardianresisdence'];
		$guardianoccupation = $_POST['guardianoccupation'];
		$guardianagebracket = $_POST['guardianagebracket'];
		$guardiancontact = $_POST['guardiancontact'];
		$guardianpicture = "";
		$emergencyname = $_POST['emergencyname'];
		$emergencycontact = $_POST['emergencycontact'];
		$sponsorship = $_POST['sponsorship'];
		$sponsorname = $_POST['sponsorname'];
		$sponsorresisdence = $_POST['sponsorresisdence'];
		$sponsorgender = $_POST['sponsorgender'];
		$sponsormarried = $_POST['sponsormarried'];
		$nameofspouse = $_POST['nameofspouse'];
		 $sponsorpicture = "";
		$sponsorcontact = $_POST['sponsorcontact'];
		$benefitfrom = $_POST['benefitfrom'];
		$benefitto = $_POST['benefitto'];
		$educationlevel = $_POST['educationlevel'];
		$other_info = $_POST['other_info'];
		$childresidence = $_POST['childresidence'];
		$spondorshipstatus=$_POST['spondorshipstatus'];


		$file = $_FILES['Passport_Picture']['name'];
		$file_loc = $_FILES['Passport_Picture']['tmp_name'];
		$folder="uploads/primary/"; 
		$new_file_name = $idnumber.'_'.strtolower($file);
		$final_file=str_replace(' ','-',$new_file_name);

		if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$Passport_Picture=$final_file;
		}

		$father = $_FILES['fatherpicture']['name'];
		$mother = $_FILES['motherpicture']['name'];
		$guardian = $_FILES['guardianpicture']['name'];
		$fatherfile_loc = $_FILES['fatherpicture']['tmp_name'];
		$motherfile_loc = $_FILES['motherpicture']['tmp_name'];
		$guardianfile_loc = $_FILES['guardianpicture']['tmp_name'];
		$parentfolder="uploads/parents/"; 
		$father_file_name = $idnumber.'_f_'.strtolower($father);
		$mother_file_name = $idnumber.'_m_'.strtolower($mother);
		$guardian_file_name = $idnumber.'_g_'.strtolower($guardian);

		$father_file=str_replace(' ','-',$father_file_name);
		$mother_file=str_replace(' ','-',$mother_file_name);
		$guardian_file=str_replace(' ','-',$guardian_file_name);

		if(move_uploaded_file($fatherfile_loc,$parentfolder.$father_file))
		{
			$fatherpicture=$father_file;
		}
		if(move_uploaded_file($motherfile_loc,$parentfolder.$mother_file))
		{
			$motherpicture=$mother_file;
		}
		if(move_uploaded_file($guardianfile_loc,$parentfolder.$guardian_file))
		{
			$guardianpicture=$guardian_file;
		}

		$sponsor = $_FILES['sponsorpicture']['name'];
		$sponsor_loc = $_FILES['sponsorpicture']['tmp_name'];
		$sponsorfolder="uploads/sponsor/"; 
		$sponsor_file_name = $idnumber.'_s_'.strtolower($sponsor);
		$sponsor_file=str_replace(' ','-',$sponsor_file_name);

		if(move_uploaded_file($sponsor_loc,$sponsorfolder.$sponsor_file))
		{
			$sponsorpicture=$sponsor_file;
		}

		if (empty($_FILES['Passport_Picture']['name'])) {$childPicture = '';$childPictureParam='oldContents';} else {$childPicture='Passport_Picture=(:Passport_Picture),';$childPictureParam='';}
		if (empty($_FILES['fatherpicture']['name'])) {$fatherPicture = '';$fatherPictureParam='oldContents';} else {$fatherPicture='fatherpicture=(:fatherpicture),';$fatherPictureParam='';}
		if (empty($_FILES['motherpicture']['name'])) {$motherPicture = '';$motherPictureParam='oldContents';} else {$motherPicture='motherpicture=(:motherpicture),';$motherPictureParam='';}
		if (empty($_FILES['guardianpicture']['name'])) {$guardianPicture = '';$guardianPictureParam='oldContents';} else {$guardianPicture='guardianpicture=(:guardianpicture),';$guardianPictureParam='';}
		if (empty($_FILES['sponsorpicture']['name'])) {$sponsorPicture = '';$sponsorPictureParam='oldContents';} else {$sponsorPicture='sponsorpicture=(:sponsorpicture),';$sponsorPictureParam='';}



		$sql = "UPDATE records SET
fullname=(:fullname),
dob=(:dob),
Gender=(:Gender),
$childPicture
idnumber=(:idnumber),
parentsalive=(:parentsalive),
fatherfullname=(:fatherfullname),
fatherresisdence=(:fatherresisdence),
fatheroccupation=(:fatheroccupation),
fatheragebracket=(:fatheragebracket),
fathercontact=(:fathercontact),
$fatherPicture
motherfullname=(:motherfullname),
motherresisdence=(:motherresisdence),
motheroccupation=(:motheroccupation),
motheragebracket=(:motheragebracket),
mothercontact=(:mothercontact),
$motherPicture
guardianfullname=(:guardianfullname),
guardianresisdence=(:guardianresisdence),
guardianoccupation=(:guardianoccupation),
guardianagebracket=(:guardianagebracket),
guardiancontact=(:guardiancontact),
$guardianPicture
emergencyname=(:emergencyname),
emergencycontact=(:emergencycontact),
sponsorship=(:sponsorship),
spondorshipstatus=(:spondorshipstatus),
sponsorname=(:sponsorname),
sponsorresisdence=(:sponsorresisdence),
sponsorgender=(:sponsorgender),
sponsormarried=(:sponsormarried),
nameofspouse=(:nameofspouse),
$sponsorPicture
sponsorcontact=(:sponsorcontact),
benefitfrom=(:benefitfrom),
benefitto=(:benefitto),
educationlevel=(:educationlevel),
other_info=(:other_info),
childresidence=(:childresidence)
				 
			WHERE id=:editid ";

		$query = $dbh->prepare($sql);

		$query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$query->bindParam(':dob', $dob, PDO::PARAM_STR);
		$query->bindParam(':Gender', $Gender, PDO::PARAM_STR);
		if(empty($childPictureParam)){$query->bindParam(':Passport_Picture', $Passport_Picture, PDO::PARAM_STR);}else{}
		$query->bindParam(':idnumber', $idnumber, PDO::PARAM_STR);
		$query->bindParam(':parentsalive', $parentsalive, PDO::PARAM_STR);
		$query->bindParam(':fatherfullname', $fatherfullname, PDO::PARAM_STR);
		$query->bindParam(':fatherresisdence', $fatherresisdence, PDO::PARAM_STR);
		$query->bindParam(':fatheroccupation', $fatheroccupation, PDO::PARAM_STR);
		$query->bindParam(':fatheragebracket', $fatheragebracket, PDO::PARAM_STR);
		$query->bindParam(':fathercontact', $fathercontact, PDO::PARAM_STR);
		if(empty($fatherPictureParam)){$query->bindParam(':fatherpicture', $fatherpicture, PDO::PARAM_STR);}else{}
		$query->bindParam(':motherfullname', $motherfullname, PDO::PARAM_STR);
		$query->bindParam(':motherresisdence', $motherresisdence, PDO::PARAM_STR);
		$query->bindParam(':motheroccupation', $motheroccupation, PDO::PARAM_STR);
		$query->bindParam(':motheragebracket', $motheragebracket, PDO::PARAM_STR);
		$query->bindParam(':mothercontact', $mothercontact, PDO::PARAM_STR);
		if(empty($motherPictureParam)){$query->bindParam(':motherpicture', $motherpicture, PDO::PARAM_STR);}else{}
		$query->bindParam(':guardianfullname', $guardianfullname, PDO::PARAM_STR);
		$query->bindParam(':guardianresisdence', $guardianresisdence, PDO::PARAM_STR);
		$query->bindParam(':guardianoccupation', $guardianoccupation, PDO::PARAM_STR);
		$query->bindParam(':guardianagebracket', $guardianagebracket, PDO::PARAM_STR);
		$query->bindParam(':guardiancontact', $guardiancontact, PDO::PARAM_STR);
		if(empty($guardianPictureParam)){$query->bindParam(':guardianpicture', $guardianpicture, PDO::PARAM_STR);}else{}
		$query->bindParam(':emergencyname', $emergencyname, PDO::PARAM_STR);
		$query->bindParam(':emergencycontact', $emergencycontact, PDO::PARAM_STR);
		$query->bindParam(':sponsorship', $sponsorship, PDO::PARAM_STR);
		$query->bindParam(':spondorshipstatus',$spondorshipstatus, PDO::PARAM_STR);
		$query->bindParam(':sponsorname', $sponsorname, PDO::PARAM_STR);
		$query->bindParam(':sponsorresisdence', $sponsorresisdence, PDO::PARAM_STR);
		$query->bindParam(':sponsorgender', $sponsorgender, PDO::PARAM_STR);
		$query->bindParam(':sponsormarried', $sponsormarried, PDO::PARAM_STR);
		$query->bindParam(':nameofspouse', $nameofspouse, PDO::PARAM_STR);
		if(empty($sponsorPictureParam)){$query->bindParam(':sponsorpicture', $sponsorpicture, PDO::PARAM_STR);}else{}
		$query->bindParam(':sponsorcontact', $sponsorcontact, PDO::PARAM_STR);
		$query->bindParam(':benefitfrom', $benefitfrom, PDO::PARAM_STR);
		$query->bindParam(':benefitto', $benefitto, PDO::PARAM_STR);
		$query->bindParam(':educationlevel', $educationlevel, PDO::PARAM_STR);
		$query->bindParam(':other_info', $other_info, PDO::PARAM_STR);
		$query->bindParam(':childresidence', $childresidence, PDO::PARAM_STR);
		$query->bindParam(':editid', $editid, PDO::PARAM_STR);


		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		$msg="Information Updated Successfully";


		}

?>





	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Update Records</title>

		<!-- Font awesome -->
		<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type='text/css'>
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">

		<script type="text/javascript" src="../vendor/countries.js"></script>
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #dd3d36;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #5cb85c;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.showfather {

				display: none;
				/* margin-top: 20px; */
			}

			.showmother {

				display: none;
				/* margin-top: 20px; */
			}

			.showguardian {

				display: none;
				/* margin-top: 20px; */
			}

			.showsponsor {
				display: none;
			}
		</style>

	</head>

	<body>
	<?php
		$sql = "SELECT * from records where id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h3 class="page-title text-center">Update : <?php echo htmlentities($result->fullname); ?></h3>
							<div class="row">
								<div class="col-md-12">
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<form method="post" class="form-horizontal" action="" enctype="multipart/form-data">
									<div class="form-group">
										<?php
	$rand=rand();
	$_SESSION['rand']=$rand;

?>
											<div class="col-sm-4">
	                                        </div>
											<div class="col-sm-4 text-center">
		<img src="uploads/primary/<?php echo htmlentities($result->Passport_Picture);?>" style="width:150px; height:150px margin:10px;">
		<input type="file" name="Passport_Picture" class="form-control" >
		<!-- <input type="hidden" name="Passport_Picture" class="form-control" value="<?php //echo htmlentities($result->Passport_Picture);?>"> -->
		<input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />

	</div>
	<div class="col-sm-4">
	</div>
		</div>	

										<!-- CHILD INFORMATION -->
										<div class="panel panel-default">
											<div class="panel-heading text-center">PRIMARY INFORMATION</div>
											<div class="panel-body">
						<div class="form-group">
													<label class="col-sm-2 control-label">FullName<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" placeholder="Full Name" name="fullname" class="form-control" value="<?php echo htmlentities($result->fullname);?>" required>
													</div>

													<label class="col-sm-2 control-label">Date of Birth<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="date" name="dob" class="form-control" value="<?php echo htmlentities($result->dob);?>" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select name="Gender" class="form-control" required>
															<option value="<?php echo htmlentities($result->Gender);?>"><?php echo htmlentities($result->Gender);?></option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
													</div>

										
													<label for="email" class="col-sm-2 control-label"> Place of Residence </label>
													<div class="col-sm-4 select-editable">
														<select class="form-control" id="childresidence" onchange="this.nextElementSibling.value=this.value ">
															<option value="VIMA">VIMA Home</option>
															<option value="VIMA_Annex">VIMA Home Annex</option>

														</select>
														<input type="text" value="<?php echo htmlentities($result->childresidence);?>" class="form-control" name="childresidence" placeholder="Place of Residence" />

													</div>

												</div>


												<div class="form-group">
													<label class="col-sm-2 control-label">ID Number<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" placeholder="ID Number" value="<?php echo htmlentities($result->idnumber);?>" name="idnumber" class="form-control" required>
													</div>

													<label class="col-sm-2 control-label" for="Old">Parents Alive</label>
													<div class="col-sm-4">

														<label class="radio-inline">
															<input type="radio" name="parentsalive" class="parentsalive" value="BOTH" onclick="showboth()" 
															<?php if ($result->parentsalive == "BOTH") echo "checked"; ?>
															/>BOTH </label>

														<label class="radio-inline">
															<input type="radio" name="parentsalive" class="parentsalive" value="FATHER" onclick="showfather()"
															<?php if ($result->parentsalive == "FATHER") echo "checked"; ?>
															/>FATHER
														</label>
														<label class="radio-inline">
															<input type="radio" name="parentsalive" class="parentsalive" value="MOTHER" onclick="showmother()" 
															<?php if ($result->parentsalive == "MOTHER") echo "checked"; ?>
															/>MOTHER
														</label>
														<label class="radio-inline">
															<input type="radio" name="parentsalive" class="parentsalive" value="NONE" onclick="showguardian()" 
															<?php if ($result->parentsalive == "NONE") echo "checked"; ?>
															/>NONE
														</label>

													</div>

												</div>
											

											</div>
										</div>


										<!-- CHILD GUARDIAN  INFORMATION -->

										<div class="panel panel-default">
											<div class="panel-heading text-center">PARENT/GUARDIAN INFORMATON</div>
											<div class="panel-body">

												<div class="showfather" id="fathersbox">
													<!-- FATHERS BOX -->
													<div class="form-group">
														<label class="col-sm-2 control-label">Father's FullName<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Father's Name" value="<?php echo htmlentities($result->fatherfullname);?>" name="fatherfullname" class="form-control">
														</div>

														<label class="col-sm-2 control-label">Place of Residence</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Place of Residence" value="<?php echo htmlentities($result->fatherresisdence);?>" name="fatherresisdence" class="form-control">
														</div>
													</div>


													<div class="form-group">

														<label class="col-sm-2 control-label">Occupation</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Father's Occupation" value="<?php echo htmlentities($result->fatheroccupation);?>" name="fatheroccupation" class="form-control">
														</div>
														<label class="col-sm-2 control-label">Age Bracket</label>
														<div class="col-sm-4">
															<select name="fatheragebracket" class="form-control">
																<option value="<?php echo htmlentities($result->fatheragebracket);?>" ><?php echo htmlentities($result->fatheragebracket);?></option>
																<option value="18-25">18-25</option>
																<option value="26-30">26-30</option>
																<option value="31-35">31-35</option>
																<option value="36-45">36-45</option>
																<option value="above 45">above 45</option>
															</select>
														</div>

													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Father Contact" value="<?php echo htmlentities($result->fathercontact);?>" name="fathercontact" class="form-control" onkeypress="isInputNumber(event)">
														</div>

														<label class="col-sm-2 control-label">Profile Picture</label>
														<div class="col-sm-4">
															<input type="file" name="fatherpicture" class="form-control">
															<input type="hidden" name="fatherpicture" value="<?php echo htmlentities($result->fatherpicture);?>" class="form-control">
														</div>

													</div>
													<hr style="height:5px; border-top: 2px solid #ffcccb;width:50%;">

												</div>



												<!-- MOTHERS BOX -->
												<div id="mothersbox" class="showmother">
													<div class="form-group">
														<label class="col-sm-2 control-label">Mother's FullName<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Mother's Name"  value="<?php echo htmlentities($result->motherfullname);?>" name="motherfullname" class="form-control">
														</div>

														<label class="col-sm-2 control-label">Place of Residence</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Place of Residence"  value="<?php echo htmlentities($result->motherresisdence);?>" name="motherresisdence" class="form-control">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Occupation</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Mother's Occupation"  value="<?php echo htmlentities($result->motheroccupation);?>" name="motheroccupation" class="form-control">
														</div>


														<label class="col-sm-2 control-label">Age Bracket</label>
														<div class="col-sm-4">
															<select name="motheragebracket" class="form-control">
																<option  value="<?php echo htmlentities($result->motheragebracket);?>"><?php echo htmlentities($result->motheragebracket);?></option>
																<option value="18-25">18-25</option>
																<option value="26-30">26-30</option>
																<option value="31-35">31-35</option>
																<option value="36-45">36-45</option>
																<option value="above 45">above 45</option>
															</select>
														</div>

													</div>





													<div class="form-group">
														<label class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Mother Contact"  value="<?php echo htmlentities($result->mothercontact);?>" name="mothercontact" class="form-control" onkeypress="isInputNumber(event)">
														</div>


														<label class="col-sm-2 control-label">Profile Picture</label>
														<div class="col-sm-4">
														<input type="file" name="motherpicture"  class="form-control">

															<input type="hidden" name="motherpicture"  value="<?php echo htmlentities($result->motherpicture);?>" class="form-control">
														</div>
													</div>
													<!-- Mothes box ending -->
												</div>

												<!-- GUARDIAN BOX -->
												<div id="guardianbox" class="showguardian">
													<div class="form-group">
														<label class="col-sm-2 control-label">Guardian's FullName<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Guardian's Name"  value="<?php echo htmlentities($result->guardianfullname);?>"name="guardianfullname" class="form-control">
														</div>

														<label class="col-sm-2 control-label">Place of Residence</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Place of Residence"  value="<?php echo htmlentities($result->guardianresisdence);?>" name="guardianresisdence" class="form-control">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Occupation</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Guardian's Occupation"  value="<?php echo htmlentities($result->guardianoccupation);?>" name="guardianoccupation" class="form-control">
														</div>


														<label class="col-sm-2 control-label">Age Bracket</label>
														<div class="col-sm-4">
															<select name="guardianagebracket" class="form-control">
																<option  value="<?php echo htmlentities($result->guardianagebracket);?>"> <?php echo htmlentities($result->guardianagebracket);?></option>
																<option value="18-25">18-25</option>
																<option value="26-30">26-30</option>
																<option value="31-35">31-35</option>
																<option value="36-45">36-45</option>
																<option value="above 45">above 45</option>
															</select>
														</div>

													</div>


													<div class="form-group">
														<label class="col-sm-2 control-label">Contact Number<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Guardian Contact"  value="<?php echo htmlentities($result->guardiancontact);?>" name="guardiancontact" class="form-control" onkeypress="isInputNumber(event)">
														</div>


														<label class="col-sm-2 control-label">Profile Picture</label>
														<div class="col-sm-4">
															<input type="file" name="guardianpicture"  class="form-control">
															<input type="hidden" name="guardianpicture"  value="<?php echo htmlentities($result->guardianpicture);?>" class="form-control">

														</div>
													</div>
													<!-- Guardian box ending -->
												</div>
											</div>
										</div>

										<div class="panel panel-default">
											<div class="panel-heading text-center">EMERGENCY CONTACT</div>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-sm-2 control-label">Contact Person Name<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" placeholder="Cantact Person Name"  value="<?php echo htmlentities($result->emergencyname);?>" name="emergencyname" class="form-control">
													</div>

													<label class="col-sm-2 control-label">Emergency Contact<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" placeholder="Emergency Contact"  value="<?php echo htmlentities($result->emergencycontact);?>" name="emergencycontact" class="form-control" onkeypress="isInputNumber(event)">
													</div>
												</div>

											</div>
										</div>

										<!-- SPONSORSHIP DETAILS -->

										<div class="panel panel-default">
											<div class="panel-heading text-center">SPONSORSHIP</div>
											<div class="panel-body">


												<!-- SPONSORSHIP BOX -->
												<div class="form-group">

													<label class="col-sm-2 control-label" for="Old">Is the Child Sponsored??</label>
													<div class="col-sm-4">

														<label class="radio-inline">
															<input type="radio" name="sponsorship" class="sponsorship" value="YES" onclick="sponsored()" required
															<?php if ($result->sponsorship == "YES") echo "checked"; ?>
															/>YES </label>
														
														<label class="radio-inline">
															<input type="radio" name="sponsorship" class="sponsorship" selected value="NO" onclick="notsponsored()" 
															<?php if ($result->sponsorship == "NO") echo "checked"; ?>/>NO
														</label>
													</div>
												</div>

												<div id="sponsorbox" class="showsponsor">
													<div class="form-group">
														<label class="col-sm-2 control-label">Name of Sponsor<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Sponsor's Name"  value="<?php echo htmlentities($result->sponsorname);?>" name="sponsorname" class="form-control">
														</div>

														<label class="col-sm-2 control-label">Place of Residence</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Place of Residence"  value="<?php echo htmlentities($result->sponsorresisdence);?>" name="sponsorresisdence" class="form-control">
														</div>
													</div>

													<div class="form-group">

														<label class="col-sm-2 control-label" for="Old">Gender</label>
														<div class="col-sm-4">

															<select name="sponsorgender" class="form-control">
																<option  value="<?php echo htmlentities($result->sponsorgender);?>"> <?php echo htmlentities($result->sponsorgender);?></option>
																<option value="male">Male</option>
																<option value="female">Female</option>
															</select>
														</div>


														<label class="col-sm-2 control-label" for="Old">Married??</label>
														<div class="col-sm-4">

															<label class="radio-inline">
																<input type="radio" name="sponsormarried" class="sponsorship" value="YES" 
																<?php if ($result->sponsormarried == "YES") echo "checked"; ?>
																/>YES </label>

															<label class="radio-inline">
																<input type="radio" name="sponsormarried" class="sponsorship" value="NO" 
																<?php if ($result->sponsormarried == "NO") echo "checked"; ?>
																/>NO
															</label>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Name of Spouse(If Married)</label>
														<div class="col-sm-4">
															<input type="text" placeholder="Name of Spouse"  value="<?php echo htmlentities($result->nameofspouse);?>" name="nameofspouse" class="form-control">
														</div>



														<label class="col-sm-2 control-label">Profile Picture</label>
														<div class="col-sm-4">
															<input type="file" name="sponsorpicture"   class="form-control">
															<input type="hidden" name="sponsorpicture"  value="<?php echo htmlentities($result->sponsorpicture);?>" class="form-control">
														</div>

													</div>


													<div class="form-group">
														<label class="col-sm-2 control-label">Contact<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" placeholder="Sponsor's Contact" value="<?php echo htmlentities($result->sponsorcontact);?>" name="sponsorcontact" class="form-control" onkeypress="isInputNumber(event)">
														</div>
														<div class="form-group">
														<label class="col-sm-2 control-label" for="Old">Is Sponsorship Active?</label>
														<div class="col-sm-4">

<label class="radio-inline">
	<input type="radio" name="spondorshipstatus" class="sponsorship" value="Active"   required
	<?php if ($result->spondorshipstatus == "Active") echo "checked"; ?>
	/>YES </label>

<label class="radio-inline">
	<input type="radio" name="spondorshipstatus" class="sponsorship" selected value="Inactive"  
	<?php if ($result->spondorshipstatus == "Inactive") echo "checked"; ?>
	/>NO
</label>
</div></div>

													</div>
													<!-- Guardian box ending -->
												</div>
											</div>
										</div>

										<div class="panel panel-default">
											<div class="panel-heading text-center">OTHER INFORMATION</div>
											<div class="panel-body">


												<div class="form-group ">
													<label class="col-sm-2 control-label">Benefit Duration<span style="color:red">*</span></label>
													<div class="col-sm-2">
														<span style=""> From:</span>
														<input type="date" name="benefitfrom" value="<?php echo htmlentities($result->benefitfrom);?>" class="form-control" required>

													</div>
													<div class="col-sm-2">
														<span>To:</span>
														<input type="date" name="benefitto" value="<?php echo htmlentities($result->benefitto);?>" class="form-control" >

													</div>
													<label class="col-sm-2 control-label">Level of Education</label>
													<div class="col-sm-4">
														<input type="text" placeholder="Level of Education" value="<?php echo htmlentities($result->educationlevel);?>" name="educationlevel" class="form-control">
													</div>
												</div>
												<div class="form-group ">
													<label class="col-sm-2 control-label" for="extratext">Add Additional Infomation:</label>
													<div class="col-sm-4">
														<input type="checkbox" id="otherinfo" onclick="ExtraInfoFunction()">
													</div>
													<div class="col-sm-8">
														<textarea id="extratext" name="other_info" class="form-control" rows="5"><?php echo htmlentities($result->other_info);?>
</textarea>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-10 col-sm-offset-6">
														<button class="btn btn-primary" style="background-color: #125e36;;" name="submit" type="submit"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i> UPDATE RECORD</button>
													</div>
												</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		</div>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
		<script src="js/logout.js"></script>
		<script>
			function isInputNumber(evt) {

				var ch = String.fromCharCode(evt.which);

				if (!(/[0-9]/.test(ch))) {
					evt.preventDefault();
				}

			}


			
			function showboth() {
				document.getElementById('fathersbox').style.display = 'block';
				document.getElementById('mothersbox').style.display = 'block';
				document.getElementById('guardianbox').style.display = 'none';
			}

			function showfather() {
				document.getElementById('fathersbox').style.display = 'block';
				document.getElementById('mothersbox').style.display = 'none';
				document.getElementById('guardianbox').style.display = 'none';

			}

			function showmother() {
				document.getElementById('mothersbox').style.display = 'block';
				document.getElementById('fathersbox').style.display = 'none';
				document.getElementById('guardianbox').style.display = 'none';

			}

			function showguardian() {
				document.getElementById('guardianbox').style.display = 'block';
				document.getElementById('mothersbox').style.display = 'none';
				document.getElementById('fathersbox').style.display = 'none';
			}

			function sponsored() {
				document.getElementById('sponsorbox').style.display = 'block';

			}

			function notsponsored() {
				document.getElementById('sponsorbox').style.display = 'none';

			}

			function ExtraInfoFunction() {
				var checkBox = document.getElementById("otherinfo");
				var extratext = document.getElementById("extratext");
				if (checkBox.checked == true) {
					extratext.style.display = "block";
				} else {
					extratext.style.display = "none";
				}
			}
		</script>


	</body>

	</html>
<?php } ?>

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.html');
}

if (isset($_POST['save'])) {

	$level = $_POST['edulevel'];
	$term = $_POST['term'];
	$record_Id = $_POST['record_id'];
$report="";


	$pdf=explode(".", $_FILES["report"]["name"]);
	$pdf_type=$_FILES['report']['type'];
	$pdf_size=$_FILES['report']['size'];
	$newfilename = $level.'_'.$term.'_'.uniqid().'.'. end($pdf);
	$pdf_tem_loc=$_FILES['report']['tmp_name'];
	 $pdf_store="uploads/reports/".$newfilename;
	
		if(move_uploaded_file($pdf_tem_loc, $pdf_store))
		{
			$report=$newfilename;

		}
	
		$sql = "INSERT INTO reports(
level,
term,
record_Id,
report
)
VALUES(
:level,
:term,
:record_Id,
:report
)";

$query = $dbh->prepare($sql);

	$query->bindParam(':level', $level, PDO::PARAM_STR);
	$query->bindParam(':term', $term, PDO::PARAM_STR);
	$query->bindParam(':record_Id', $record_Id, PDO::PARAM_STR);
	$query->bindParam(':report', $report, PDO::PARAM_STR);
	
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();

	if ($lastInsertId) {
		echo "<script type='text/javascript'>alert('Report Added!');</script>";
	} else {
		echo "<script type='text/javascript'>alert('An Error Occured!!');</script>";
		}

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
	
	<title>View Details</title>

	<!-- Font awesome -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
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

	<script type= "text/javascript" src="../vendor/countries.js"></script>


	
	<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
 .motherclass{
	display: none;
} 



		</style>
</head>

<body>


	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
							
									<div class="panel-heading text-center">
									RECORD DETAILS
									</div>
									
									<div class="panel-body">

								

										
										<tbody>

											<?php
											$vid=$_GET['viewid'];
											$sql= "SELECT * FROM records where Id = :vid";
											$query = $dbh -> prepare($sql);
											$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $row)
											{               ?>

<?php
$date1 = strtotime($row->benefitfrom);
$date2 = strtotime($row->benefitto);

$months = 0;

while (strtotime('+1 MONTH', $date1) < $date2) {
    $months++;
    $date1 = strtotime('+1 MONTH', $date1);
}


?> 


								
									<div style="margin-bottom:20px;" class="col-md-4" >
									<a href="view_letters.php?viewId=<?php echo $row->id ?>">
									<button class="btn btn-Info" > -LETTERS- </button></a>
									<a href="view_reports.php?viewId=<?php echo $row->id ?>">
									<button class="btn btn-primary" >VIEW TERMINAL REPORTS</button></a>
										<button  class="btn btn-SUCCESS" onclick='addReports(<?php echo $row->id ?>)'>ADD NEW</button>
									
										</div>
									
											
									

										  <div id="record_details">
									
											<table border="1" class="table table-bordered">
												
											<tr><td></td>	</tr>									 	
											


											    <tr align="center">
												
											    <td rowspan="5" ><img src="uploads/primary/<?php echo $row->Passport_Picture;($result->Passport_Picture);?>" style="width:300px; height:300px; border-radius:0%;"/></td>
											    
											  </tr>
											
											 <tr>
											    <th scope>Child FullName</th>
											    <td><?php  echo $row->fullname;?></td>
											    <th scope>Date Of Birth</th>
											    <td><?php  echo $row->dob;?></td>
											  </tr>


											  <tr>
											    <th scope>Gender</th>
											    <td><?php  echo $row->Gender;?></td>
											    <th scope>ID Number</th>
											    <td><?php  echo $row->idnumber;?></td>
											  </tr>

											  <tr>
											    <th scope>Parents Alive</th>
											    <td id="aliveparents"><?php  echo $row->parentsalive;?></td>
												<th scope>Benefit</th>
											    <td>
												<?php if(($date1 >= $date2) && $date2 > 0 ){echo'(ENDED)';}else{echo'(IN PROGRESS)';};
												?></td>
											  </tr>
											  <tr>
											    <th scope>Benefit From</th>
											    <td><?php  echo $row->benefitfrom;?></td>
												<th scope>Benefit End Date</th>
											    <td ><?php if($date2 > 0 ){echo $row->benefitto;}else{echo'(Not Set)';}?></td>
											  </tr>
											</table>
											<table border="1"  id="fatherdisplay" class="table table-bordered motherclass">

						<div align="center">PARENT/GUARDIAN</div>
											  <tr>
											 <th scope>Father's FullName</th>
											    <td><?php  echo $row->fatherfullname;?></td>
											    <th scope>Father's Residence</th>
											    <td><?php  echo $row->fatherresisdence;?></td>
											</tr>

											     <tr>
											 <th scope>Father's Occupation</th>
											    <td><?php  echo $row->fatheroccupation;?></td>
											    <th scope>Age Bracket of Father</th>
											    <td><?php  echo $row->fatheragebracket." (years)";?></td>
											    
											  </tr>

											  <tr>
											 <th scope>Father's Contact</th>
											    <td><?php  echo $row->fathercontact;?></td>
											    <th scope>Picture</th>
											    <td> <i id="fatherImage" class="fa fa-download" aria-hidden="true"></i></td>
											    
											  </tr>
											
											</table>
											  <table border="1" id="motherdisplay"  class="table table-bordered motherclass">
	<tr>
											  <th scope>Mother's FullName</th>
											    <td><?php  echo $row->motherfullname;?></td>
											    <th scope>Mother's Residence</th>
											    <td><?php  echo $row->motherresisdence;?></td>
	</tr>

											     <tr>
											 <th scope>Mother's Occupation</th>
											    <td><?php  echo $row->motheroccupation;?></td>
											    <th scope>Age Bracket of Mother</th>
											    <td><?php  echo $row->motheragebracket." (years)";?></td>
											    
											  </tr>

											  <tr>
											 <th scope>Mother's Contact</th>
											    <td><?php  echo $row->mothercontact;?></td>
											    <th scope>Picture</th>
											    <td><i id="motherImage" class="fa fa-download" aria-hidden="true"></i></td>
											    
											  </tr>
											 
											</table>

											<!-- GUARDIAN INFORMATIONS -->
											<table border="1" id="guardiandisplay"  class="table table-bordered motherclass">
	<tr>
											  <th scope>Guardian's FullName</th>
											    <td><?php  echo $row->guardianfullname;?></td>
											    <th scope>Guardian's Residence</th>
											    <td><?php  echo $row->guardianresisdence;?></td>
	</tr>

											     <tr>
											 <th scope>Guardian's Occupation</th>
											    <td><?php  echo $row->guardianoccupation;?></td>
											    <th scope>Age Bracket of Guardian</th>
											    <td><?php  echo $row->guardianagebracket." (years)";?></td>
											    
											  </tr>

											  <tr>
											 <th scope>Guardian's Contact</th>
											    <td><?php  echo $row->guardiancontact;?></td>
											    <th scope>Picture</th>
											    <td> <i id="guardianImage" class="fa fa-download" aria-hidden="true"></i></td>
											    
											  </tr>
											 
											</table>

											<div align="center">EMERGENCY CONTACT</div>

											<table border="1" class="table table-bordered">
											<tr>
											<th scope>Emergency Person</th>
											    <td><?php  echo $row->emergencyname;?></td>
											 <th scope>Emergency person Contact</th>
											    <td><?php  echo $row->emergencycontact;?></td>
									
											  </tr>
											  <th scope>Is Child Sponsored?</th>
											    <td id="sponsorship"><?php  echo $row->sponsorship;?></td>
											
									
											  </tr>
											</table>

											  											<!-- SPONSOR INFORMATIONS -->
												 <table border="1" id="sponsordisplay"  class="table table-bordered motherclass">

												 <div align="center">SPONSOR INFORMATION ( <b><?php  echo strtoupper($row->spondorshipstatus) ?></b>)</div>

	<tr>
											  <th scope>Sponsor's Name</th>
											    <td><?php  echo $row->sponsorname;?></td>
											    <th scope>Sponsors's Residence</th>
											    <td><?php  echo $row->sponsorresisdence;?></td>
	</tr>

											     <tr>
											 <th scope>Sponsors's Gender</th>
											    <td><?php  echo $row->sponsorgender;?></td>
											    <th scope>Married??:Spouse Name</th>
											    <td><?php  echo $row->sponsormarried.' : '.$row->nameofspouse;?></td>
											    
											  </tr>

											  <tr>
											 <th scope>Sponsor's Contact</th>
											    <td><?php  echo $row->sponsorcontact;?></td>
											    <th scope>Picture</th>
											    <td> <i id="sponsorImage" class="fa fa-download" aria-hidden="true"></i></td>
											   
											  </tr>
											  <tr>
											 
											    <td colspan="4"><?php  echo $row->other_info;?></td>
											    
											    
											  </tr>
											 
											</table>
									

											  
											


											  <?php
												$cnt=$cnt+1;
												} ?>

												</tbody>
												</table>
												</div>
											</div>
											</div>
											</div>
											</div>
											</div>	</div>
											</div>
											</div>
										</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Terminal Report</h4>
        </div>
        <div class="modal-body" id="formcontent">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

											

	<script type="text/javascript">



function addReports(sid)
{
$.ajax({
            type: 'post',
            url: 'addreports.php',
            data: {record_id:sid,req:'1'},
            success: function (data) {
              $('#formcontent').html(data);
			  $("#myModal").modal({backdrop: "static"});
            }
          });

}


						    function PrintElem(elem)
						    {
						        Popup($(elem).html());
						    }

						    function Popup(data) 
						    {
						        var mywindow = window.open('', 'Record Details', 'height=700,width=500');
						        mywindow.document.write('<html><head><title>Record Details</title>');
						        mywindow.document.write('<link rel="stylesheet" href= "css/bootstrap.min.css" type="text/css" />'); 
						        mywindow.document.write('</head><body >');
						        mywindow.document.write(data);
						        mywindow.document.write('</body></html>');
								mywindow.print();
						    //    mywindow.close();
						        winprint.focus();

						        return true;
						    }
							var sponsorship = document.getElementById("sponsorship").textContent;
							if(sponsorship=="YES"){
								document.getElementById('sponsordisplay').style.display = 'table';
							
							}

							var palive = document.getElementById("aliveparents").textContent;
							if(palive=="BOTH"){
								document.getElementById('fatherdisplay').style.display = 'table';
								document.getElementById('motherdisplay').style.display = 'table';
							}else if(palive=="FATHER"){
								document.getElementById('fatherdisplay').style.display = 'table';
							}else if(palive=="MOTHER")
							{
								document.getElementById('motherdisplay').style.display = 'table';
							}else{
								document.getElementById('guardiandisplay').style.display = 'table';
							}


							document.getElementById("motherImage").onclick = function () {
      var user_id="<?php echo $row->motherpicture; ?>";
        location.href = "uploads/parents/"+user_id;
    };
	document.getElementById("fatherImage").onclick = function () {
      var user_id="<?php echo $row->fatherpicture; ?>";
        location.href = "uploads/parents/"+user_id;
    };
	document.getElementById("sponsorImage").onclick = function () {
      var user_id="<?php echo $row->sponsorpicture; ?>";
        location.href = "uploads/sponsor/"+user_id;
    };
	document.getElementById("guardianImage").onclick = function () {
      var user_id="<?php echo $row->guardianpicture; ?>";
        location.href = "uploads/parents/"+user_id;
    };
	</script>


												

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

										
																		 	
										</body>

										</html>
										<div class="container">
												  <div class="row">
												    <div class="col">
												     
												    </div>
												  </div>
												  
												</div>

												
												<button  type="submit"class="btn btn-info btn-block  " onclick="PrintElem('#record_details') " style="background-color: #125e36;"><i class="fa fa-print fa-lg" aria-hidden="true"></i>  PRINT</button>
												




<?php }  ?>









<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	if(isset($_GET['del']))
{
$Id=$_GET['del'];

$sql = "update letters set delete_status='1' WHERE Id=:Id";
$query = $dbh->prepare($sql);
$query -> bindParam(':Id',$Id, PDO::PARAM_STR);
$query -> execute();


}
if(isset($_GET['viewId'])){
    $record_Id=$_GET['viewId'];
}else{
    echo "<script>alert('Error!!!!')</script>";
}


if (isset($_POST['save'])) {

	$lettername = $_POST['lettername'];
	// $child_Id = $_POST['record_id'];
$letter="";


	$pdf=explode(".", $_FILES["letter"]["name"]);
	$pdf_type=$_FILES['letter']['type'];
	$pdf_size=$_FILES['letter']['size'];
	$newfilename = $lettername.'_'.uniqid().'.'. end($pdf);
	$pdf_tem_loc=$_FILES['letter']['tmp_name'];
	 $pdf_store="uploads/letters/".$newfilename;
	
		if(move_uploaded_file($pdf_tem_loc, $pdf_store))
		{
			$letter=$newfilename;

		}
	
		$sql = "INSERT INTO letters(
lettername,
record_Id,
letter
)
VALUES(
:lettername,
:record_Id,
:letter
)";

$query = $dbh->prepare($sql);

	$query->bindParam(':lettername', $lettername, PDO::PARAM_STR);
	$query->bindParam(':letter', $letter, PDO::PARAM_STR);
	$query->bindParam(':record_Id', $record_Id, PDO::PARAM_STR);

	
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();

	if ($lastInsertId) {
		echo "<script type='text/javascript'>alert('Letter Added!');</script>";
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
	
	<title>View Letter</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
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

		
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
					
							<div class="panel-heading text-center">View Letters</div>
							<div class="panel-body">

								<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								

			
								<div class="col-md-12" >
					<div class="col-md-11" >
						
						</div>
					<div class="col-md-1" >
						<button style="margin:20px;"  class="btn btn-primary" onclick='addLetter(<?php echo $record_Id ?>)'>ADD LETTER</button>
						</div>
						
						</div>
								
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
												<th>#</th>
												<th>Letter Name</th>
															<th>Letter</th>
															<th>Date Uploaded</th>
                                                <th>Action</th>	
										</tr>
									</thead>
									
									<tbody>


									<?php $sql = "SELECT * from  letters WHERE record_id=$record_Id and delete_status='0'";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{				?>	
										<tr>
									
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->lettername);?></td>
											<td><?php echo htmlentities($result->letter);?></td>
											<td><?php echo htmlentities($result->datecreated);?></td>
                                         


                                            <td>
<a href="view_letters.php?del=<?php echo $result->id;?>&viewId=<?php echo $record_Id;?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;

<a href="uploads/letters/<?php echo $result->letter;?>" target="_blank"><i class="fa fa-download " aria-hidden="true"></i></a>&nbsp;&nbsp;
                                                    </td>
</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Letter</h4>
        </div>
        <div class="modal-body" id="formcontent">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});


					function addLetter(sid)
{
$.ajax({
            type: 'post',
            url: 'addreports.php',
            data: {record_id:sid,req:'2'},
            success: function (data) {
              $('#formcontent').html(data);
			  $("#myModal").modal({backdrop: "static"});
            }
          });

}
		</script>
		
</body>
</html>
<?php } ?>

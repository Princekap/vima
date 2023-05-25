<?php 
session_start();
//error_reporting(0);
session_regenerate_id(true);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
	header("Location: index.php"); //
	}
	else{?>
<table border="1">
									<thead>
										<tr>
										<th>#</th>
										
												<th>Name</th>
												<th>ID Number</th>
                                                <th>Parent/Guardian</th>
                                                <th>Residence</th>
                                                <th>Sponsorship</th>
                                                <th>Start of Benefit</th>
										</tr>
									</thead>

<?php 
$filename="Records";
$sql = "SELECT * from records";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				

echo '  
<tr>  
<td>'.$cnt.'</td> 

<td>'.$fullname= $result->fullname.'</td> 
<td>'.$idnumber= $result->idnumber.'</td> 
<td>'.$parentsalive= $result->parentsalive.'</td> 
<td>'.$childresidence= $result->childresidence.'</td> 	
<td>'.$sponsorship= $result->sponsorship.'</td> 					
<td>'.$benefitfrom= $result->benefitfrom.'</td> 	
</tr>  
';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
			$cnt++;
			}
	}
?>
</table>
<?php } ?>
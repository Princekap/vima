<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.html');
}



//
if(isset($_POST['req']) && $_POST['req']=='1') 
{
    $record_id = (isset($_POST['record_id']))?$_POST['record_id']:'';
   
 
  


echo ' <form class="form-horizontal" id ="signupForm1" action="view_details.php?viewid='.$record_id.'" method="post"  enctype="multipart/form-data">
<div class="form-group">
<label for="email" class="col-sm-2 control-label"> Level: </label>
<div class="col-sm-10" >
    <select class="form-control" onchange="this.nextElementSibling.value=this.value; checkLevel(this.value)" >
    '.
    $sql= "SELECT Distinct(level) FROM reports";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    foreach($results as $row)
    { ?>
        <option value="<?php echo $row->level; ?>"><?php echo $row->level; ?></option>
        <?php
    }
} 
    echo '             
    <option value="custom">Add Custom</option>
    </select>
    <input type="text" id="level_change" style="display:none;" class="form-control" name="edulevel" placeholder="Level" />
    </div>
</div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Term:</label>
    <div class="col-sm-10">
    <select name="term" class="form-control">
    <option value="">Select Term</option>
    <option value="First_Term">First Term</option>
    <option value="Second_Term">Second Term</option>
    <option value="Third_Term">Third Term</option>
</select>
    </div>
  </div>

  <div class="form-group">
  <label class="col-sm-2 control-label">Terminal Report:<span style="color:red">*</span></label>
  <div class="col-sm-4">
      <input type="file" name="report" class="form-control" required>
      <input type="hidden" value="'.$record_id.'" name="record_id">
  </div>
 </div>

  <div class="form-group"> 
     <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary" name="save">Save</button>
    </div>
  </div>
</form>

	
';

}






if(isset($_POST['req']) && $_POST['req']=='2') 
{
    $record_id = (isset($_POST['record_id']))?$_POST['record_id']:'';
   



echo ' <form class="form-horizontal" id ="signupForm1" action="view_letters.php?viewId='.$record_id.'" method="post"  enctype="multipart/form-data">
<div class="form-group">
<label for="email" class="col-sm-2 control-label"> Letter Name </label>
<div class="col-sm-10" >
    <input type="text" class="form-control" name="lettername" placeholder="Letter Name" />
    </div>
</div>


  <div class="form-group">
  <label class="col-sm-2 control-label">Upload Letter:<span style="color:red">*</span></label>
  <div class="col-sm-4">
      <input type="file" name="letter" class="form-control" required>
  </div>
 </div>

  <div class="form-group"> 
     <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary" name="save">Save</button>
    </div>
  </div>
</form>

	
';

}

?>
<script>
function checkLevel(val) {
  var element = document.getElementById('level_change');
  if (val == '' || val == 'custom')
    element.style.display = 'block';
  else
    element.style.display = 'none';

}
</script>
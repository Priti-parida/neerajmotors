<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM attendance WHERE employee_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveattaindence.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit Employee</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />

<span>Date: </span><input type="date" style="width:265px; height:30px;" name="date" value="<?php  echo date('d -m Y',strtotime($row['date']));?>" placeholder="Date"/><br>

<span>Employee Id: </span><input type="text" style="width:265px; height:30px;" name="emp" value="<?php echo $row['employee_id']; ?>"  placeholder="Employee Id"/><br>
<span>Employee Name: </span><input type="text" style="width:265px; height:30px;" name="name" value="<?php echo $row['name']; ?>"  placeholder="Employee Name"/><br>

<span>Contact : </span><input type="text" style="width:265px; height:30px;" name="contact"value="<?php echo $row['contact']; ?>"  placeholder="Contact"/><br>
<span>Designation : </span><input style="height:70px; width:265px;" name="designation" value="<?php echo $row['designation']; ?>" placeholder="Designation"></input><br>
<span>Schedule: </span><input type="text" style="width:265px; height:30px;" name="schedule"value="<?php echo $row['schedule']; ?>"  placeholder="Schedule"/><br>
<span>Status : </span><input type="text" style="height:60px; width:265px;" name="status"value="<?php echo $row['status']; ?>" ></input type="text" placeholder="status eg:ontime"><br>
<span>Time In : </span><input type="time" style="height:60px; width:265px;" name="timein"value="<?php echo $row['time_out']; ?>" ></input type="text"><br>
<span>Time Out : </span><input type="time" style="height:60px; width:265px;" name="timeout"value="<?php echo $row['time_out']; ?>" ></input type="text"><br>
<span>Leave Status : </span><input type="text" style="height:60px; width:265px;" name="leave"value="<?php echo $row['leaves']; ?>" ></input type="text"><br>


<span>Salary : </span><input type="text" style="height:60px; width:265px;" name="num"value="<?php echo $row['salary']; ?>" ></input type="text"><br>
<span>Deducted Salary : </span><input type="text" style="height:60px; width:265px;" name="dec"value="<?php echo $row['deduction']; ?>" ></input type="text"><br>


<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>

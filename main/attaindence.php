<?php
include('../inc/header.php');
include('../inc/navbr.php');

?>
	<div class="span10">
	<div class="contentheader">
			<i class="icon-group"></i> Employee Details
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Employee Details</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM attendance ORDER BY employee_id DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			<div style="text-align:center;">
			Total Number of Employee: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Search Employee..." autocomplete="off" />
<a rel="facebox" href="addattaindence.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Employee</button></a><br><br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="17%"> Date </th>
			<th width="10%"> Employee Id </th>
			<th width="10%"> Employee Name</th>
			<th width="25%"> Contact </th>

			<th width="7%"> Designation</th>
			<th width="12%"> Schedule</th>

			<th width="19%"> Time In</th>
			<th width="15%"> Time Out</th>


			<th width="10%"> Status </th>
			<th width="10%"> Salary </th>
			<th width="10%"> Deduction  </th>


			
			<th width="25%"> Leaves Status</th>
			

			
			<th width="22%"> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM attendance ORDER BY employee_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php  echo date('d -m Y',strtotime($row['date']));?></td>
			<td><?php echo $row['employee_id']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['contact']; ?></td>

			<td><?php echo $row['designation']; ?></td>
			<td><?php echo $row['schedule']; ?></td>


			<td><?php echo $row['time_in']; ?></td>
			<td><?php echo $row['time_out']; ?></td>


			


			<td><?php echo $row['status']; ?></td>
			<td><?php echo $row['salary']; ?></td>
			<td><?php echo $row['deduction']; ?></td>


			<td><?php echo $row['leaves']; ?></td>
			

		

			<td><a  title="Click To Edit Customer" rel="facebox" href="editattaindance.php?id=<?php echo $row['employee_id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit </button></a> 
			<a href="#" id="<?php echo $row['employee_id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>

<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Are you sure want to delete? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteattaindance.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<?php include('../inc/footer.php');?>



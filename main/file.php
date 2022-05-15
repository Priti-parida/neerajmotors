<?php
include('../inc/header.php');
include('../inc/navbr.php');

?>
	<div class="span10">
	<div class="contentheader">
			<i class="icon-group"></i> Customers
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Customers</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM upload_files ORDER BY ID DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			<div style="text-align:center;">
			Total Number of FILES: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Search Customer..." autocomplete="off" />
<a rel="facebox" href="addfile.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Customer</button></a><br><br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		<th>Filename</th>
    <th>FileSize</th>
    <th>Uploader</th>
     <th>Status</th>   
    <th>Date/Time Upload</th>
    <th>Downloads</th>
    <th>Action</th>

			
			<th width="22%"> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM upload_files ORDER BY ID DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
		
     
	 
		 <td width="20%"><?php echo  $row['process_img']; ?></td>
      <td><?php echo floor($row['SIZE'] / 1000) . ' KB'; ?></td>
	  <td width="20%"><?php echo  $row['EMAIL']; ?></td>
	  <td width="20%"><?php echo  $row['ADMIN_STATUS']; ?></td>
	  <td width="20%"><?php echo  $row['TIMERS']; ?></td>
	  <td width="20%"><?php echo  $row['DOWNLOAD']; ?></td>


	  


		

			<td><a href="uploads/<?php echo $row['NAME']?>" download><strong> <span class="btn btn-xs btn btn-success">Download</span></strong></a>
				<a  title="Click To Edit Customer" rel="facebox" href="editcustomer.php?id=<?php echo $row['customer_id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit </button></a> 
			<a href="#" id="<?php echo $row['customer_id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<?php include('../inc/footer.php');?>



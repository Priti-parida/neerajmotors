<?php
include('../inc/header.php');
include('../inc/navbr.php');

?>
	<div class="span10">
	<div class="contentheader">
			<i class="icon-list"></i> Customer Legder
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Customer Legder</li>
			</ul>

<div id="maintable">
<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>
<?php
include('../connect.php');
$tftft=$_GET['cname'];
$resulta = $db->prepare("SELECT * FROM sales WHERE invoice_number= :a");
$resulta->bindParam(':a', $tftft);
$resulta->execute();
for($i=0; $rowa = $resulta->fetch(); $i++){
$name=$rowa['name'];
$amount=$rowa['amount'];
}
$resultas = $db->prepare("SELECT * FROM customer WHERE customer_name= :b");
$resultas->bindParam(':b', $name);
$resultas->execute();
for($i=0; $rowas = $resultas->fetch(); $i++){
echo 'Name : '.$rowas['customer_name'].'<br>';
echo 'Address : '.$rowas['address'].'<br>';
echo 'Contact : '.$rowas['contact'].'<br>';
}
?>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th> Transaction ID </th>
			<th> Date </th>
			<th> Invoice Number </th>
			<th> Payment </th>
			<th> Total Ammount Due </th>
			<th> Balance </th>
		</tr>
	</thead>
	<tbody>
			<tr class="record">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><strong><?php echo $rowa['amount']; ?></strong></td>
			<td>&nbsp;</td>
			</tr>
			<?php
				$tftft=$_GET['cname'];
				$result = $db->prepare("SELECT * FROM collection WHERE name= :userid ORDER BY transaction_id ASC");
				$result->bindParam(':userid', $tftft);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td>TR-000<?php echo $row['transaction_id']; ?></td>
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['invoice']; ?></td>
			<td><?php echo $row['amount']; ?></td>
			<td>&nbsp;</td>
			<td><?php echo $row['balance']; ?></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<a rel="facebox" href="addledger.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add Payment</button></a><br><br>

<?php include('footer.php');?>

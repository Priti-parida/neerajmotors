<?php
include('../inc/header.php');
include('../inc/navbr.php');

?>
	<div class="span10">
	<div class="contentheader">
			<i class="icon-dashboard"></i> Dashboard
			</div>
			<ul class="breadcrumb">
			<a href="dashboard.php"><li>Dashboard</li></a> /
			<li class="active">Purchase Lists</li>
			</ul>
<div id="maintable">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a><br><br>

<form action="savepurchasesitem.php" method="post" >
<input type="hidden" name="invoice" value="<?php echo $_GET['iv']; ?>" />
<select name="product" style="width: 600px;">
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM products");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['product_code']; ?>"><?php echo $row['product_code']; ?> - <?php echo $row['product_name']; ?></option>
	<?php
	}
	?>
</select>
<input type="text" name="qty" value="" placeholder="Qty" autocomplete="off" style="width: 68px; height:30px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-save icon-large"></i> Save</button>

</form>
<div class="content" id="content">
<div>
<?php
$id=$_GET['iv'];
include('../connect.php');
$resultaz = $db->prepare("SELECT * FROM purchases WHERE invoice_number= :xzxz");
$resultaz->bindParam(':xzxz', $id);
$resultaz->execute();
for($i=0; $rowaz = $resultaz->fetch(); $i++){
echo 'Transaction ID : TR-'.$rowaz['transaction_id'].'<br>';
echo 'Invoice Number : '.$rowaz['invoice_number'].'<br>';
echo 'Date : '.$rowaz['date'].'<br>';
echo 'Supplier : '.$rowaz['suplier'].'<br>';
echo 'Remarks : '.$rowaz['remarks'].'<br>';
}
?>
</div>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="35%"> Name </th>
			<th width="10%"> Qty </th>
			<th width="15%"> Cost </th>
			<th width="12%"> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				$id=$_GET['iv'];
				$result = $db->prepare("SELECT * FROM purchases_item WHERE invoice= :userid");
				$result->bindParam(':userid', $id);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php
			$rrrrrrr=$row['name'];
			$resultss = $db->prepare("SELECT * FROM products WHERE product_code= :asas");
			$resultss->bindParam(':asas', $rrrrrrr);
			$resultss->execute();
			for($i=0; $rowss = $resultss->fetch(); $i++){
			echo $rowss['product_name'];
			}
			?></td>
			<td><?php echo $row['qty']; ?></td>
			<td>
			<?php
			$dfdf=$row['cost'];
			echo formatMoney($dfdf, true);
			?>
			</td>
			<td><center><a href="deletep.php?id=<?php echo $row['id']; ?>&invoice=<?php echo $_GET['iv']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['name'];?>"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete </button></a></td>
			</center>
			</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
				<td colspan="2"><strong style="font-size: 12px; color: #222222;">
				<?php
				function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				$sdsd=$_GET['iv'];
				$resultas = $db->prepare("SELECT sum(cost) FROM purchases_item WHERE invoice= :a");
				$resultas->bindParam(':a', $sdsd);
				$resultas->execute();
				for($i=0; $rowas = $resultas->fetch(); $i++){
				$fgfg=$rowas['sum(cost)'];
				echo formatMoney($fgfg, true);
				}
				?>
				</strong></td>
			</tr>
		
	</tbody>
</table></div><br>
<button  style="width: 123px; height:35px; float:right;" class="btn btn-success btn-large">
<a href="javascript:Clickheretoprint()"><i class="icon icon-print icon-large"></i> Print</a></button>
<div class="clearfix"></div>
</div>
</body>
</html>
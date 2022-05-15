<?php
include('../inc/header.php');
include('../inc/navbr.php');

?>

	<div class="span10">
	<div class="contentheader">
			<i class="icon-table"></i> Products
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Products</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM products ORDER BY qty_sold DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			
			<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM products where qty < 10 ORDER BY product_id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();

			?>
				<div style="text-align:center;">
			Total Number of Products:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
			
			<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66);; font:bold 22px 'Aleo';">[<?php echo $rowcount123;?>]</font> Products are below QTY of 10 
			</div>
</div>


<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Search Product..." autocomplete="off" />
<a rel="facebox" href="addproduct.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Product</button></a><br><br>
<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="12%"> Brand Name </th>
			<th width="14%"> Generic Name </th>
			<th width="13%"> Category / Description </th>
			<th width="7%"> Supplier </th>
			<th width="9%"> Date Received </th>
			<th width="10%"> Expiry Date </th>
			<th width="6%"> Original Price </th>
			<th width="6%"> Selling Price </th>

			<th width="6%"> Stock QTY </th>
			<th width="5%">  Stock QTY Left </th>
			<th width="8%"> Total </th>
			<th width="8%"> Profit </th>

			
			<th width="8%"> Action </th>

		</tr>
	</thead>
	<tbody>
		
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
				include('../connect.php');
				$result = $db->prepare("SELECT *, price * qty as total FROM products ORDER BY product_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$total=$row['total'];
				$availableqty=$row['qty'];
				if ($availableqty < 10) {
				echo '<tr class="alert alert-warning record" style="color: #fff; background:rgb(255, 95, 66);">';
				}
				else {
				echo '<tr class="record">';
				}
			?>
		

			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo ucwords($row['gen_name']); ?></td>
			<td><?php echo ucwords($row['product_name']); ?></td>
					<td><?php echo ucwords($row['supplier']); ?></td>
			<td><?php echo $row['date_arrival']; ?></td>
			<td><?php echo $row['expiry_date']; ?></td>
			<td><?php
			$oprice=$row['o_price'];
			echo formatMoney($oprice, true);
			?></td>
			<td><?php
			$pprice=$row['price'];
			echo formatMoney($pprice, true);
			?></td>
			<td><?php echo $row['qty_sold']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td>
			<?php
			$total=$row['total'];
			echo formatMoney($total, true);
			?>
			<td><?php echo $row['profit']; ?></td>

			</td>			
			<td><a  title="Click To Edit Customer" rel="facebox" href="editcustomer.php?id=<?php echo $row['product_id']; ?>"><button class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit </button></a> 
			&nbsp; &nbsp;<a href="#" id="<?php echo $row['product_id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a></td>

		</tr>
			<?php
				}
			?>
		
		
		
	</tbody>
</table>
<?php include('../inc/footer.php');?>
<script src="js/jquery.js"></script>
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
   url: "deleteproduct.php",
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
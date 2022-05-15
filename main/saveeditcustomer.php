<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];
$d = $_POST['memno'];
$e = $_POST['prod_name'];
$f = $_POST['note'];
$g = $_POST['paymentmode'];
$h = $_POST['veh'];
$i = $_POST['rto'];
$j = $_POST['doc'];


$k = $_POST['date'];
// query
$sql = "UPDATE customer 
        SET customer_name=?, address=?, contact=?, membership_number=?, prod_name=?, note=?,paymentmode=?,vehcileno=?,rto=?,documents=?, expected_date=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$id));
header("location: customer.php");

?>
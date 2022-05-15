<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];
$d = $_POST['memno'];
$e = $_POST['prod_name'];
$f = $_POST['note'];
$g = $_POST['pay'];
$h = $_POST['veh'];
$i = $_POST['rto'];
$j = $_POST['doc'];
$k = $_POST['date'];
// query
$sql = "INSERT INTO customer (customer_name,address,contact,membership_number,prod_name,note,paymentmode,vehcileno,rto,documents,expected_date) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$j,':k'=>$k));
header("location: customer.php");


?>
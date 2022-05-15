<?php
session_start();
include('../connect.php');
$a = $_POST['emp'];
$b = $_POST['name'];
$c = $_POST['designation'];
$d = $_POST['schedule'];
$e = $_POST['date'];
$f = $_POST['timein'];
$g = $_POST['status'];
$h = $_POST['timeout'];
$i = $_POST['num'];
$j = $_POST['leave'];
$k = $_POST['contact'];


$l = $_POST['dec'];









// query
$sql = "INSERT INTO attendance (employee_id,name,designation,schedule,date,time_in,status,time_out,salary,leaves,contact,deduction) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':i'=>$i,':j'=>$j,':k'=>$k,':l'=>$l));
header("location: attaindence.php");


?>
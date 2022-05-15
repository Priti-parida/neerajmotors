<?php
error_reporting(0);
// dbect to the database
require_once("../connect.php");

// Uploads files
if(isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
$id=$_POST['ID'];
$pic_img=$_FILES['pic_img'];
//print_r($pic_img);die();
if($id==0){
  
  $doc_image = $pic_img['name'];
  $tm="DOC";
  $tm.=microtime(true)*1000;
  $ext = pathinfo($doc_image,PATHINFO_EXTENSION);
  $doc_image = $tm.".".$ext;
  move_uploaded_file($pic_img['tmp_name'],"uploads/".$doc_image); 

//echo "INSERT INTO `upload_files`(`process_img`) VALUES ('[$doc_image]')"; die;

//mysqli_query($db,"INSERT INTO `upload_files`(`process_img`) VALUES ('$doc_image')");
$sql = "INSERT INTO upload_files(process_img) VALUES ('$doc_image')";
$q = $db->prepare($sql);
$q->execute(array('pic_img'=>$pic_img));
}



echo "<script>location='file.php';</script>";



    
  }

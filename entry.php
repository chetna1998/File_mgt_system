<?php 
include("header.php");
if ($_POST) 
 {
	$uid = $_POST["id"]; 
	head($uid);
   $fileid = $_POST["fileid"];
 }


$hostname="localhost";
$username="root";
$password="";
$database="fms";

$link = mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno()) 
{
   die("Connect failed: %s\n" + mysqli_connect_error());
   exit();
}
foreach($_POST as $id=>$value)
{
$result = mysqli_query($link, "UPDATE `file_tracking_details` SET `sno`='$value' WHERE `user_id` = '$id' and `file_id` = '$fileid'");
}

$res=mysqli_query($link,"SELECT min(`sno`) as `sno` FROM `file_tracking_details` WHERE `file_id`='$fileid'");
$row = $res->fetch_assoc();
$sn=$row['sno'];


mysqli_query($link,"UPDATE `file_tracking_details` SET `status`=1 WHERE `sno`='$sn'");

$fileid++;
mysqli_query($link,"UPDATE `fileid` SET `file_id`='$fileid'");
  mysqli_close($link);
?>
<form action="home.php">
<input type="hidden" name="uid" value="<?php echo "$uid";?>"/>
<input type = "submit" value="send to first recipient" name="send"/>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php


 include("footer.php");
?>

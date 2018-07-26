<?php
require("libs/config.php");
include("header.php");

if ($_POST) 
 {
   $uid = $_POST['uid'];
   $loca = $_POST['loca'];
   $fid = $_POST['fileid'];
   head($uid);
   echo "hey ".$uid."<br><br>";
 }
 ?>

 <?php

 $con=mysqli_connect("localhost","root","","fms");
// Check connection
             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }

mysqli_query($con,"INSERT into `closed_file_details` (`fid`, `sno`, `uid`, `file_loc`) SELECT `file_id`, `sno`, `user_id`, `file_loc` FROM `file_tracking_details` WHERE `file_id`='$fid'");
			 
mysqli_query($con,"UPDATE `file_tracking_details` SET `status` = '2' WHERE `file_tracking_details`.`file_id` = '$fid' AND `file_tracking_details`.`user_id` = '$uid'");
 
mysqli_query($con,"DELETE from`file_tracking_details` WHERE `file_id`='$fid'");

mysqli_close($con);
	
 ?>

<br><br><br>
<div>
<form action="review.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $uid?>">
<input type="submit" name="Get Me back" value="Get Me Back">
</div>
</form>
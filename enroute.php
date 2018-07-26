<?php
include("header.php");
  $uid = $_GET['id'];
  head($uid);
   echo "Hey UID ".$uid.": )";
   echo "<br>";
   
$link=mysqli_connect("localhost","root","","fms");

             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }


 $result = mysqli_query($link,"SELECT `file_id`, `file_loc`, `sno` FROM `file_tracking_details` WHERE `user_id`='$uid' and `status`=0");
 mysqli_store_result($link);
 $n=mysqli_num_rows($result);
 if($n==0)
 {
	 echo "No files to be recieved by you as of yet";
	 echo "<br>";
 }
 else
 {
	echo 'List of all files which are yet to be received by you: -';
	echo "<br>";
 while($row = mysqli_fetch_assoc($result))
{
   echo "<br>";
   $fid=$row['file_id'];
   $loca=$row['file_loc'];
   echo $loca;
   $sn=$row['sno'];
   echo "<br>";
   $r1 = mysqli_query($link,"SELECT `user_id` FROM `file_tracking_details` WHERE `file_id`='$fid' and `sno`=5000");
   mysqli_store_result($link);
   $row1 = mysqli_fetch_assoc($r1);
   $creator=$row1['user_id'];
   if($creator==$uid)
	   $creator='you';
   else
   {
   $r2 = mysqli_query($link,"SELECT `username` FROM `user_details` WHERE `userid`='$creator'");
   mysqli_store_result($link);
   $row2 = mysqli_fetch_assoc($r2);
   $creator=$row2['username'];
   }
   echo "The file was created by ".$creator."";
   echo "<br>";
   if($sn==5000)
   {
	   echo "You will be closing this file";
   }
   else
   {
   echo "You are marked at sequence number   ".$sn."";
   }
   echo "<br>";
   $r3 = mysqli_query($link,"SELECT `user_id`, `sno` FROM `file_tracking_details` WHERE `file_id`='$fid' and `status`=1");
   mysqli_store_result($link);
   $row3 = mysqli_fetch_assoc($r3);
   $active=$row3['user_id'];
   $seq=$row3['sno'];
   $r4 = mysqli_query($link,"SELECT `username` FROM `user_details` WHERE `userid`='$active'");
   mysqli_store_result($link);
   $row4 = mysqli_fetch_assoc($r4);
   $active=$row4['username'];
   echo "The file is currently active on user  ".$active." with sequence number".$seq."";
   echo "<br>";
}
 }
 echo "<br>";
 echo "<br>";
 echo "<br>";
 echo "<br>";
 $result = mysqli_query($link,"SELECT `file_id`, `file_loc`, `sno` FROM `file_tracking_details` WHERE `user_id`='$uid' and `status`=2");
 mysqli_store_result($link);
  $num=mysqli_num_rows($result);
  if($num==0)
 {
	 echo "No files were reviewed by you as of yet";
	 echo "<br>";
 }
 else
 {
   echo 'List of all files which were forwarded by you: -';
 while($row = mysqli_fetch_assoc($result))
{
   $fid=$row['file_id'];
   echo "<br>";
   $loca=$row['file_loc'];
   echo $loca;
   echo "<br>";
   $sn=$row['sno'];
   echo "You reviewed this file at sequence number".$sn."";
   $r1 = mysqli_query($link,"SELECT `user_id`, `sno` FROM `file_tracking_details` WHERE `file_id`='$fid' and `status`=1");
   mysqli_store_result($link);
   $row1 = mysqli_fetch_assoc($r1);
   $active=$row1['user_id'];
   $seq=$row1['sno'];
   $r2 = mysqli_query($link,"SELECT `username` FROM `user_details` WHERE `userid`='$active'");
   mysqli_store_result($link);
   $row2 = mysqli_fetch_assoc($r4);
   $active=$row2['username'];
   echo "The file is currently active on user  ".$active." with sequence number".$seq."";
 }
 }
 ?>
   <button name = "back"><a href="home.php?uid=<?php echo $uid;?>">go back to home page</a></button>
   <?php
   include("footer.php");
   ?>
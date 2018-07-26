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

 $result=mysqli_query($link,"SELECT `fid`, `sno`, `file_loc` FROM `closed_file_details` WHERE `uid`='$uid'");
 mysqli_store_result($link);
 $n=mysqli_num_rows($result);
 if($n==0)
 {
	 echo "You have no backed up files";
	 echo "<br>";
 }
 else
 {
	echo 'List of all closed files which were reviewed by you : -';
	echo "<br>";
 while($row = mysqli_fetch_assoc($result))
{
   echo "<br>";
   $fid=$row['fid'];
   $loca=$row['file_loc'];
   $sn=$row['sno'];
   if($sn==5000)
   {
	   echo "This file was created and closed by you";
	   echo "<br>";
	   echo "File: ".$loca."";
	   ?>
	   <button name ="download" > <a href="<?php echo $loca?>" download="<?php echo $loca?>"> Download This File</a></button>
	   <?php
   }
   else
   {
	  echo "Click the link below to download the copy you reviewed";
	   echo "<br>";
	   echo "File: ".$loca."";
	   echo "<br>";
	   ?>
	   <button name ="download" > <a href="<?php echo $loca?>" download="<?php echo $loca?>"> Download This File</a></button>
	   <?php 
   $r1 = mysqli_query($link,"SELECT `file_loc` FROM `closed_file_details` WHERE `fid`='$fid' and `sno`=5000");
   mysqli_store_result($link);
   $row1 = mysqli_fetch_assoc($r1);
   $loca=$row1['file_loc'];
   echo "<br>";
   echo "<br>";
   echo "Click the link below to download the final copy";
   echo "<br>";
   echo "File: ".$loca."";
   echo "<br>";
?>
<button name ="download" > <a href="<?php echo $loca?>" download="<?php echo $loca?>"> Download This File</a></button>
<?php   

   } 
}
 }
 echo "<br>";
 echo "<br>";
 echo "<br>";
 
?>
<button name = "back"><a href="home.php?uid=<?php echo $uid;?>">go back to home page</a></button>
<br><br><br><br><br><br><br>
<?php
include("footer.php");
?>
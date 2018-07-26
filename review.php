<?php
require("libs/config.php");
include("header.php");
$on=1;
 if ($_POST) 
 {
   $uid = $_POST['id'];
   head($uid);
   echo "hey ".$uid."<br><br>";
 }

session_start();

$hostname="localhost";
$username="root";
$password="";
$database="fms";

$link = mysqli_connect($hostname,$username,$password,$database);
if (mysqli_connect_errno()) {
   die("Connect failed: %s\n" + mysqli_connect_error());
   exit();
}
 echo 'List of all files which are currently active for you is below';
 echo "<br>";
 $result = mysqli_query($link,"SELECT `file_id`, `file_loc`, `sno` FROM `file_tracking_details` WHERE `user_id`='$uid' and `status`='$on'");

 $n=mysqli_num_rows($result);
 
 
 //check if files are there
 echo "You have total files to be reviewed ".$n."<br><br>";
 if($n>0){
 ?>
 
 <form action="uploadreview.php" method="post" enctype="multipart/form-data">
 <?php
 
 while($row = mysqli_fetch_assoc($result))
{
	
   $fid=$row['file_id'];
   $loca=$row['file_loc'];
   $sqno=$row['sno'];
   $sqno_array[$fid]=$sqno;
   $details[$fid] =$loca;
   if($sqno==5000)
   {
     echo "You created this file";
	 echo "<br>";
	 echo "click the link below to download the file and close it";
	 echo "<br>";
	 echo "<br>";
   }
   $inputs = '<input type="radio" name=file value="'.$fid.'">'.$fid.'  '.$loca.'</input><br><br><br>';
   echo $inputs."<br>";

   ?>
   
        <input type='hidden' name='uid' value="<?php echo $uid;?>"/>
		 <input type='hidden' name='details[<?php echo $fid;?>]' value="<?php echo $loca;?>"/>
		 <input type='hidden' name='sqno_array[<?php echo $fid;?>]' value="<?php echo $sqno;?>"/>
	<input type="submit" name="download" value="download">
   <br><br><br>
   
   <br>
   
<?php
}print_r($details);}else
 {
	 echo "Cheer Up !!! No file to be reviewed...... ;)";
 }
 ?>
 
 
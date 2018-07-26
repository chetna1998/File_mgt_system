<?php

require("libs/config.php");
include("header.php");
$fid=$_POST['fid'];
$uid=$_POST['uid'];
$sqno=$_POST['sqno'];
head($uid);
echo $fid."  ".$uid."  ".$sqno."<br>";

//move file
if($_FILES["fileR"]["error"]>0)
{
    $file_result .= "No File Uploaded Or Invalid File ";
    $file_result .= "Error Code: ".$_FILES["file"]["error"] . "<br>" ;
     header('Location: file.php');
exit;
}
else
{
    $target_dir = "uploads/";
//dirname pathname and basename
$target_file = $target_dir . basename($_FILES["fileR"]["name"]);
    
   echo "Upload : ".$_FILES["fileR"]["name"]."<br>" .
    "Type : ".$_FILES["fileR"]["type"]."<br>" .
    "Size : ".$_FILES["fileR"]["size"]."<br>" ;
    move_uploaded_file($_FILES["fileR"]["tmp_name"],$target_file );
    echo "File Upload Successful. ";
}	
	
//make connection

$con=mysqli_connect("localhost","root","","fms");
// Check connection
             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }

//update status to 2 already passed
$on=0;
$pa=2;
mysqli_query($con,"UPDATE `file_tracking_details` SET `status` = '2' WHERE `file_tracking_details`.`file_id` = '$fid' AND `file_tracking_details`.`user_id` = '$uid'");

//for the next uid corresponding to fid update status to one
$res=mysqli_query($con,"SELECT min(`sno`) as `sno`  FROM `file_tracking_details` WHERE `file_id`='$fid' AND `status` = '$on' AND `sno`>='$sqno'");

print_r($res);

$n=0;
$row = $res->fetch_assoc();
$n=count($row);
	print_r($row);
$stat=1;
$sn=$row['sno'];
$start=date("Y-m-d");
if($n>0){
mysqli_query($con,"UPDATE `file_tracking_details` SET `status`='$stat', `duration`='$start', `file_loc`='$target_file' WHERE `sno`='$sn' AND `file_id`='$fid' LIMIT 1");}
else{
	echo "Cheers;).....Your file is reviewed by all...";
}

         mysqli_close($con);
		 ?>

<marquee dir='alt'>Thank U</marquee>
<form action="review.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $uid?>">
<input type="submit" name="Get Me back" value="Get Me Back">
</form>
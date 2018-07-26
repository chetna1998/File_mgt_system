<?php
require("libs/config.php");
include("header.php");
//uid..
if ($_POST) 
 {
   $uid = $_POST['uid'];
   head($uid);
   echo "hey ".$uid."<br><br>";
 }
 ?>
 <div >
 <?php
 $on=0;
 //file id..
 $fileid = $_POST['file'];
 echo $fileid."  ";
 
 //my current sequence...
 $sqno_array = $_POST['sqno_array'];
 $sqno=$sqno_array[$fileid];
 echo $sqno;
 
 //my file location..
 $location = $_POST['details'];
 $loca=$location[$fileid];
 echo $loca."<br>";
 if($sqno==5000)
 {
 ?>
 <button name ="download" > <a href="<?php echo $loca?>" download="<?php echo $loca?>"> Download My File To Closed</a></button>
<form action="close.php" method="post" enctype="multipart/form-data">
	  <input type='hidden' name='uid' value="<?php echo $uid;?>"/>
		 <input type='hidden' name='loca' value="<?php echo $loca;?>"/>
		 <input type='hidden' name='fileid' value="<?php echo $fileid;?>"/>
	<input type="submit" name="close" value="close">
<?php
 }
 else
 {
	 ?>
<button name ="download" > <a href="<?php echo $loca?>" download="<?php echo $loca?>"> Download My File To Be Reviewed</a></button>

</div>
<br><br><br>
<div>

<form action="sendReview.php" method="post" enctype="multipart/form-data">
Select Your Reviewed file to upload<br>
	<input type="file" name="fileR" id="fileR"><br>
	<div>

	</div>
		<input type='hidden' name='uid' value="<?php echo "$uid";?>"/>
		<input type='hidden' name='sqno' value="<?php echo "$sqno";?>"/>
		<input type='hidden' name='fid' value="<?php echo "$fileid";?>"/>
	<input type="submit" name="submit" value="upload">
	</div>

</form>
<?php
 }
 ?>
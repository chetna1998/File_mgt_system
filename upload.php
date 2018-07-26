<?php
include("header.php");
$fileid;
 if ($_POST) 
 {
   $id = $_POST["id"];
   head($id);
    echo "Hey UID ".$id."   : )<br><br>";
 }	

?>

<?php

    $file_result = "";
	$target_file;


function get_options(){
    $options='';
            $con=mysqli_connect("localhost","root","","fms");
// Check connection
             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }

             $sql = "SELECT `userid`,`username`, `mailid` FROM `user_details`";
             $result = mysqli_query($con, $sql);
  
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
             
	while($row = mysqli_fetch_assoc($result)){
	if($row['userid'] == $_POST["id"]);
	else
	{ $options .= '<option value = "'.$row['userid'].'">'.$row['userid'].")  ".$row['username'].'</option>';
}}
    } else {
    echo "Currently No Receiptents Available.";
           }

           mysqli_close($con);
           return $options;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>My Uploaded File</title>
</head>
<body>
<?php


$con1=mysqli_connect("localhost","root","","fms");
// Check connection
             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }
             //add current user_details`
			$result=mysqli_query($con1,"SELECT `file_id` FROM `fileid`");

			$row = $result->fetch_assoc();
			$fileid=$row['file_id'];
		    mysqli_close($con1);

			$target_file="";
if(!isset($arrange))
{
	
if($_FILES["fileU"]["error"]>0)
{
    $file_result .= "No File Uploaded Or Invalid File ";
    $file_result .= "Error Code: ".$_FILES["fileU"]["error"] . "<br>" ;
     header('Location: file.php');
exit;
}
else
{
    $target_dir = 'uploads/';
//dirname pathname and basename
$target_file = $target_dir . basename($_FILES["fileU"]["name"]);
    $file_result .=
    "Upload : ".$_FILES["fileU"]["name"]."<br>" .
    "Type : ".$_FILES["fileU"]["type"]."<br>" .
    "Size : ".$_FILES["fileU"]["size"]."<br>"  ;
   echo $file_result;
    move_uploaded_file($_FILES["fileU"]["tmp_name"],$target_file );
    $file_result .= "File Upload Successful. ";
	
	
 }
 
}

$con1=mysqli_connect("localhost","root","","fms");
// Check connection
             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }
             //add current user_details`
			$result=mysqli_query($con1,"SELECT `file_id` FROM `fileid`");
			$row = $result->fetch_assoc();
			
			 $date=date("Y-m-d");
			mysqli_query($con1,"INSERT INTO `file_tracking_details`(`file_id`, `sno`, `file_loc`, `user_id`, `status`, `duration`) VALUES ($fileid,'5000','$target_file','$id','0','$date')");
		    mysqli_close($con1);

?>
<br><h3><b>Choose Your Sending List  (pls gold shift/ctrl while selecting)  </b></h3><br>

<form action="arrange.php" method="post">
 <SELECT name = 'sendlist[]' multiple="MULTIPLE">
        <option value=""> User Id --- Select ---  Name </option>
        <?php echo get_options(); ?>
</SELECT>

<input type='hidden' name='id' value='<?php echo "$id";?>'/>
<input type='hidden' name='fileid' value='<?php echo "$fileid";?>'/>
<input type='hidden' name='target_file' value='<?php echo "$target_file";?>'/>
<input type = "submit" value="arrange" name="arrange"/>


 </form>  
 <br><br><br><br><br><br>
 <?php
 include("footer.php")
 ?>
</body>
</html>
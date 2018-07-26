<?php
include("header.php");
 if ($_POST) 
 {
   $id = $_POST["id"];
   head($id);
   
 }
?>

<?php
$menu = array();
function get_options(){
    $options=''; 
    
            $con=mysqli_connect("localhost","root","","fms");
// Check connection
             if (mysqli_connect_errno())
             {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
             }
              foreach($_POST['sendlist'] as $id=>$value)
             {
				 $sql = 'SELECT `userid`, `username`, `mailid` FROM `user_details` WHERE `userid`='.$value.'';
             $result = mysqli_query($con, $sql);
			 while($row = mysqli_fetch_assoc($result)){
            if (mysqli_num_rows($result) > 0)
            {
				   $menu[] = array(
                    "id" => $id,
                    "userid" =>$row['userid'],
                    "username" =>$row['username'],
                   "mailid" =>$row['mailid'],
                 "sequence"=>0) ;
                $status=0;
                $user_uid=$row['userid'];
                $sq=0;
                $start=date("Y-m-d");
				global $fileid;
				$fileid = $_POST["fileid"];
   $fileloc = $_POST["target_file"];
				mysqli_query( $con,"INSERT INTO `file_tracking_details`(`file_id`, `sno`, `file_loc`, `user_id`, `status`, `duration`) VALUES ('$fileid','$sq','$fileloc','$user_uid','$status','$start')");
			 }}
             }
			 
			 
            
    //output data of each row
           
             foreach ($menu as $id => $value)
        {
          $label1 = '';
          $label1 .= '<label for="user" class="label">'.$value['username'].'  ---  '.$value['mailid'].' </label>';
          echo $label1.'<br> ';
          $inputs = '';
          $inputs .= '<input id="user" type="is_int" class="input" name="'.$value['userid'].'" value="'.$value['sequence'].'">';
          echo $inputs.'<br><br>';
        } 


         mysqli_close($con);
         return ;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Arrange</title>
</head>
<body>
  
  <?php
if(!isset($_POST['sort1']))
{
  $sendlist1 = $_POST['sendlist'];
  if(!isset($sendlist1))
  { //empty sendlist then we will keep the user on same page
    echo "Go Back !!! Choose Senders";
    while(1);
  }}
  ?>
 <form method="post" action="entry.php"> 
          <?php 
           echo get_options(); ?>
          <div class="group">
		  <input type='hidden' name='id' value='<?php echo "$id";?>'/>
		  <input type='hidden' name='fileid' value='<?php echo "$fileid";?>'/>
          <input type="submit" class="button" value="sort1" name="sort1"/>
        </div>
</form>
<br><br><br><br><br><br><br><br><br><br><br>
<?php
include("footer.php");
?>
</body>
</html>
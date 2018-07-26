<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
  <title>File Tranfer Login System</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
  <link rel="stylesheet" href="css/login.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $pass1Err = $pass2Err = $desErr = "";
$name = $email = $pass1 = $pass2 = $des = "";
$uname = $upas ="";
$uErr = $pErr ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["pass1"])) {
    $pass1Err = "password is required";
  } else {
    $pass1 = test_input($_POST["pass1"]);
  }
  
  if (empty($_POST["pass2"])) {
    $pass2Err = "password is required";
  } else {
	  if ($_POST["pass2"]!=$_POST["pass1"])
		$pass2Err = "password must be same";
      else	
    $pass2 = test_input($_POST["pass2"]);

  }
  if (empty($_POST["des"])) {
    $desErr = "this field is required";
  } else {
    $des = test_input($_POST["des"]);
  }
  
    if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
  
    if (!empty($_POST["upas"])) {
    $upas = test_input($_POST["upas"]);
  }
  
  if (!empty($_POST["uname"])) {
    $uname = test_input($_POST["uname"]);
  }
	

}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

if (isset($_POST["submit1"]))
{

 //check values
 $q="SELECT `userid`, `password` FROM `user_details` WHERE `username`='".$uname."'";
 $result = mysqli_query($link, $q);
 mysqli_store_result($link);
 
 $n = mysqli_num_rows($result);
	
 if ( $n == 0)
 {
	 $uErr = "user is not present";
 }
 else
{
   $row = mysqli_fetch_assoc($result);
   $pass=$row["password"];
   $uid=$row["userid"];
	 if($pass != $upas)
	 {
		 $pErr="incorrect password";
	 }
else
{
	if($pass == $upas)
	 {
		 header("Location:home.php?uid=".$uid);
exit;
	 }
}
}
}
if (isset($_POST["submit2"]))
{
//insert into table
if( $nameErr=="" && $emailErr=="" && $desErr=="" && $pass1Err=="" && $pass2Err=="" )
{	
 mysqli_query($link,"INSERT INTO `user_details`(`username`, `password`, `designation`, `mailid`)
 VALUES ('$name','$pass1','$des','$email')");
 $q="SELECT `userid` FROM `user_details` WHERE `username`='".$name."'";
 $result = mysqli_query($link, $q);
 $row = mysqli_fetch_assoc($result);
 $uid=$row["userid"];

  header("Location: home.php?uid=".$uid);
exit;
}
 }
 mysqli_close($link);
 session_write_close();
 
$name = $email = $pass1 = $pass2 = $des = "";
$uname = $upas ="";
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input" name="uname" value="<?php echo $uname;?>">
					<span class="error"><?php echo $uErr;?></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="user" type="password" class="input" data-type="password" name="upas" value="<?php echo $upas;?>">
					<span class="error"><?php echo $pErr;?></span>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="submit1">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
			</div>
			<div class="sign-up-htm">
						<p><span class="error">* required field.</span></p>
				<div class="group">
					<label for="user" class="label">Username</label>
					<span class="error">*</span>
					<input id="user" type="text" class="input" name="name" value="<?php echo $name;?>">
					<span class="error"><?php echo $nameErr;?></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<span class="error">*</span>
					<input id="user" type="password" class="input" data-type="password" name="pass1" value="<?php echo $pass1;?>">	
					<span class="error"> <?php echo $pass1Err;?></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<span class="error">*</span>
					<input id="user" type="password" class="input" data-type="password" name="pass2" value="<?php echo $pass2;?>">
					<span class="error"><?php echo $pass2Err;?></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Designation</label>
					<span class="error">*</span>
					<input id="user" type="text" class="input" name="des" value="<?php echo $des;?>">
					<span class="error"><?php echo $desErr;?></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<span class="error">*</span>
					<input id="user" type="text" class="input" name="email" value="<?php echo $email;?>">
					<span class="error"><?php echo $emailErr;?></span>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up" name="submit2">
				</div>
				<div class="hr"></div>
			</div>
		</div>
	</div>
</div>
</form>
</body>
</html>
<?php
function head($id)
{

	?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>FILE TRANSFER</title>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
		<?php include 'css/iconbar.css';
		      include 'css/sidebar.css';
			  include 'css/forfooter.css';
	    ?>
		</style>
    </head>	
	<body>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="backup.php?id=<?php echo $id;?>">View backed up files</a>
  <a href="enroute.php?id=<?php echo $id;?>">Trace all en-route files</a>
</div>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="icon-bar" >
  <a href="#" title="notifications"><i class="fa fa-bell"></i></a> 
  <a href="notes.php" title="notes"><i class="fa fa-sticky-note"></i></a> 
  <a href="login.php" title="log out"><i class="fa fa-sign-out"></i></a>
</div>
<br><br>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
	document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
	document.getElementById("main").style.marginLeft= "0";
}
</script>
<?php
}
?>
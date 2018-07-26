<!DOCTYPE html>
<html>
<head>
	<title>Vreate File</title>
</head>
<body>
<?php
include("header.php");
 if ($_POST) 
 {
   $id = $_POST["id"];
   head($id);
    echo "Hey UID ".$id."   : )";
 }	

?>
	<div>

<form action="upload.php" method="post" enctype="multipart/form-data">
Select Your file to upload<br>
	<input type="file" name="fileU" id="fileU">
	<div>

	</div>
	<input type="hidden" name="id" value="<?php echo "$id";?>"/>
	<input type="submit" name="submit" value="upload"/>

	
</form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
include("footer.php");
?>
</body>
</html>
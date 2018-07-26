<?php
require("libs/config.php");
include("header.php");
?>


<?php 
   $id = $_GET['uid'];
   head($id);
   echo "Hey UID ".$id.": )";
?>
<br>

<form action="file.php" method="POST">
<p align="center">
<input type="hidden" name="id" value="<?php echo "$id";?>"/>
<input type="submit" value="File create" class="button">
</p>
</form>

<form action="review.php" method="POST" >
<p align="center">
<input type='hidden' name='id' value="<?php echo "$id";?>"/>
<input type="submit" value="File review" class="button">
</p>

</form>
<br><br><br><br><br><br><br><br><br><br><br>

<?php
include("footer.php")
?>
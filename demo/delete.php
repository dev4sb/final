<?php 
include "connection.php";
$sel = mysqli_query($con,"SELECT Profile FROM student WHERE id='".$_POST["id"]."' " );
$row = mysqli_fetch_assoc($sel);
$sql = "DELETE FROM student WHERE id = '".$_POST["id"]."'";  
 if(mysqli_query($con, $sql))  
 {  
       unlink('./img/'.$row['Profile']);
        echo json_encode(array("statusCode"=>200));
     echo 'Data Deleted';  
 }
?>
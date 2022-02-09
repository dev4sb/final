<?php 
include "connection.php";
$post_ids = $_POST['post_id'];

foreach($post_ids as $id){ 
  // Delete record 
  $query = "DELETE FROM student WHERE id=".$id; 
  mysqli_query($con,$query);
}
echo 1
?>
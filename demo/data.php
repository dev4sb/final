<?php

include "connection.php";
 $value="";
  $value='<table class="table table-bordered">
      <tr>
        <th><input type="checkbox" class="form-check-input" id="select_all"></th>
        <th>Sr.No</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Birth Date</th>
        <th>Gender</th>
        <th>Hobby</th>
        <th>Education</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
  ';

if(isset($_POST['search_param'])){




	$search_param = mysqli_real_escape_string($con,$_POST['search_param']);
	$query = mysqli_query($con,"SELECT * FROM student WHERE Firstname Like '%$search_param%' OR Lastname Like '%$search_param%' OR Email Like '%$search_param%' OR DOB Like '%$search_param%' OR Gender Like '$search_param%' OR Hobby Like '%$search_param%' OR Education Like '%$search_param%' OR Description Like '%$search_param%' ORDER BY id DESC LIMIT 5");
	
  while($row=mysqli_fetch_assoc($query))
  {
    
  $value.='<tr id="tr_'.$row['id'].'">
        <td><input type="checkbox" class="form-check-input std_checkbox" id="del_'.$row['id'].'"></td>
        <td>'.$row['id'].'</td>
        <td>'.$row['Firstname'].'</td>
        <td>'.$row['Lastname'].'</td>
        <td>'.$row['Email']. '</td>
        <td>'.$row['DOB'].'</td>
        <td>'.$row['Gender'].'</td>
        <td>'.$row['Hobby'].'</td>
        <td>'.$row['Education'].'</td>
        <td>'.$row['Description'].'</td>
        
        <td><button class="btn btn-success"  id="btn_edit"  data-id2='.$row['id'].'>Edit</button>
        <button type="button" class="btn btn-danger delete" data-id3='. $row['id'].' name="delete">Delete</button></td></tr>';
}

$value.='</table><br/>';
echo $value;

}

?>
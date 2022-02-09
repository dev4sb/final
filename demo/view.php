<?php

include "connection.php";

function display_record()
{

  global $con;
  $record_per_page=5;
  $page ='';
  if(isset($_POST['page']))
  {
    $page = $_POST['page'];
  }
  else
  {
    $page = 1;
  }

  $start_from =($page-1)*$record_per_page;

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
        <th>Profile</th>
        <th>Action</th>
      </tr>
  ';

  
  $query ="SELECT * FROM student ORDER BY id DESC LIMIT $start_from,$record_per_page";
  $result = mysqli_query($con,$query);
  while($row=mysqli_fetch_assoc($result))
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
        <td><img src="./img/'.$row['Profile'].'" style="height: 50px;width: 50px;"></td>        
        <td><button class="btn btn-success"  id="btn_edit"  data-id2='.$row['id'].'>Edit</button>
        <button type="button" class="btn btn-danger delete" data-id3='. $row['id'].' name="delete">Delete</button></td></tr>';
}


$value.='</table><br/><div align="center">';
$page_query = "SELECT * FROM student ORDER BY id DESC";
$page_result = mysqli_query($con,$page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records/$record_per_page);
for($i=1;$i<=$total_pages;$i++)
{
  $value.='<button class="pagination_link" style="cursor:pointer;padding:6px;border:1px solid #ccc;" id="'.$i.'">'.$i.'</button>';
}

$value.='</div><br/>';

echo json_encode(array('statusCode'=>'200','html'=>$value));
}

display_record();



?>
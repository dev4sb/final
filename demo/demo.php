









<?php

include("connection.php");
$query="select *from student ";
$result=mysqli_query($con,$query);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Demo</title>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="validation.js">  </script>
<style type="text/css">
   .error
    {
      width: 100%;
      color: red;
    }

    .a
    {
      width: 17px;
    }
    .pagination_link:hover
    {
      background: grey;
    }
    
</style>
</head>
<body>
  <div class="alert alert-danger" id="danger" style="display: none;" >
    <strong>Deleted!</strong> Data Deleted..........
  </div>
  <div class="alert alert-info" id="update" style="display: none;" >
    <strong>Updated!</strong> Data Updated Successfully..........
  </div>
  <div class="alert alert-success" id="success" style="display: none;" >
    <strong>Inserted!</strong> Data Inserted Successfully..........
  </div>



<div class="container mt-3" style="text-align:right">
  
  <button type="button" data-bs-toggle="modal" data-bs-target="#modal"class="btn btn-primary" >Add +</button></div>
  <button type="button" id="delete" class="btn btn-danger" style="margin:0 60px ; display: none;" >Delete</button></div></br>
  <div class="container">
  <span class="input-group-addon">Search:</span>
     <input type="text" id="search_param" placeholder="Search..." class="form-control" />
   </div>
<div class="container mt-3">
      <div id="table">     
  
</div>
</div>








<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="background-color:#222222">
        <h4 class="modal-title" style=" color:#FFFFFF">Sign Up</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  id="form-signup" class="signup" method="POST" enctype="multipart/form-data"> 
        <h6>Name :-</h6> 
        <div class="input-group mb-3"> 
          <div class="col"> 
            <div class="row"> 
              <div class="col"> 
                <input type="text" class="form-control" placeholder="FirstName" name="firstname" id="firstname">
           </div> 
            <div class="col"> 
                <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" > 
            </div>
         </div> 
       </div>
      </div> 
      <h6>Email :-</h6> 
      <div class="input-group mb-3">
       <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email"> 
     </div> 
      <h6>Birth Date :-</h6>
       <div class="input-group mb-3">
       <input type="Date" class="form-control" name="dob" id="dob"> 
     </div>
      <h6>Gender :-</h6>
        <div style="margin:10px">
          <input type="radio" id="age1" class=" gender form-check-input a " name="gender" value="Male"> Male
          <input type="radio" id="age2" class=" gender form-check-input a " name="gender" value="Female"> Female
          
        </div>
      <h6>Hobby :-</h6>
        <div style="margin:10px">
          <input type="checkbox" class="form-check-input a" name="hobby" id="hobby1" value="Reading"> Reading
          <input type="checkbox" class="form-check-input a" name="hobby" id="hobby2" value="Dancing"> Dancing
          <input type="checkbox" class="form-check-input a" name="hobby" id="hobby3" value="Singing"> Singing
        </div>
      <h6>Education :-</h6>
        <select class="form-select" name="education" id="education">
          <option value="">Select....</option>
          <option value="MCA">MCA</option>
          <option value="ME">ME</option>
          <option value="Bsc" >Bsc</option>
        </select>
     <h6>Description :-</h6>
        <textarea class="form-control" rows="3" id="description" name="description"></textarea>
     <h6>Profile :-</h6>
       <div class="input-group mb-3">
       <input type="file" class="form-control" name="profile" id="profile"> 
     </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <button type="button" value="submit" name="submit" class="btn btn-success" id="BtnSbmt" onclick="SignUp()">submit</button>
        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </div>

</form>
    </div>
  </div>
</div>






<!-- update -->


<div class="modal fade" id="update_modal">

  <div class='modal-dialog'>
    <div class='modal-content'>

      <div class='modal-header' style='background-color:#222222'>
       <h4 class='modal-title' style='color:#FFFFFF'>Update</h4>
        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
      </div>


      <div class='modal-body'>
 
        <form  id='update' class='signup' method='POST'> 
          
        <h6>Name :-</h6> 
        <div class='input-group mb-3'> 
          <div class='col'> 
            <div class='row'> 
              <div class='col'> 
                <input type='text' hidden class='form-control'  id='id' >
                <input type='text' class='form-control' placeholder='FirstName' id='Firstname'>
           </div> 
            <div class='col'> 
                <input type='text' class='form-control' placeholder='Last Name' id='Lastname'> 
            </div>
         </div> 
       </div>
      </div> 
      <h6>Email :-</h6> 
      <div class='input-group mb-3'>
       <input type='email' class='form-control' placeholder='example@email.com' name='Email' id='Email'> 
     </div> 
      <h6>Birth Date :-</h6>
       <div class='input-group mb-3'>
       <input type='Date' class='form-control' name='DOB' id='DOB'> 
     </div>
      <h6>Gender :-</h6>
        <div style='margin:10px'>
          <input type='radio' class='form-check-input a Gender' name='Gender' id='Gender1' value='Male'> Male
          <input type='radio' class='form-check-input a Gender' name='Gender' id='Gender2' value='Female'> Female
        </div>
      <h6>Hobby :-</h6>
        <div style='margin:10px'>
          <input type='checkbox' class='form-check-input a Hobby' name='Hobby' id='Hobby1' value='Reading'> Reading
          <input type='checkbox' class='form-check-input a Hobby' name='Hobby' id='Hobby2' value='Dancing'> Dancing
          <input type='checkbox' class='form-check-input a Hobby' name='Hobby' id='Hobby3' value='Singing'> Singing
        </div>
      <h6>Education :-</h6>
        <select class='form-select' name='Education' id='Education'>
          <option value=''>Select....</option>
          <option value='MCA'>MCA</option>
          <option value='ME'>ME</option>
          <option value='Bsc' >Bsc</option>
        </select>
     <h6>Description :-</h6>
        <textarea class='form-control' rows='3' id='Description' name='Description' ></textarea>
   <!--  <h6>Profile </h6>
        <div class='input-group mb-3'>
          <input type='file' class='form-control' name='Profile' id='Profile'>
        </div>
 -->
      </div>

      <div class='modal-footer'>
            <button type='button' id='bn_update' class='btn btn-success'>Update </button>
        <button type='reset' class='btn btn-primary'>Reset</button>
        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
      </div>

</form>
</div>
    </div>
  </div>
</div>


 
</body>
</html>

<?php
//get data

include "connection.php";

get_record();

function get_record()
{
    global $con;
    $id = $_POST['id'];
    $query = "SELECT * FROM student WHERE id='$id'";
    $result = mysqli_query($con,$query);

    while($row=mysqli_fetch_assoc($result))
    {
        
        $Std_data = [];
        $Std_data["id"]=$row['id'];
        $Std_data["Firstname"]=$row['Firstname'];
        $Std_data["Lastname"]=$row['Lastname'];
        $Std_data["Email"]=$row['Email'];
        $Std_data["DOB"]=$row['DOB']; 
        $Std_data["Description"]=$row['Description'];
        $Std_data["Gender"]=$row['Gender'];
        $Std_data["Hobby"]=$row['Hobby'];  
        $Std_data["Education"]=$row['Education'];
       // $Std_data["Profile"]=$row['Profile'];   
    }
    echo json_encode($Std_data); 
}

?>
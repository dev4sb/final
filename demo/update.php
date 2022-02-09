<?php

include "connection.php";
update_value();
function update_value()
    {
        global $con;
        $id = $_POST['id'];
        $Firstname =$_POST['Firstname'];
        $Lastname = $_POST['Lastname'];
        $Email = $_POST['Email'];
        $DOB =$_POST['DOB'];
        $Description = $_POST['Description'];
        $Gender = $_POST['Gender'];
        $Education = $_POST['Education'];
        $Hobby = $_POST['Hobby'];
        echo $query = "update student set Firstname='$Firstname', Lastname='$Lastname', Email='$Email',DOB='$DOB',Description='$Description',Gender='$Gender',Education='$Education',Hobby='$Hobby' where id='$id '";
        $result = mysqli_query($con,$query);
        if($result)
        {
            echo ' Your Record Has Been Updated ';
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }

?>
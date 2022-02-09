<?php
	include 'connection.php';
	print_r($_FILES);

	$data=json_decode($_POST['data']);
	$firstname=$data->firstname;
	$lastname=$data->lastname;
	$email=$data->email;
	$dob=$data->dob;
	$gender=$data->gender;
	$hobby=implode(',', $data->hobby);
	$education=$data->education;
	$description=$data->description;
	$FilePath = "./img/". $firstname . ".png";
	$profile=$data->firstname.".png";
	move_uploaded_file($_FILES["pimage"]["tmp_name"], $FilePath);
	echo $sql = "INSERT INTO `student`( `firstname`, `lastname`, `email`,`dob`,`gender`,`hobby`,`education`,`description`,`profile`) 
	VALUES ('$firstname','$lastname','$email','$dob','$gender','$hobby','$education','$description','$profile')";
	if (mysqli_query($con, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($con);
?>
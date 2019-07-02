<?php

if (isset($_POST['upload'])) {
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	$fileAllowed  = array('jpg', 'jpeg', 'png', 'pdf');

	if (in_array($fileActualExt, $fileAllowed)) 
	{
		if ($fileError === 0) 
		{
			if ($fileSize < 1000000) 
			{
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header('Location: index.php?uploadsuccess');
			}
			else
			{
				echo "your file is too big!";
			}
		}
		else
		{
			echo "There was an error";
		}
	}
	else
	{
		echo "youre file is not allowed to upload!";
	}


}

?>
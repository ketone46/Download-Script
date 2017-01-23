<?php
include 'db.php'; //including database connection.

$ext_array = array("pdf","png"); //Defining compatible extensions using array.

$name_old = $_FILES['upload']['name']; //original name of file.

$name = pathinfo($name_old); //Separating file into name and extension.

$ext = $name['extension']; //Storing extension in variable.

if (in_array($ext,$ext_array)) //Checking extension of file.
   {
	$id = uniqid(); //file id.

    $name_new = $name['filename'] . "_" . $id . "." . $name['extension']; //New name with file id attached.

    $url = "uploads/{$name_new}"; //Setting file directory with name here uploads is directory.

    $success = move_uploaded_file($_FILES['upload']['tmp_name'],$url); //moving file to uploads directory.

    //Checking upload status.
    if (!$success) 
       { 
         echo "<p>Upload Error. <a href = index.php>retry</a>.</p>";
         exit;
       }
    else 
       {
		 //File Link.
	     echo "<p>File ".$name_old." Uploaded Successdully.<br>link:<a href=file.php?id=".$id.">file.php?id=".$id."</a></p>";
		 //Inserting original name, file id and directory location of file in database.
		 $sql = "INSERT INTO file (name_old, id, url) VALUES ('$name_old','$id','$url')";
         mysqli_query($link, $sql);
         mysqli_close($link);
       }	
   }
else
   {
	echo "File type not supported"; //If extension is not found in array.
   }
?>

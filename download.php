<?php
include 'db.php'; //including database connection.

$key_id = $_GET['key_id']; //getting download key_id from url.

//Getting file id and clicks from key_id stored earlier.
$sql = "SELECT * FROM link WHERE key_id='$key_id'";
$result = mysqli_query($link, $sql);
$data_query = mysqli_fetch_array($result);
$id = $data_query['id'];
$clicks = $data_query['clicks'];

//Getting file name and file location from file id saved earlier.
$sql2 = "SELECT * FROM file WHERE id='$id'";
$result2 = mysqli_query($link, $sql2);
$data_query2 = mysqli_fetch_array($result2);

$url = $data_query2['url']; //file location.
$name_old = $data_query2['name_old']; // Original name.

if(file_exists($url)) //Checking file existence from location.
   {
     if($clicks == 0) //Checking whether file is downloaded from the unique link or not.
        {
		  //Initaing download with forcing header.
          $file = file_get_contents($url);
          header("Content-type: application/force-download");
          header("Content-Disposition: attachment; filename={$name_old}"); //Adding file name.
          echo $file;
		  
		  //Updating clicks so that link is not used again.
          $q2 = "UPDATE link SET clicks = clicks + 1 WHERE key_id = '$key_id'";
          mysqli_query($link,$q2);	
        }
     else
        {
	      echo "Link Expired"; //else for clicks.
	    }
  }
else
  {
	echo "File does not exist"; //else for file existence.
  }	
?>
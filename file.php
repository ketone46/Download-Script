<?php
include 'db.php'; //including database connection.

$id = $_GET['id']; //Getting file id from url.

$clicks = 0; //initiating clicks=0

$key_id = md5(uniqid()); //Download key_id.

//Getting original file name stored earlier.
$sql = "SELECT * FROM file WHERE id='$id'"; 
$result = mysqli_query($link, $sql);
$data_query = mysqli_fetch_array($result);

$name_old = $data_query['name_old']; //Original File name.

//Inserting key_id file id and clicks to link table in database.
$q2 = "INSERT INTO link (key_id, id, clicks) VALUES ('$key_id','$id','$clicks')";
mysqli_query($link,$q2);

//getting times downloaded.
$q3 = "SELECT * FROM link WHERE id='$id' AND clicks = '1'";
$result3 = mysqli_query($link,$q3);
while (mysqli_fetch_array($result3))
{
	$count = $count + 1;
}
if ($count="")
{
	$count = 0;
}
//Checking for errors in any query.
echo mysqli_error($link);
echo "Name :" .$name_old."<br>"; //echoing original file name.

echo "Link : <a href = download.php?key_id=".$key_id.">download.php?key_id=".$key_id."</a><br>"; //Echoing unique link valid for single download.
echo "Times Downloaded : ".$count;
?>

<?php
// the $_POST[] array will contain the passed in filename and data
// the directory "data" is writable by the server (chmod 777)

// write the file to disk
$subjectID = $_POST['subjectID'];
$folder = $_POST['folder'];
$csvData = $_POST['dataAsCSV'];
// $jsonData = $_POST['dataAsJSON'];

if(!file_exists('data/'.$folder.'/')){ mkdir('data/'.$folder.'/',0777,true);}
file_put_contents('data/'.$folder.'/'.$subjectID.'.csv', $csvData);

//additional backup copy into backup folder
file_put_contents('JSON/'.uniqid().'.txt', $jsonData);
?>

<?php
// the $_POST[] array will contain the passed in filename and data
// the directory "data" is writable by the server (chmod 777)

// write the file to disk
$subjectID = $_POST['subjectID'];
$folder = $_POST['folder'];
$csvData = $_POST['csvStrings'];
$jsonData = $_POST['dataAsJSON'];

//at first, write a backup copy of the json file into backup folder
file_put_contents('JSON/'.uniqid().'.txt', $jsonData);

// then put csvStrings in experiment folder.
if(!file_exists('data/'.$folder.'/')){ mkdir('data/'.$folder.'/',0777,true);}
for ($i = 0; $i < sizeof($csvData); $i++) {
      file_put_contents('data/'.$folder.'/'.$subjectID.'_'.$i.'.csv', $csvData);
}



?>

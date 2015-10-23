<?php
// the $_POST[] array will contain the passed in filename and data
// the directory "data" is writable by the server (chmod 777)

// write the file to disk
$filename = $_POST['filename'];
$folder= $_POST['folder'];
$subjectID= $_POST['subjectID'];
$data= $_POST['filedata'];

if(file_exists('data/'.$folder)){
  mkdir('data/'.$folder,0777)
}
file_put_contents('data/'.$folder.'/'.$subjectID.'.csv', $data)

// if (file_exists($filename)) {
//   file_put_contents($filename, $data, FILE_APPEND);
// } else {
//   file_put_contents($filename, $_POST['filedata']);
// };
?>

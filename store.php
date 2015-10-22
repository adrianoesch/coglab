<?php
// the $_POST[] array will contain the passed in filename and data
// the directory "data" is writable by the server (chmod 777)

// write the file to disk
file_put_contents('data/try.csv', $_POST['filedata']);
file_put_contents($_POST['filename'], $_POST['filedata']);
?>

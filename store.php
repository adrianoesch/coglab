<?php
// the $_POST[] array will contain the passed in filename and data
// the directory "data" is writable by the server (chmod 777)

// write the file to disk
$filename = $_POST['filename'];
if (file_exists($filename)) {
  file_put_contents($filename, $_POST['filedata'],APPEND_FILE);
} else {
  file_put_contents(, $_POST['filedata']);
};
?>

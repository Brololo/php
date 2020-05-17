<?php

$file = $_POST['file'];
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $file . '"');
header('Content-Transfert-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);

?>
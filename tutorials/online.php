<?php
$id=$_REQUEST['id'];


$filePath = $id . '.online';

if (file_exists($filePath)) {
    echo "File exists";
} else {
    echo "File does not exist";
}

?>

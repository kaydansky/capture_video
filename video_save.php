<?php
session_start();

$path = 'video' . DIRECTORY_SEPARATOR;

if (!is_dir($path)) {
    mkdir($path, intval('0755', 8), true);
}
else {
    chmod($path, intval('0755', 8));
}

$_SESSION['temp_name'] = $_POST['video-filename'];
$filePath = $path . $_POST['video-filename'];
$tempName = $_FILES['video-blob']['tmp_name'];

if (!move_uploaded_file($tempName, $filePath)) {
    echo 'Problem saving file: ' . $tempName;
    die();
}

echo 'success';


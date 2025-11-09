<?php

/**
 * Class controller UploadVideo
 * o Save captured video on server
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */

class UploadVideoController {

    public function save() {
        if (!is_dir(VIDEO_FILES_PATH)) {
            mkdir(VIDEO_FILES_PATH, intval('0755', 8), true);
        }
        else {
            chmod(VIDEO_FILES_PATH, intval('0755', 8));
        }
        
        $_SESSION['temp_name'] = $_POST['video-filename'];
        $filePath = VIDEO_FILES_PATH . $_POST['video-filename'];
        $tempName = $_FILES['video-blob']['tmp_name'];

        if (!move_uploaded_file($tempName, $filePath)) {
            echo 'Problem saving file: ' . $tempName;
            die();
        }

        echo 'success';
    }
}

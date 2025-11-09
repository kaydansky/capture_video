<?php

/**
 * Class controller Names
 * o Fetch name from database
 * o Record name to database
 * o Rename video file to user name
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */

class NamesController extends DbModel {
    
    private $queryFile = 'names_queries.php';
    private $name;
    public  $output = array();

    /**
     * Class constructor
     * o Call parent constructor
     */
    public function __construct() {
        parent::__construct(include QUERIES_PATH . $this->queryFile);
    }
    
    public function setName($name) {
        $this->name = Sanitizer::string(filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING));
    }
    
    /**
     * Fetch name from database
     * 
     * @access public
     */
    public function read() {
        $q = $this->query(1);
        $this->output['name'] = $q['rows'] ? '<a href="' . VIDEO_FILES_PATH . str_replace(' ', '_', $q['data'][0]['Name']) . '.webm" target="_blank">' . $q['data'][0]['Name'] . '</a>' : 'Name is unknown';
    }
    
    /**
     * Add name to database
     * 
     * @access public
     */
    public function create() {
        $q = $this->query(2, array('Name' => $this->name));
        
        if ($q['lastId']) {
            $this->renameFile();
        }
        else {
            $this->deleteFile();
        }
    }
    
    /**
     * Rename video file to user entered name
     * o Replace spaces with underlines
     * 
     * @access private
     */
    private function renameFile() {
        $rename = rename(VIDEO_FILES_PATH . $_SESSION['temp_name'], VIDEO_FILES_PATH . str_replace(' ', '_', $this->name) . '.webm');
        
        if ($rename) { 
            unset($_SESSION['temp_name']);
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Delete temp video file
     * 
     * @access private
     */
    private function deleteFile() {
        unlink(VIDEO_FILES_PATH . $_SESSION['temp_name'] . '.webm');
        unset($_SESSION['temp_name']);
    }
}

<?php

/**
 * Class model DbModel
 * o CRUD model for database operations
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */
class DbModel extends MysqlModel {
    
    public $dbh;
    private $query;

    /**
     * Class constructor
     * o Get databse queries from files
     * 
     * @param string $query
     */
    public function __construct(array $query = []) {
        $this->dbh = $this->dbConnect();
        $this->query = $query;
    }
    
    public function query($queryNumber, array $a = [], array $find = [], array $replace = []) {
        $data = $this->dbQuery($this->dbh, str_replace($find, $replace, $this->query[$queryNumber]), $a);

        return $data;
    }    
}

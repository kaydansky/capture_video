<?php

/**
 * Class model Mysql
 * o PDO MySQL interface
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */
class MysqlModel {
    
    private $db = array();
    public $dbh = null;
    
    /**
     * Establish database connection
     * 
     * @access public
     * @uses constants defined in configuration file
     * @param void
     * @return void
     */
    public function dbConnect($database = 'database')
    {
        $this->db = include CONFIG_PATH . 'database/' . $database . '.php';
        
        if (!defined('DATABASE_NAME')) {
            define('DATABASE_NAME', $this->db['database']);
        }

        try {
            $this->dbh = new PDO('mysql:host=' . $this->db['hostname'] . ';dbname=' . $this->db['database'], $this->db['username'], $this->db['password']);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {  
            echo $e->getMessage();  
        }

        return $this->dbh;
    }

    /**
    * Issue query
    * o Return fetch assoc array if any
    * o Return last insert id if any
    * o Returns affected/retrieved rows number
    * 
    * @access public
    * @param string $sql
    * @param array $data
    * @param boolean $catch
    * @return array
    */
    public function dbQuery($dbh, $sql, array $data = [], $catch = false) {
        if ($catch) {   
            echo $sql;
        }
        
        $result = array();
        $sth = $dbh->prepare($sql);
        $sth->setFetchMode(PDO::FETCH_ASSOC);

        try {
            $sth->execute($data);
        } 
        catch (PDOException $ex) {
            echo $_SESSION['message'] = $ex->getMessage() . ' ' . $sql;

            return array('error' => $ex->getMessage());
        }

        if (stripos($sql, 'SELECT') !== false || stripos($sql, 'SHOW') !== false) {
//            foreach ($sth as $row) {
//                $result[] = $row;
//            }
            
            $result = $sth->fetchAll();
        }
        
        return array('data' => $result, 'lastId' => $dbh->lastInsertId(), 'rows' => $sth->rowCount());
    }
}

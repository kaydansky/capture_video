<?php

/**
 * Class model Pager
 * o Get paginated data list
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */
class PagerModel extends DbModel {
    /**
     * Default start page number
     * 
     * @access public
     * @var integer
     */
    public $page = 1;
    
    /**
     * Default total number of records
     * 
     * @access public
     * @var integer
     */
    public $totalRecords = 0;
    
    /**
     * Default total pages number
     * 
     * @access public
     * @var integer
     */
    public $totalPages = 1;
    
    /**
     * Default records per page number
     * 
     * @access public
     * @var integer
     */
    public $recordsPage = 30;
    
    private $uriVarName = 'page';


    /**
     * Get data from database
     * o Get total records number
     * o Get number of pages
     * o Get records for one page
     * 
     * @access public
     * @param string $query
     * @param array $a
     * @param boolean $singlePage
     * @param string $queryTotal
     * @param string $uriVarName
     * @return array
     */
    public function pager($query, array $a = [], $singlePage = false, $queryTotal = '') {
        $q['data'] = array();
        $page = filter_input(INPUT_GET, $this->uriVarName, FILTER_SANITIZE_NUMBER_INT);
        $this->page = $page ?: 1;
        $limit = $singlePage ? '' : ' LIMIT ' . (($this->page - 1) * $this->recordsPage) . ', ' . $this->recordsPage;

        if ($queryTotal) {
            $this->dbQuery($this->dbh, $queryTotal, $a);            
            $this->getTotals($singlePage);
            $q = $this->dbQuery($this->dbh, $query . $limit, $a);
        }
        else {
            $q = $this->dbQuery($this->dbh, $query . $limit, $a);
            $this->getTotals($singlePage);
        }

        if (!count($q['data']) && $this->totalRecords) {
            $limit = ' LIMIT ' . (($this->totalRecords - $this->recordsPage) > 0 ?: '1') . ', ' . $this->recordsPage;
            $q = $this->dbQuery($this->dbh, $query . $limit, $a);
            $this->page = $this->totalPages;
        }

        return $q['data'];
    }
    
    public function getTotals($singlePage) {
        $n = $this->dbQuery($this->dbh, 'SELECT FOUND_ROWS() AS total');
        $this->totalRecords = $n['data'][0]['total'];
        $this->totalPages = ceil($this->totalRecords / ($singlePage ? $this->totalRecords : $this->recordsPage));
    }
}

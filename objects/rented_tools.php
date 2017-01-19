<?php 
class Rented_tools{ 
    // database connection and table name 
    private $conn; 
    private $table_name = "rented_tools"; 
 
    // rented_tools fields
    public $id; 
    public $user_id;
    public $tool_id; 
    public $customer_id;
    public $payment_id;
    public $rented_date; 
 	public $month;
 	
    //tools table fields
    public $tools_id;
    public $type;
    public $name; 
    public $description;
    public $available;
    public $price; 
 
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db;
    }//function
    
    
    // read products
    function readAll(){
    
    	// select all query
    	$query = "SELECT
              id, user_id, tool_id, customer_id, payment_id, rented_date
            FROM
                " . $this->table_name . "
            ORDER BY
                id DESC";
    
    	// prepare query statement
    	$stmt = $this->conn->prepare( $query );
    	 
    	// execute query
    	$stmt->execute();
    	 
    	return $stmt;
    }//function
 
    
    /**
     * use this function for select list for months/years dropdown.
     * 
     * @return unknown
     */
    function getAllMonths(){
    	// select all query
    	$query = "SELECT rented_date
            FROM
                " . $this->table_name . "
            ORDER BY
                id ASC";
    	
    	// prepare query statement
    	$stmt = $this->conn->prepare( $query );
    	
    	// execute query
    	$stmt->execute();
    	
    	return $stmt;
    	
    }//function
    
    
    /**
     * populate rented tools for a selected month
     */
    function getRentedToolForSelectedMonth(){
    	
    	 // select  t.id, t.type, t.name  from rented_tools rt, tools t where rt.rented_date like '2016-09%' and rt.tool_id = t.id  \G
    	$term = "";
    	// query to read single record
    	$query = "SELECT
              DISTINCT t.id, t.type, t.name, t.description, t.price, t.available
            FROM
                " . $this->table_name . " as rt, tools as t
            WHERE
                rt.rented_date like  '".$this->month."%' and  rt.tool_id = t.id ";
    	
    	//$params = array("month%");
    	// prepare query statement
    	$stmt = $this->conn->prepare( $query );
    	 
    	//$stmt->execute(array('month%'));

    	$stmt->bindParam(1, $this->month);
    	
    
    	// execute query
    	$stmt->execute();
    
    
    	return $stmt;
    }//function
    
    

    /**
     * populate all rented tools for a selected month ( this query returns all duplicate t.id.  All tools)
     */
    function getAllRentedToolForSelectedMonth(){
    	 
    	// select  t.id, t.type, t.name  from rented_tools rt, tools t where rt.rented_date like '2016-09%' and rt.tool_id = t.id  \G
    	$term = "";
    	// query to read single record
    	$query = "SELECT
               t.id, t.type, t.name, t.description, t.price, t.available
            FROM
                " . $this->table_name . " as rt, tools as t
            WHERE
                rt.rented_date like  '".$this->month."%' and  rt.tool_id = t.id ";
    	 
    	// prepare query statement
    	$stmt = $this->conn->prepare( $query );
    
    
    	$stmt->bindParam(1, $this->month);
    	 
    
    	// execute query
    	$stmt->execute();
    
    
    	return $stmt;
    }//function
    
    
    
}//class
?>

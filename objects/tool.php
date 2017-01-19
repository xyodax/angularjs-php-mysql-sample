<?php 
class Tool{ 
    // database connection and table name 
    private $conn; 
    private $table_name = "tools"; 
 
    // object properties 
    public $id; 
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
              id, type,  name, description, price, available
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
 
    // read selected tool
    function readOne(){
    	 
    	// query to read single record
    	$query = "SELECT
                id, name, description, price,available,type
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";
    
    	// prepare query statement
    	$stmt = $this->conn->prepare( $query );
    	 
    	// bind id of product to be updated
    	$stmt->bindParam(1, $this->id);
    	 
    	// execute query
    	$stmt->execute();
    
    	// get retrieved row
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	 
    	
    	// set values to object properties
    	$this->id = $row['id'];
    	$this->type = $row['type'];
    	$this->name = $row['name'];
    	$this->price = $row['price'];
    	$this->description = $row['description'];
    	$this->available = $row['available'];
    	
    }//function readOne(){
    
    // create new tool
    function create(){
    	 
    	// query to insert record
    	$query = "INSERT INTO
                " . $this->table_name . "
            SET
              type=:type,  name=:name, price=:price, description=:description ,available=:available";
    	 
    	// prepare query
    	$stmt = $this->conn->prepare($query);
    
    	// posted values
    	$this->type=htmlspecialchars(strip_tags($this->type));
    	$this->name=htmlspecialchars(strip_tags($this->name));
    	$this->price=htmlspecialchars(strip_tags($this->price));
    	$this->description=htmlspecialchars(strip_tags($this->description));
    	$this->available=htmlspecialchars(strip_tags($this->available));
    	
    	// bind values
    	$stmt->bindParam(":type", $this->type);
    	$stmt->bindParam(":name", $this->name);
    	$stmt->bindParam(":price", $this->price);
    	$stmt->bindParam(":description", $this->description);
    	$stmt->bindParam(":available", $this->available);
    	 
    	// execute query
    	if($stmt->execute()){
    		return true;
    	}else{
    		echo "<pre>";
    		print_r($stmt->errorInfo());
    		echo "</pre>";
    
    		return false;
    	}
    }//function
    
    
    // update the product
    function update(){
    
    	// update query
    	$query = "UPDATE
                " . $this->table_name . "
            SET
                type=:type,  name=:name, price=:price, description=:description ,available=:available
            WHERE
                id = :id";
    
    	// prepare query statement
    	$stmt = $this->conn->prepare($query);
    
    	// posted values
    	$this->type=htmlspecialchars(strip_tags($this->type));
    	$this->name=htmlspecialchars(strip_tags($this->name));
    	$this->price=htmlspecialchars(strip_tags($this->price));
    	$this->description=htmlspecialchars(strip_tags($this->description));
    	$this->available=htmlspecialchars(strip_tags($this->available));
    
    	// bind values
    	$stmt->bindParam(':id', $this->id);
    	$stmt->bindParam(":type", $this->type);
    	$stmt->bindParam(":name", $this->name);
    	$stmt->bindParam(":price", $this->price);
    	$stmt->bindParam(":description", $this->description);
    	$stmt->bindParam(":available", $this->available);
    	 
    	// execute the query
    	if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}
    }//function
    
    // delete the product
    function delete(){
    
    	// delete query
    	$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    	 
    	// prepare query
    	$stmt = $this->conn->prepare($query);
    	 
    	// bind id of record to delete
    	$stmt->bindParam(1, $this->id);
    
    	// execute query
    	if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}
    }//function
    
}//class
?>

<?php

//reference site
//https://www.codeofaninja.com/2015/12/angularjs-crud-example-php.html
// TEST DATABASE Connection
 // get database connection
 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
//print_r($db);

// instantiate product object
include_once 'objects/rented_tools.php';
$tool = new Rented_tools($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));


// query products
$stmt = $tool->getAllMonths();
$num = $stmt->rowCount();

$data="";

// check if more than 0 record found
if($num>0){

$x=1;

// retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
		//when parsing the string, double quotes cannot be included for json.
		//if there are double quotes, add escape.
		foreach($row as $key=>$value){
			
			$newValue = preg_replace('/"/', '\"', $value);
			$row[$key] = $newValue;
				
			
		}//foreach($row as $key=>$value){
		
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		
		
		 $data .= '{';
		 			$data .= '"rented_date":"' . $rented_date . '"';
		        $data .= '}'; 
		          
		        $data .= $x<$num ? ',' : ''; $x++;
	        
		}//while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
 }//if($num>0){

// json format output
echo '{"records":[' . $data . ']}';


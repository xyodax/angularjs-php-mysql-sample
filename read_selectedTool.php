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
include_once 'objects/tool.php';
$tool = new Tool($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));


// set ID property of product to be edited
$tool->id = $data->id;


// query products
$tool->readOne();

// create array
$product_arr = array(
    "id" =>  $tool->id,
	"type" => $tool->type,	
    "name" => $tool->name,
    "description" => $tool->description,
    "price" => $tool->price,
	"available"	=> $tool->available
);
 

// make it json format
print_r(json_encode($product_arr));


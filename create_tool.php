<?php 
// get database connection 
include_once 'config/database.php'; 
$database = new Database(); 
$db = $database->getConnection();
 
// instantiate product object
include_once 'objects/tool.php';
$product = new Tool($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input")); 
 
// set product property values
$product->type = $data->type;
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->available = $data->available;

     
// create the product
if($product->create()){
    echo "New tool was added.";
}
 
// if unable to create the product, tell the user
else{
    echo "Unable to add tool.";
}
?>
<?php 
// include database and object files 
include_once 'config/database.php'; 
include_once 'objects/tool.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$tool = new Tool($db);
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));     
 
// set ID property of product to be edited
$tool->id = $data->id;
 
// set product property values
$tool->type = $data->type;
$tool->name = $data->name;
$tool->price = $data->price;
$tool->description = $data->description;
$tool->available = $data->available;
 
// update the product
if($tool->update()){
    echo "Tool was updated.";
}
 
// if unable to update the product, tell the user
else{
    echo "Unable to update tool.";
}
?>
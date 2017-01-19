<?php 
// include database and object file 
include_once 'config/database.php'; 
include_once 'objects/tool.php'; 
 
// get database connection 
$database = new Database(); 
$db = $database->getConnection();
 
// prepare product object
$tool = new Tool($db);
 
// get product id
$data = json_decode(file_get_contents("php://input"));     
 
// set product id to be deleted
$tool->id = $data->id;
 
// delete the product
if($tool->delete()){
    echo "Tool was deleted.";
}
 
// if unable to delete the product
else{
    echo "Unable to delete tool.";
}
?>
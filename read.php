<?php  
//reference site
//https://www.codeofaninja.com/2015/12/angularjs-crud-example-php.html
/* TEST DATABASE Connection
// get database connection
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();
print_r($db);

// instantiate product object
include_once 'objects/tool.php';
$product = new Tool($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));


// query products
$stmt = $product->readAll();
$num = $stmt->rowCount();

$data="";

// check if more than 0 record found
if($num>0){

	$x=1;

	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);

		$data .= '{';
		$data .= '"id":"'  . $id . '",';
		$data .= '"name":"' . $name . '",';
		$data .= '"description":"' . html_entity_decode($description) . '",';
		$data .= '"price":"' . $price . '"';
		$data .= '}';

		$data .= $x<$num ? ',' : ''; $x++; }
}

// json format output
echo '{"records":[' . $data . ']}';
 */
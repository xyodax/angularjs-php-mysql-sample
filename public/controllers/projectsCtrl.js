
angular.module('app')
.controller('projectsCtrl', function($scope, $route,$http) {

	 // hide the create form modal
	$scope.showModal = true;
	
	 
	$(document).ready(function(){
	    // initialize modal
	    $('.modal').modal();
	  
	});
	
	// create new product 
	$scope.createProduct = function(){
	         
		
		//console.log('available '+$scope.available.value);
		
		if($scope.available.value==undefined){
			
			$scope.available_error = 'Available field is required';
			
			//console.log('available '+$scope.available_error);
		}//if($scope.available==undefined){
		
		if ($scope.modalForm.form.$valid) {
            
       
		    // fields in key-value pairs
		    $http.post('create_tool.php', {
		    		'type': $scope.type,
		            'name' : $scope.name, 
		            'description' : $scope.description, 
		            'price' : $scope.price,
		            'available':$scope.available.value
		         
		        }
		    ).success(function (data, status, headers, config) {
		        //console.log(data);
		        // tell the user new product was created
		        Materialize.toast(data, 4000);
		       
		        // close modal
		       $('#modal-product-form').modal('close');
		         
		        // clear modal content
		        $scope.clearForm();
		        
		        //refresh the page to show the new row of  tools.
		        $route.reload();
		    	
		    });
	    
		 }//if ($scope.modalForm.$valid) {
		 
       
	}//$scope.createProduct = function(){
	
	$scope.showCreateForm = function(){
		
		//show the modal
		$scope.showModal =true;
		
		// clear form
	    $scope.clearForm();
	     
	    // change modal title
	    $('#modal-product-title').text("Add New Tool");
	     
	    // hide update product button
	    $('#btn-update-product').hide();
	     
	  
	     
	}//$scope.showCreateForm = function(){
	
	$scope.getAll = function(){
	    $http.get("read_tools.php").success(function(response){
	    	
	    	//dumpObject(response.records);
	        $scope.names = response.records;
	    });
	}
	 // hide the create form modal
	//$scope.showEditModal = true;
	
	 
	/*$(document).ready(function(){
	    // initialize modal
	    $('.modal').modal();
	  
	});
	*/
	$scope.showEditForm = function(tool_id){
		//console.log('id '+tool_id);
		// clear form
	    $scope.clearForm();
	    
	 // post id of t to be edited
	    $http.post('read_selectedTool.php', {
	        'id' : tool_id 
	    })
	    .success(function(data, status, headers, config){
	         
	        // put the values in form
	        $scope.id = data["id"];
	        $scope.name = data["name"];
	        $scope.description = data["description"];
	        $scope.price = data["price"]+' (dollars per week)';
	        $scope.type = data["type"]; 
	        $scope.edit_available= data["available"];
	        //dumpObject(data);
	        
	       
	        // show modal
	        $('#modal-edit-form').modal('open');
	    })
	    .error(function(data, status, headers, config){
	        Materialize.toast('Unable to retrieve record.', 4000);
	    });
	    
	    ///
	}//	$scope.showEditForm = function(){
	
	// clear variable / form values
	$scope.clearForm = function(){
		
		//reset all validation error messages.
		$scope.modalEditForm.form.$setPristine();
		$scope.modalEditForm.form.$setUntouched();
		$scope.available_error='';
		
	    $scope.id = "";
	    $scope.type = "";
	    $scope.name = "";
	    $scope.description = "";
	    $scope.price = "";
	    $scope.edit_available = "";
	}//$scope.clearForm = function(){
	
	// update tool data
	$scope.updateTool = function(){
	         
		
		//console.log('available '+$scope.available.value);
		
		if($scope.edit_available==undefined){
			
			$scope.available_error = 'Available field is required';
			
			//console.log('available '+$scope.available_error);
		}//if($scope.available==undefined){
		
		if ($scope.modalEditForm.form.$valid) {
            
			//since the price string has (dollars per week) in the end, split the () from the string.
			//price field only takes a decimal in database.
			var price_array = $scope.price.split('(');
			
			//price decimal
			var price = price_array[0].trim();
		
			
		    // fields in key-value pairs
		    $http.post('update_tool.php', {
		    	 	'id': $scope.id,
		    		'type': $scope.type,
		            'name' : $scope.name, 
		            'description' : $scope.description, 
		            'price' : price,
		            'available':$scope.edit_available
		         
		        }
		    ).success(function (data, status, headers, config) {
		        //console.log(data);
		        // tell the user new product was created
		        Materialize.toast(data, 4000);
		       
		        // close modal
		       $('#modal-edit-form').modal('close');
		         
		        // clear modal content
		        $scope.clearForm();
		        
		        //refresh the page to show the new row of  tools.
		        $route.reload();
		    	
		    });
	    
		 }//if ($scope.modalForm.$valid) {
		 
       
	}//$scope.updateTool = function(){
	
	$scope.deleteProduct = function(tool_id){
		  // ask the user if he is sure to delete the record
	    if(confirm("Do you want to delete the tool?")){
	        // post the id of product to be deleted
	        $http.post('delete_tool.php', {
	            'id' : tool_id
	        }).success(function (data, status, headers, config){
	             
	            // tell the user product was deleted
	            Materialize.toast(data, 4000);
	             
	          //refresh the page to show the new row of  tools.
		        $route.reload();
	        });
	    }
		
	}//	$scope.deleteProduct = function(){
	
	
	
	//generate a xls file
	$scope.createReport = function(){
		var tools='';
		//get all tools ids.
		$http.get("read_tools.php").success(function(response){
		    	
		        tools= response.records;
		        
				 //get today's date for the file name
			    var d = new Date();
			    var curr_date = d.getDate();
			    var curr_month = d.getMonth() + 1; //Months are zero based
			    var curr_year = d.getFullYear();
			    var today = curr_month + "-" + curr_date + "-" + curr_year;
			   
			    if(tools !=''){
			    	
			    	  for (property in tools) {
				    	  //console.log('property '+tools[property].id);
				    	  
				    	  removeItem("buttons_"+tools[property].id);
				  
				    }
			    	
			    }//if(tools !=''){
			  
	    
			    //generate the spread sheet with the html table data value
				var blob = new Blob([document.getElementById('exportable').innerHTML], {
			         type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
			    });
			    
				 saveAs(blob, "ToolReport-"+today+".xls");
		       
				 //refresh the page to show all removed buttons
			        $route.reload();
			    	
		    });//$http.get("read_tools.php").success(function(response){
	
		 
	}//$scope.createReport = function(){
});
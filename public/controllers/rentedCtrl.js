
angular.module('app')
.controller('rentedCtrl', function($scope, $route,$http) {
	 
	
	 $scope.tools='';
	  
	 //get the select list value and populate the month's data
	   $scope.selectedChange = function(){
		    
		   //hide the pie chart
			$scope.showPieChart =false;
			
		   //console.log('selectedMonth.operator:'+$scope.selectedMonth.operator);
		    //populate tools here
		    $http.post('get_selectedMonthRentedTools.php', {
		        'month' : $scope.selectedMonth.operator,
		        
		    })
		    .success(function(response){
		         
		       // dumpObject(response);
		        $scope.tools = response.records;
		       
		    
		    })
		    .error(function(data, status, headers, config){
		        Materialize.toast('Unable to retrieve record.', 4000);
		    });
		    
	   }//  $scope.selectedChange = function(){
	   
		//populate rented_date from the rented_tools table for months dropdown list
	   $http.get("get_rentedToolMonths.php").success(function(response){
		   	
		    
			 //dumpObject(response.records);
	        var months = response.records;
	        
	        //get the months object and create options array for the dropdown list
		    if(months !=''){
		    	
		    	var operators=[];
		    	var month='';
		    	var previous_month=''
		    	var count=0;
		    	
		    		
		    	//default selection
		        $scope.selectedMonth = {
		            operator: 'selectmonth'
		        }

		    	//first option (which is a default option)
		    	operators[count++]={value: 'selectmonth', displayName: '-Select One-' }
		    	
		    	for (property in months) {
			    	 // console.log('property '+months[property].rented_date);
			    	  
		    		//remove the time from rented_date string (ex  2016-10-31 18:49:15)
			    	  var dates_array = months[property].rented_date.split(' ');
						
						//get the yyyy-mm-dddd part.
						date = dates_array[0].trim();
						
						//now get only yyyy-mm part
						var months_array = date.split('-');
						
						//create yyyy-mm string here
						month = months_array[0]+'-'+months_array[1];
						
						//dont want to add duplicate elements. so check if this month string is not the same as the pre month string
						if((month !='') && (previous_month!=month))
							operators[count++]={ value: month, displayName: month};
			    	 
						//assign this month as a previous month
						previous_month = month;
						
			    }// for (property in months) {
		    	
		    }//if(months !=''){
		    
		    $scope.operators =operators;
		    
		    //console.log( $scope.operators);
		    
	    });
	
		
		//generate a xls file
		$scope.createReport = function(){
			var tools='';
			//get all tools ids.
			
			  $http.post('get_selectedMonthRentedTools.php', {
			        'month' : $scope.selectedMonth.operator,
			        
			    })
			    .success(function(response){
			         
			       // dumpObject(response);
			        $scope.tools = response.records;
			        //get today's date for the file name
				    var d = new Date();
				    var curr_date = d.getDate();
				    var curr_month = d.getMonth() + 1; //Months are zero based
				    var curr_year = d.getFullYear();
				    var today = curr_month + "-" + curr_date + "-" + curr_year;
				   
		    
				    //generate the spread sheet with the html table data value
					var blob = new Blob([document.getElementById('exportable').innerHTML], {
				         type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
				    });
				    
					 saveAs(blob, "RentedToolReport-"+today+".xls");
			       
			    })
			       
				.error(function(data, status, headers, config){
					Materialize.toast('Unable to retrieve record.', 4000);
				 });	
			   
			 
		}//$scope.createReport = function(){
		
		
		//show a pie chart
		$scope.showChart = function(){
			
			//show or hidden the pie chart (Chart button to show/hide)
			$scope.showPieChart =! $scope.showPieChart;
			
			
			//no tools are in the table. so show the error message
			if($scope.tools ==''){
				message="No month is selected";
				 Materialize.toast(message, 4000);
				
			}else{
				
			
				var tools = $scope.tools;
				var labels=[];
				var tool_ids=[];
				var data=[];
				
			
				 //get all rented tools ids
				for (property in tools) {
			    
					 //adding into the ids array
					tool_ids.push(tools[property].id);
					  
			    }//for (property in tools) {
				
			
				
				
				//now populate all rented tools(not distinct tool_id but all duplicate tool_id to count how many time each tool was rented in the month)
				
				//get all tools ids.
				
				  $http.post('get_selectedMonthAllRentedTools.php', {
				        'month' : $scope.selectedMonth.operator,
				        
				    })
				    .success(function(response){
				      
				        var allTools = response.records;
				       
				        //loop thru tools obj and id obj.
				        //get the number of tool ids that was rented.
				        var len = tool_ids.length;
				        for(var i = 0; i < len; i++) {
				        	
				        	 //count the number of each tool_id
					        var counter=0;
					        
				        	for(toolProp in allTools) {
				        		
				        		//console.log('tool_id '+tool_ids[i] );
				        		//console.log('allTools '+allTools[toolProp].id);
				        		
				        		if(tool_ids[i] ==allTools[toolProp].id ){
				        			
				        			//increment the counter
				        			counter++;
				        			
				        		}//if(tool_ids[i] ==allTools[toolProp].id ){
				           
				           
				        	}//for (toolProp in allTools) {
				        	data.push(counter);
				        	//console.log('data '+data);
							
				        }//  for (var i = 0; i < len; i++) {
				      
				        //now add labels from the tool_ids
				        for(var j = 0; j < len; j++) {
				        	
				        	for (prop in tools) {
				        		
				        		//console.log('data '+tool_ids[j] + ' tools.id '+tools[prop].id );
				        		if(tool_ids[j] == tools[prop].id ){
				        			
				        			labels.push(tools[prop].name);
				        			
				        		}//if(data[j] ==tools[prop].id ){
				        		
				        	}//for (prop in tools) {	
				   
				        }//  for(var j = 0; j < data_len; j++) {
				        
				    })// .success(function(response){
				       
					.error(function(data, status, headers, config){
						Materialize.toast('Unable to retrieve all rented tools record.', 4000);
					 });	
				   
			
				
				//labels
				$scope.labels = labels;
				
				//chart data
				$scope.data = data;
				
				//show legend
				$scope.options = {legend: {display: true}};
			}//else
			
		
		}//$scope.showChart = function(){	
		
		//create a PDF file
		$scope.createPDF = function(){
			
			//get html2canvas elements
			//var month = PrintCanvas('month');
			var chart = PrintCanvas('pieChart');
			var table = PrintCanvas('exportable');
		    var month = $scope.selectedMonth.operator;
		    
			//console.log('chart '+chart+'$scope.selectedMonth.operator, '+$scope.selectedMonth.operator);
			//check if a month is selected. if not, show the error message
			if($scope.selectedMonth.operator =='selectmonth'){
				
				Materialize.toast('Month is not selected', 4000);
			
				//check if the pie chart is hidden. If so, remove the chart element from docDefinition to generate a PDF file.
			}else if($scope.showPieChart ==false){
				
				var docDefinition = {
						
		                  content: [
		                    {
		                    	text:month,
		                    	fontSize: 12 
		                    	
		                    },
		                   {  
		                	  image:table,
		                	  width: 500,
		                	  
		                   }]
					}//var docDefinition = {
					
				  //generate a pdf file	
				  pdfMake.createPdf(docDefinition).download("Score_Details.pdf");
				
			}else{
				
				var docDefinition = {
						
		                  content: [
		                   {
				              text:month,
				              fontSize: 12 
				                    	
				           }, 
		                   {
		                  	allowTaint:true,
		                      image: chart,
		                      width: 400,
		                      
		                  },{
		                	  image:table,
		                	  width: 500,
		                	  
		                  }]
					}//var docDefinition = {
					
				  //generate a pdf file	
				  pdfMake.createPdf(docDefinition).download(month+"_rented_tools.pdf");
				  
			}//else
			
		  //this creates html2canvas html element data.
		  function PrintCanvas(divId) {
	            //div canvas
	            var divObj = html2canvas($('#' + divId));
	            var divQueu = divObj.parse();
	            var divCanvas = divObj.render(divQueu);
	            divImg = divCanvas.toDataURL();

	            return divImg;
	        }//function PrintCanvas(divId) { 
		  
		  
		  
		}//$scope.createPDF = function(){
});
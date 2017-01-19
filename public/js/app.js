//reference: https://www.codeofaninja.com/2015/12/angularjs-crud-example-php.html

var app = angular.module('app', ['ngRoute','ngMessages','chart.js','ngSanitize'])
.config(function ( $routeProvider,$compileProvider ) {
    
    'use strict';
    
    $compileProvider.aHrefSanitizationWhitelist(/^\s*(|blob|):/);
    
    $routeProvider
      .when('/', {
        templateUrl: 'public/views/read.html',
        controller: 'projectsCtrl',
        
      })
      .when('/rented', {
          templateUrl: 'public/views/rentedtools.html',
          controller: 'rentedCtrl',
          
        })
       
     
    
      .otherwise({
        redirectTo: '/'
      });
    
  }).run(function($rootScope){
   $rootScope.$on('$routeChangeError', function(event, current, previous, rejection){
      console.log(event, current, previous, rejection)
    })
  });



/**
 * 
 * this function remove a selected div element from the DOM

 * @param itemid

 */
function removeItem( itemid ) {
  var element = document.getElementById(itemid ); // will return element
  element.parentNode.removeChild(element); // will remove the element from DOM
}//function


/**
 * chome way to output an object
 * 
 * @param obj
 */
function dumpObject (obj) {
    var output, property;
    for (property in obj) {
    	
        output += property + ': ' + obj[property] + '; ';
    }
    console.log(' dumpObject '+output);
}



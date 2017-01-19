
//this controller hightlight the selected tab in the index.html
app.controller('navCtrl', 
['$scope', '$location', function ($scope, $location) {
  $scope.navClass = function (page) {
    var currentRoute = $location.path().substring(1) || 'home';
    
   // console.log('currentRout '+currentRoute + 'page '+page);
    return page === currentRoute ? 'menu-top-active' : '';
  };
  
}]);


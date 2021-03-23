var app = angular.module('cvModule',[]);

app.controller('cvControl', function($scope){

 $scope.opleidingen = opleidingen;
 $scope.werkervaring = werkervaring;
 $scope.computerskills = computerskills;
});

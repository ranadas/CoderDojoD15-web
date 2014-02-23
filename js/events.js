var App = angular.module('EventsApp', [])
    .config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.cache = true;
    }]);

App.controller('EventsController', function($scope) {
    $scope.myTime = new Date(); 
    $scope.sometext = 'Rana Das';
    console.log("In Events controller.");
});
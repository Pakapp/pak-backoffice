var fireBase = 'https://pakapp.firebaseio.com';
var pakApp = angular.module('pakApp', ['ngRoute', 'firebase']);

pakApp.config(function($routeProvider) {
  $routeProvider
    .when('/Farm/', {
      templateUrl: 'templates/farm-list.html',
      controller: 'FarmListCtrl'
    })
    .when('/Farm/add', {
      templateUrl: 'templates/farm-add.html',
      controller: 'FarmAddCtrl'
    })
    .when('/Farm/edit/:farmId', {
      templateUrl: 'templates/farm-edit.html',
      controller: 'FarmEditCtrl'
    })
    .otherwise({
      redirectTo: '/Farm/'
    });
});

pakApp.constant('REST', {
  farmList: fireBase + '/farms',
});

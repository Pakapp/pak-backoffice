pakApp.controller('menuCtrl', function($scope, $routeParams) {
  $scope.name = $routeParams.countryName;
});

pakApp.controller('FarmListCtrl', function($scope, REST, $firebaseObject) {
  var ref = new Firebase(REST.farmList);
  var syncObject = $firebaseObject(ref);
  syncObject.$bindTo($scope, 'data');
  $scope.$watch('data', function(value) {
    if (typeof value !== 'undefined') {
      console.log($scope.data);
    }
  });
});

pakApp.controller('FarmAddCtrl', function($scope, REST, $firebaseArray) {
  $scope.data = {
    name: '',
    location: {
      fb_location_id: '',
      lat: 0,
      long: 0,
    },
    products: [],
    packages: [],
  }
  $scope.AddFarm = function() {
    $scope.save = angular.copy($scope.data);
    var tmpProducts = $scope.save.products;
    $scope.save.products = {};
    angular.forEach(tmpProducts, function(value, key) {
      if (value.name != '') {
        $scope.save.products[value.name] = value;
        delete $scope.save.products[value.name].name;
      }
    });
    angular.forEach($scope.save.packages, function(value, key) {
      var tmpItems = value.items;
      value.items = {};
      angular.forEach(tmpItems, function(valueItem, keyItem) {
        if (valueItem.name != '') {
          value.items[valueItem.name] = valueItem;
          if (valueItem.type != '') {
            value.items[valueItem.name][valueItem.type] = true;
          }
          delete value.items[valueItem.name].type;
          delete value.items[valueItem.name].name;
        }
      });
    });
    if ($scope.save.name != '') {
      console.log($scope.save);
      var ref = new Firebase(REST.farmList);
      var addFarm = $firebaseArray(ref);
      addFarm.$add($scope.save);
    }
  }
  $scope.AddProduct = function() {
    var item = {
      name: '',
      amount: '',
      labels: {
        organic: true,
      },
      per: '',
      unit: '',
    }
    $scope.data.products.push(item);
  }
  $scope.AddPackage = function() {
    var item = {
      name: '',
      delivery_area: '',
      items: [],
    }
    $scope.data.packages.push(item);
  }
  $scope.AddPackageItem = function(value) {
    var item = {
      name: '',
      amount: '',
      type: '',
    }
    value.push(item);
  }
});

pakApp.controller('FarmEditCtrl', function($scope, $routeParams, REST, $firebaseObject, $firebaseArray) {
  $scope.data = {
    name: '',
    location: {
      fb_location_id: '',
      lat: 0,
      long: 0,
    },
    products: [],
    packages: [],
  }
  var ref = new Firebase(REST.farmList + '/' + $routeParams.farmId);
  var syncObject = $firebaseObject(ref);
  syncObject.$bindTo($scope, 'getFarm');
  $scope.$watch('getFarm', function(value) {
    if (typeof value !== 'undefined') {
      $scope.data = angular.copy($scope.getFarm);
      var tmpProducts = $scope.data.products;
      $scope.data.products = [];
      angular.forEach(tmpProducts, function(value, key) {
        var products = value;
        products['name'] = key;
        $scope.data.products.push(products);
      });

      angular.forEach($scope.data.packages, function(value, key) {
        var packages = value.items;
        $scope.data.packages[key].items = [];
        angular.forEach(packages, function(valueItem, keyItem) {
          var item = valueItem;
          angular.forEach(valueItem, function(v, k) {
            if (k != 'amount') {
              item['type'] = k;
              delete valueItem[k];
            }
          });
          item['name'] = keyItem;
          $scope.data.packages[key].items.push(item);
        });
      });
      console.log($scope.data);
    }
  });
  $scope.EditFarm = function() {
    $scope.save = angular.copy($scope.data);
    var tmpProducts = $scope.save.products;
    $scope.save.products = {};
    angular.forEach(tmpProducts, function(value, key) {
      if (value.name != '') {
        $scope.save.products[value.name] = value;
        delete $scope.save.products[value.name].name;
      }
    });
    angular.forEach($scope.save.packages, function(value, key) {
      var tmpItems = value.items;
      value.items = {};
      angular.forEach(tmpItems, function(valueItem, keyItem) {
        if (valueItem.name != '') {
          value.items[valueItem.name] = valueItem;
          if (valueItem.type != '') {
            value.items[valueItem.name][valueItem.type] = true;
          }
          delete value.items[valueItem.name].type;
          delete value.items[valueItem.name].name;
        }
      });
    });
    if ($scope.save.name != '') {
      $scope.getFarm = $scope.save;
      console.log($scope.save);
    }
  }
  $scope.AddProduct = function() {
    var item = {
      name: '',
      amount: '',
      labels: {
        organic: true,
      },
      per: '',
      unit: '',
    }
    $scope.data.products.push(item);
  }
  $scope.AddPackage = function() {
    var item = {
      name: '',
      delivery_area: '',
      items: [],
    }
    $scope.data.packages.push(item);
  }
  $scope.AddPackageItem = function(value) {
    var item = {
      name: '',
      amount: '',
      type: '',
    }
    value.push(item);
  }
});

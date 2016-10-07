var app = angular.module('PTUT', []);
app.controller('velov', function($scope, $http) {
    $http.get("velov.json").success(function(data){
        $scope.station = data;
    });
});

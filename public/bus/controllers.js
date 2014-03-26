angular.module('adminb')
	.controller('AdminCtrl', [
		'$scope',
		'Api',
		'$http',
		'$window',
		'flash',
		function($scope, Api, $http, $window, flash) {
			$scope.b = {};
			$scope.display = null;
			$scope.show = function(what) {
				$scope.display = what;
			};

			var successCallback = function() {
				var msg = {
					body: 'Success',
					type: 'success'
				};
				flash.pop(msg);
			};

			var errorCallback = function(err) {
				var msg = {
					body: err.data.error.message,
					type: 'error'
				};

				flash.pop(msg);
			};

			$scope.addItem = function() {
				if (!$scope.b.id)	Api('businesses').save($scope.b, successCallback, errorCallback);
			};

			$scope.select = function(id) {
				$http.post('/admin/business', {id: id}).success(function(data) {
					$window.location.href = '/admin';
				});
			};
		}
	]);
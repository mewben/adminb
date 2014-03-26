angular.module('ssg')
	.controller('AdminCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		'Api',
		'Notify',
		function($rootScope, $scope, $location, Api, Notify) {

			var activePath = null;

			// initialize item every page
			$rootScope.menu = window.menu;
			$rootScope.business = window.business;
			$rootScope.sem_g = window.sem_g;
			$rootScope.item = {};
			$rootScope.itemg = {};
			$rootScope.itemParams = angular.extend({
				filter: 'active'
			}, $location.search());

			var successCallback = function() {
				$rootScope.query();
				Notify.successCallback();
			};

			$scope.$on('$routeChangeSuccess', function() {
				activePath = $location.path();
			});

			$scope.isActive = function(pattern) {
				return (new RegExp(pattern)).test(activePath);
			};

			$scope.changeFilter = function(filter) {
				$rootScope.itemParams.filter = filter;
			};

			$rootScope.showAdd = function() {
				$rootScope.item = {};
				$('#crud').modal();
			};

			$rootScope.editItem = function(item) {
				$rootScope.item = angular.copy(item);
				$('#crud').modal();
			};

			$rootScope.query = function() {
				Api($rootScope.table).query($rootScope.itemParams, function (result) {
					$rootScope.items = result;
					$('.modal').modal('hide');
				}, Notify.errorCallback);
			};

			$rootScope.addItem = function() {
				if(!$rootScope.item.status)	$rootScope.item.status = null;
				if(!$rootScope.item.year)	$rootScope.item.year = null;
				if(!$rootScope.item.college_id)	$rootScope.item.college_id = null;

				if(!$rootScope.item.id)		Api($rootScope.table).save($rootScope.item, successCallback, Notify.errorCallback);
				else						Api($rootScope.table).update({id: $rootScope.item.id}, $rootScope.item, successCallback, Notify.errorCallback);
			};

			$rootScope.deleteItem = function(id) {
				if (confirm("Are you sure you want to delete this item?"))
					Api($rootScope.table).delete({id: id}, successCallback, Notify.errorCallback);
			};

			$rootScope.restoreItem = function(item) {
				if (confirm("Are you sure you want to restore the item?")) {
					item.restore = 1;
					Api($rootScope.table).update({id: item.id}, item, successCallback, Notify.errorCallback);
				}
			};

			$rootScope.forceDeleteItem = function(id) {
				if (confirm("Are you sure you want to permanently remove this item?"))
					Api($rootScope.table).delete({id: id, force: 1}, successCallback, Notify.errorCallback);
			};

			$rootScope.changePassword = function() {
				if ($rootScope.itemg.password_new != $rootScope.itemg.password_confirmation)
					Notify.errorCallback("New password doesn't match.");
				else
					Api('change_password').save($rootScope.itemg, function(result) {
						$('.modal').modal('hide');
						Notify.successCallback("Password Changed Successfully.");
					}, Notify.errorCallback);
			};

			$rootScope.get = function(table) {
				return Api(table).query({list: 1});
			};
		}
	])

	.controller('CustomerCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function ($rootScope, $scope, $location) {
			$rootScope.table = 'customers';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);
		}
	])

	.controller('OrderCtrl', [
		'$rootScope',
		'$scope',
		'$http',
		'Api',
		'$location',
		function ($rootScope, $scope, $http, Api, $location) {
			$rootScope.table = 'orders';
			$scope.display = null;
			$scope.pitems = {};
			$scope.searchText = null;
			$scope.searchResults = {};

			$scope.products = Api('products').query();

			$scope.show = function (what) {
				$scope.display = what;
			};

			$scope.padd = function(p) {
				if (!$scope.pitems.hasOwnProperty(p.id)) { // product not yet added
					p.quantity = 1;
					$scope.pitems[p.id] = p;
				} else {
					$scope.pitems[p.id].quantity += 1;
				}
			};

			$scope.pdel = function(p) {
				if ($scope.pitems.hasOwnProperty(p.id)) { // product not yet added
					$scope.pitems[p.id].quantity -= 1;

					if ($scope.pitems[p.id].quantity === 0)
						delete $scope.pitems[p.id];
				}
			};

			$scope.total = function() {
				var t = 0;
				angular.forEach($scope.pitems, function (value, key) {
					t +=  (value.unitprice * value.quantity) - ( (value.unitprice * value.quantity) * (value.discount / 100) );
				});

				return t;
			};

			$scope.searchCustomer = function() {
				if ($scope.searchText)
					$http.get('/api/v1/customers?search=' + $scope.searchText).success(function (result) {
						$scope.searchResults = result;
					});
			};

			$scope.selectCustomer = function(c) {
				console.log(c);
			};

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);
		}
	])

	.controller('ProductCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function ($rootScope, $scope, $location) {
			$rootScope.table = 'products';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);
		}
	])

	.controller('CampusCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'campuses';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

		}
	])

	.controller('CandidateCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'candidates';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

			$scope.positions = $rootScope.get('positions');
			$scope.party = $rootScope.get('party');
		}
	])

	.controller('CollegeCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'colleges';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

		}
	])

	.controller('ElectionCtrl', [
		'$rootScope',
		'$scope',
		'Api',
		'Notify',
		function($rootScope, $scope, Api, Notify) {
			$scope.steps = undefined;
			$scope.zeroed = false;
			$scope.printed = false;

			$scope.checkLogin = function() {
				Api('users').query({checklogin: 1, pass: $rootScope.item.password}, function (result) {
					$scope.steps = 'initialize';
				}, Notify.errorCallback);
			};

			$scope.initialize = function() {
				Api('initialize').query(function (result) {
					$scope.zeroed = true;
				}, Notify.errorCallback);
			};

			$scope.goTo = function(where) {
				$scope.steps = where;
			};
		}
	])

	.controller('PartyCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'party';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);
		}
	])

	.controller('PositionCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'positions';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

			$scope.colleges = $rootScope.get('colleges');

		}
	])

	.controller('ResultCtrl', [
		'$scope',
		'Api',
		'Notify',
		function($scope, Api, Notify) {
			$scope.results = Api('results').get();
		}
	])

	.controller('SemesterCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'semesters';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

		}
	])

	.controller('UserCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'users';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

			$scope.roles = $rootScope.get('roles');

			$scope.editItem = function(item) {
				$rootScope.item = angular.copy(item);
				$.each($rootScope.item.roles, function(i, val) {
					$rootScope.item.roles[i] = val.id;
				});
				$('#crud').modal();
			};
		}
	])

	.controller('VoterCtrl', [
		'$rootScope',
		'$scope',
		'Api',
		'Notify',
		function($rootScope, $scope, Api, Notify) {
			$rootScope.table = 'voters';

			Api('voters').query({count: 1}, function(result) {
				$scope.count = result;
			}, Notify.errorCallback);

			$scope.generate = function() {
				$('#btn-generate').attr('disabled', true);
				// generate
				Api($rootScope.table).save({generate: 1}, function (result) {
					Notify.successCallback("Pass Codes generated successfully!");
					$('#btn-generate').attr('disabled', false);
				}, Notify.errorCallback);
			};

		}
	]);
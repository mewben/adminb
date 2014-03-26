angular.module('ssg', [
	'ngRoute',
	'ngResource',
	'ui.select2'
])
	.config([
		'$httpProvider',
		'$routeProvider',
		'$locationProvider',
		function ($httpProvider, $routeProvider, $locationProvider) {
			
			$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

			$locationProvider.html5Mode(true);

			jQuery.each(window.menu, function (index, value) {
				if (value.ctrl) {
					$routeProvider.when(value.url, {
						templateUrl: value.temp,
						controller: value.ctrl,
						reloadOnSearch: false
					});
				}
				if (value.sub) {
					jQuery.each(value.sub, function (i, v) {
						if (v.ctrl) {
							$routeProvider.when(v.url, {
								templateUrl: v.temp,
								controller: v.ctrl,
								reloadOnSearch: false
							});
						}
					});
				}
				/*if (value.url) {
					$routeProvider.when(value.url, {
						templateUrl: value.temp,
						controller: value.ctrl,
						reloadOnSearch: false
					});
				}*/
			});

/*			$routeProvider
				.when('/admin', {
					templateUrl: '/ang/partials/admin/dashboard.html',
					reloadOnSearch: false
				})
				.when('/admin/manage/campuses', {
					templateUrl: '/ang/partials/admin/manage.campuses.html',
					controller: 'CampusCtrl',
					reloadOnSearch: false
				})
				.when('/admin/manage/semesters', {
					templateUrl: '/ang/partials/admin/manage.semesters.html',
					controller: 'SemesterCtrl',
					reloadOnSearch: false
				});
*/
			/*$routeProvider.when('/admin', {
				templateUrl: '/ang/partials/admin/dashboard.html',
				reloadOnSearch: false
			});*/
			$routeProvider.when('/admin/404', {templateUrl: '/ang/partials/admin/404.html'});
			$routeProvider.otherwise({redirectTo: '/admin/products'});
		}
	])

	.run([
		'$rootScope',
		'$http',
		'CSRF_TOKEN',
		function ($rootScope, $http, CSRF_TOKEN) {

			$http.defaults.headers.common._token = CSRF_TOKEN;

			$rootScope.$on('$routeChangeStart', function (next, current) {
				$rootScope.items = {};
			});

			$rootScope.$on('$routeChangeSuccess', function (next, current) {
			});
		}
	]);
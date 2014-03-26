angular.module('adminb', [
	'ngResource'
])
	.config([
		'$httpProvider',
		function($httpProvider) {
			$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
		}

	]);
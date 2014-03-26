angular.module('adminb')
	.factory('Api', [
		'$resource',
		function($resource) {

			return function(resource) {
				return $resource(
					'/api/v1/' + resource + '/:id/',
					{id: '@id'},
					{
						'query' : { method: 'GET', isArray: false },
						'update': { method: 'PUT' }
					}
				);
			};
		}
	]);
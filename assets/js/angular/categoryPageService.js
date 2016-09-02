angular.module('categoryPage').factory('FilterService', ['$http', '$q', function ($http, $q) {
    return {
        getProducts: function (requestUrl, requestData, requestCategory) {
            return $http({
                method: 'post',
                url: requestUrl,
                data: $.param({params: requestData, category_id: requestCategory}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (result) {
                    return result;
                })
                .error(function (error) {
                    return $q.reject(error);
                });
        }
    }
}]);
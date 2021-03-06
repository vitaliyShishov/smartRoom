/**
 * Category page controller
 * @param $scope, $http
 * @author Vitaliy Shishov <shishovit@gmail.com>
 */
angular.module('categoryPage')
    .controller('categoryController', ['$scope', '$filter', 'FilterService', function ($scope, $filter, FilterService) {

        $scope.filtersToSend = {};
        $scope.categoryId = 0;
        $scope.limit = 0;
        $scope.limitIncrement = 3;
        $scope.products = null;
        $scope.sortArray = {};
        $scope.propertyName = 'sort_order';
        $scope.reverse = false;


        $scope.init = function (products, filters, url) {
            if (filters) {
                $scope.filters = filters;
            }

            if (Object.keys(products).length > 0) {
                $scope.products = Object.keys($filter('pagination')(products, $scope.limit)).map(function(key) {
                    return $filter('pagination')(products, $scope.limit)[key];
                });
            }

            if (url) {
                $scope.url = url;
            }
        };

        $scope.sortBy = function (property, reverse) {
            $scope.reverse = reverse !== 'false';
            $scope.propertyName = property;
        };

        $scope.getProducts = function (paramId, filterKey) {
            if (typeof filterKey === 'undefined') {
                filterKey = false;
            }

            if (typeof paramId !== 'undefined') {
                $scope.filtersToSend = $filter('sendParams')($scope.filters, $scope.filtersToSend, paramId, filterKey);
            }

            FilterService.getProducts($scope.url, $scope.filtersToSend, $scope.categoryId)
                .then(function (response) {
                    if (Object.keys(response.data.products).length > 0) {
                        $scope.products = Object.keys($filter('pagination')(response.data.products, $scope.limit)).map(function(key) {
                            return $filter('pagination')(response.data.products, $scope.limit)[key];
                        });
                    } else {
                        $scope.products = null;
                    }
                });
        };
    }]);
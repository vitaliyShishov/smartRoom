/**
 * Directive for Category Page
 */
angular.module('categoryPage')
    .directive('filters', function () {
       return function ($scope,element, attrs) {
           $(element).change(function () {
               $scope.getProducts(attrs.filters, $(element).children(':selected').attr('data-filter-key'));
               $scope.$apply();
           });
       }
    })
    .directive('scroll', function () {
        return {
            restrict: 'A',
            link: function ($scope, $element) {
                $(window).scroll(function () {
                    var scrollHeight = $('.logo-contacts').offset().top - $(this).scrollTop();
                    if (scrollHeight < 670) {
                        $scope.limit += $scope.limitIncrement;
                        $scope.init($scope.products);
                        $scope.$apply();
                    }
                });
            }
        };

    });
/**
 * Filter for Category Page
 */
angular.module('categoryPage')
    .filter('sendParams', function () {
        return function (items,itemsToSend, paramId, arrayKey) {
            var object = itemsToSend;

            for(var i in items) {
                if(i == paramId) {
                    for (var j in items[i]['values']) {
                        if (!arrayKey) {
                            delete object[i];
                        } else if (j == arrayKey) {
                            object[i] = items[i]['values'][j];
                        }
                    }
                }
            }
            return object;
        };
    })
    .filter('pagination', function() {
        return function (items, limit) {
            var i = 0;

            for(var key in items) {
                items[key]['flag'] = i < limit;
                i++;
            }
            return items;
        }
    });

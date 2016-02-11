/**
 * Created by Aunne on 5/18/15.
 * add angularjs directives here
 *
 */

//ARA app directive to trigger point-of-interest tooltips
app.directive('pointOfInterest', function(){
    return {
        template: function(elem, attr){
            var bottom = attr.bottom ? attr.bottom + '%' : 25 + '%';
            var right = attr.right ? attr.right + '%' : 75 + '%';

            return '<ul><!-- start point of interest-->' +
                '<li class="cd-single-point ' + attr.class + '" style="bottom:' + bottom + '; right:' + right + ';">' +
                '<a class="cd-img-replace" href="#">?</a>' +
                '<div class="cd-more-info cd-' + attr.position + '"> <!-- 4 classes available: cd-top, cd-bottom, cd-left, cd-right  -->' +
                '<h2>' + attr.title  + '</h2>' +
                '<p>' + attr.description + ' <br><a href="#" class="cd-hide-tooltips btn btn-danger" title="Hide all tooltips">Hide tooltips for this page</a></p>' +
                '<a href="#" class="cd-close-info cd-img-replace" title="Hide this tooltip">Close</a>' +
                '</div>' +
                '</li> <!-- .cd-single-point -->' +
                '</ul><!-- end of point of interest-->'
        }
    }
});

//ARA app directive to trigger outside clicks
app.directive("outsideClick", ['$document','$parse', function( $document, $parse ){
    return {
        link: function( $scope, $element, $attributes ){
            var scopeExpression = $attributes.outsideClick,
                onDocumentClick = function(event){
                    var isChild = $element.find(event.target).length > 0;

                    if(!isChild) {
                        $scope.$apply(scopeExpression);
                    }
                };

            $document.on("click", onDocumentClick);

            $element.on('$destroy', function() {
                $document.off("click", onDocumentClick);
            });
        }
    }
}]);
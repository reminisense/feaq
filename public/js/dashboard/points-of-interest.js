/**
 * Created by USER on 5/14/15.
 */
jQuery(document).ready(function($){
    cookies_functions.deleteCookie(cookies_functions.getPage());
    cookies_functions.loadOnClickCommands();
    cookies_functions.checkPage();
});

app.directive('pointOfInterest', function(){
    return {
        template: function(elem, attr){
            return '<ul><!-- start point of interest-->' +
                '<li class="cd-single-point my-business">' +
                    '<a class="cd-img-replace" href="#">More</a>' +
                    '<div class="cd-more-info cd-' + attr.position + '"> <!-- 4 classes available: cd-top, cd-bottom, cd-left, cd-right  -->' +
                        '<h2>' + attr.title  + '</h2>' +
                        '<p>' + attr.description + ' <br><a href="#" class="cd-hide-tooltips btn btn-danger">Hide all tooltips</a></p>' +
                        '<a href="#" class="cd-close-info cd-img-replace">Close</a>' +
                    '</div>' +
                '</li> <!-- .cd-single-point -->' +
            '</ul><!-- end of point of interest-->'
        }
    }
});

var cookies_functions = {
    loadOnClickCommands: function(){
        cookies_functions.onClickSinglePoint();
        cookies_functions.onClickCloseInfo();
        cookies_functions.onClickHideTooltips();
    },

    onClickSinglePoint: function(){
        //open interest point description
        $('.cd-single-point').children('a').on('click', function(event){
            event.preventDefault();
            var selectedPoint = $(this).parent('li');
            if( selectedPoint.hasClass('is-open') ) {
                selectedPoint.removeClass('is-open').addClass('visited');
            } else {
                selectedPoint.addClass('is-open').siblings('.cd-single-point.is-open').removeClass('is-open').addClass('visited');
            }
            cookies_functions.checkAllTooltipsVisited();
        });
    },

    onClickCloseInfo: function(){
        //close interest point description
        $('.cd-close-info').on('click', function(event){
            event.preventDefault();
            $(this).parents('.cd-single-point').eq(0).removeClass('is-open').addClass('visited');
        });
    },

    onClickHideTooltips: function(){
        $('.cd-hide-tooltips').on('click', function(event){
            event.preventDefault();
            $('.cd-single-point').hide();
            cookies_functions.savePageCookie(cookies_functions.getPage());
        });
    },

    getPage: function(){
        var page = '';
        if(window.location.href.indexOf('my-business') > -1){
            page = 'my_business';
        }else if(window.location.href.indexOf('processqueue') > -1){
            page = 'process_queue';
        }else if(window.location.href.substring(0, window.location.href.length - 1) == window.location.origin){
            page = 'dashboard';
        }
        return page;
    },

    checkPage: function(){
        var page_tooltips = cookies_functions.checkTooltips();
        var page = cookies_functions.getPage();
        if(page != 'dashboard')$('.cd-single-point.my-business').hide();
        if(page_tooltips == 'done')$('.cd-single-point').hide();
    },

    checkTooltips: function(){
        var page = cookies_functions.getPage();
        return cookies_functions.getCookie(page);
    },

    checkAllTooltipsVisited: function(){
        var page = cookies_functions.getPage();
        var all_visited = true;
        $('.cd-single-point').each(function(){
            if(!$(this).hasClass('visited')){
                all_visited = false;
            }
        });

        if(all_visited){
            cookies_functions.savePageCookie(page);
        }
    },

    savePageCookie: function(page){
        cookies_functions.setCookie(page, 'done');
    },

    setCookie: function(cname, cvalue) {
        document.cookie = cname + "=" + cvalue + "; ";
    },

    getCookie: function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
        }
        return "";
    },

    deleteCookie: function(cname){
        document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    }
}
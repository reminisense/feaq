/**
 * Created by USER on 3/12/15.
 */
var google_analytics = {
    load : function(){
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    },
    create: function(){
        ga('create', 'UA-54178246-1', { 'cookieDomain' : 'none' });
    },
    send: function(page, title){
        var data = {
            'page' : page,
            'title' : title
        }
        ga('send', 'pageview', data);
    }
};

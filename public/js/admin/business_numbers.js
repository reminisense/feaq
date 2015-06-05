/**
 * Created by JONAS on 6/5/2015.
 */

$(document).ready(function(){

    $("#start-date").datepicker();
    $("#end-date").datepicker();
    $("#start-date").datepicker('setDate', new Date());
    $("#end-date").datepicker('setDate', new Date());

    $.fn.showNumbers = function(){

        var temp_start_date =  $("#start-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var temp_end_date =  $("#end-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var start_date = new Date(temp_start_date).getTime() / 1000;
        var end_date = new Date(temp_end_date).getTime() / 1000;

        $.get('/admin/businessnumbers/'+ start_date +'/'+end_date, function(response){
            var values = $.parseJSON(response);
            $("#business-numbers").html("<b>"+ values.businesses + "</b>");
            $("#user-numbers").html("<b>"+ values.users + "</b>");
            $("#issued-numbers").html("<b>"+ values.issued_numbers + "</b>");
            $("#called-numbers").html("<b>"+ values.called_numbers + "</b>");
            $("#served-numbers").html("<b>"+ values.served_numbers + "</b>");
            $("#dropped-numbers").html("<b>"+ values.dropped_numbers + "</b>");
        });

    }

    $.fn.updateBusinesses = function(){
        $.get('/admin/allbusinesses', function(response){
            var values = $.parseJSON(response);
            for (i = 0; i < values.businesses.length; i++) {
                console.log(values.businesses[i].name);
                $("#business-dropdown").append("<option value="+i+">"+values.businesses[i].name+"</option>")
            }
        });

    }

    $.fn.showIndustryGraph = function(){

        var temp_start_date =  $("#start-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var temp_end_date =  $("#end-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var start_date = new Date(temp_start_date).getTime() / 1000;
        var end_date = new Date(temp_end_date).getTime() / 1000;
        var industry = $("#industry-dropdown option:selected").text();
        var mode = 'industry';

        window.open('/admin/showgraph/'+start_date+'/'+end_date+'/'+mode+'/'+industry);
    }

    $.fn.showBusinessGraph = function(){

        var temp_start_date =  $("#start-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var temp_end_date =  $("#end-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var start_date = new Date(temp_start_date).getTime() / 1000;
        var end_date = new Date(temp_end_date).getTime() / 1000;
        var business = $("#business-dropdown option:selected").text();
        var mode = 'business';

        window.open('/admin/showgraph/'+start_date+'/'+end_date+'/'+mode+'/'+business);
    }

    $.fn.showCountryGraph = function(){

        var temp_start_date =  $("#start-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var temp_end_date =  $("#end-date").datepicker({ dateFormat: 'dd-mm-yy' }).val();
        var start_date = new Date(temp_start_date).getTime() / 1000;
        var end_date = new Date(temp_end_date).getTime() / 1000;
        var country= $("#country-dropdown option:selected").text();
        var mode = 'country';

        window.open('/admin/showgraph/'+start_date+'/'+end_date+'/'+mode+'/'+country);
    }


    $("#btn-submit-numbers").click(function(){
        $.fn.showNumbers();
    });

    $("#industry-button").click(function(){
        $.fn.showIndustryGraph();
    });

    $("#country-button").click(function(){
        $.fn.showCountryGraph();
    });

    $("#business-button").click(function(){
        $.fn.showBusinessGraph();
    });


    $.fn.showNumbers();
    $.fn.updateBusinesses();

});

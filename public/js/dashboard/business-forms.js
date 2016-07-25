/**
 * Created by RODEL on 7/4/16.
 * initial scripts just to show the behavior of biz forms, needs review and refactor
 */

$(document).ready(function() {

  $( "#record-datepicker" ).datepicker();

  /*create form*/
  $('#create-form').on('click', function(e) {
    $('.create-form-wrap').slideToggle('fast');
    e.preventDefault();
  });

  /*add dynamic field*/
  $('#btn-add-field').on('click', function(e) {
    var label = $('.generate-forms').find('#for-label').val();
    $('.dynamic-inputs').append('<div class="clearfix entry"><div class="col-md-6 col-sm-6 col-xs-12"><strong>'+ label +'</strong></div><div class="col-md-5 col-sm-5 col-xs-10"><input class="form-control" type="text"/></div><div class="col-md-1 col-sm-1 col-xs-2" id="field-actions"><a id="btn-delete-field" href=""><span class="glyphicon glyphicon-trash"></span></a></div></div>');
    e.preventDefault();
  });

  $('.btn-view-form').on('click', function(e) {
    $('#business-form-tabs-table').hide();
    $('#business-forms-tabs').hide();
    $('.create-form-wrap').hide();
    $('.view-form-wrap').fadeIn();
    $('.table-view-signups').fadeIn();
    e.preventDefault();
  });

    $(document).on('click', '#btn-back',function(e) {
        $('#business-form-tabs-table').fadeIn();
        $('#business-forms-tabs').fadeIn();
        $('.create-form-wrap').hide();
        $('.view-form-wrap').hide();
        $('.table-view-signups').hide();
        e.preventDefault();
    });

  $('.form-title').on('click', function(e) {
    $(this).hide();
    $('#edit-form-title').show();
    e.preventDefault();
  });

  $('#option-field').change(function(){
        var value = $('#option-field').val();
        if(value == 'radio'){
            $('#radio-options').fadeIn();
            $('#dropdown-options').hide();
        }else if(value == 'dropdown'){
            $('#radio-options').hide();
            $('#dropdown-options').fadeIn();
        }else{
            $('#radio-options').fadeOut();
            $('#dropdown-options').fadeOut();
        }

    });

    $('#record-option').change(function(){
        var value = $('#record-option').val();
        if(value == 'date'){
            $('#record-datepicker').show();
            $('#record-name').hide();
        }else{
            $('#record-datepicker').hide();
            $('#record-name').show();
        }
    });

    $('#cancel-form').on('click', function(e) {
        $('.create-form-wrap').slideToggle('fast');
        e.preventDefault();
    })
});
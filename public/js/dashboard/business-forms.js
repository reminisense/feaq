/**
 * Created by RODEL on 7/4/16.
 * initial scripts just to show the behavior of biz forms, needs review and refactor
 */

$(document).ready(function() {

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

  /*view forms*/
  $('#btn-view-form').on('click', function(e) {
    $('#business-form-tabs-table').hide();
    $('#business-forms-tabs').hide();
    $('.create-form-wrap').hide();
    $('.view-form-wrap').fadeIn();
    $('.table-view-signups').fadeIn();
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
});
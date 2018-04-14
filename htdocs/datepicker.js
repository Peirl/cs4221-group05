$(document).ready(function(){
  var start_date_input=$('input[name="startDate"]');
  var end_date_input=$('input[name="endDate"]');
  var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
  var options={
    format: 'yyyy-mm-dd',
    container: container,
    todayHighlight: true,
    autoclose: true,
  };
  start_date_input.datepicker(options);
  end_date_input.datepicker(options);
})

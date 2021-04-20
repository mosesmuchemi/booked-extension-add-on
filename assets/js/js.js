//Datepicker
jQuery(document).ready(function () {
  //Datepicker
  var from = jQuery("#from_date").datepicker();
  var to = jQuery("#to_date").datepicker();

  //Hide/Show sms fields
  jQuery(".show_sms_fields").click(function () {
    jQuery(".sms_fields").show();
  });

  jQuery(".hide_sms_fields").click(function () {
    jQuery(".sms_fields").hide();
  });
});

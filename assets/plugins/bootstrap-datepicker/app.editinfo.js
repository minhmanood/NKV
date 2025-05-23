//<![CDATA[
function today() {
    var d = new Date();
    var curr_date = d.getDate();
    if(curr_date < 10){
        curr_date = '0' + curr_date;
    }
    var curr_month = d.getMonth() + 1;
    if(curr_month < 10){
        curr_month = '0' + curr_month;
    }
    var curr_year = d.getFullYear();
    var today = curr_date + "-" + curr_month + "-" + curr_year;

    return today;
}

$(document).ready(function() {
    $('#datePicker').datepicker({
        format: 'dd-mm-yyyy',
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        showOn: 'focus',
        language: 'vi',
        autoclose: true,
        startDate: "01-01-1950",
        endDate: today()
    });
});
//]]>
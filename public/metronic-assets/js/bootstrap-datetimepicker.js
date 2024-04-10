//== Class definition

var BootstrapDatetimepicker = function () {

    //== Private functions
    var demos = function () {

        loadAdminDateTimePicker();
        loadAdminDatePicker();

        // minimal setup
        $('#m_datetimepicker_1').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy.mm.dd hh:ii'
        });

        $('#m_datetimepicker_1_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy.mm.dd hh:ii'
        });

        // input group demo
        $('#m_datetimepicker_2, #m_datetimepicker_1_validate, #m_datetimepicker_2_validate, #m_datetimepicker_3_validate').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy/mm/dd hh:ii'
        });
        $('#m_datetimepicker_2_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy/mm/dd hh:ii'
        });

        // today button
        $('#m_datetimepicker_3').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            todayBtn: true,
            format: 'yyyy/mm/dd hh:ii'
        });
        $('#m_datetimepicker_3_modal').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            todayBtn: true,
            format: 'yyyy/mm/dd hh:ii'
        });

        // orientation
        $('#m_datetimepicker_4_1').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
            format: 'yyyy.mm.dd hh:ii'
        });

        $('#m_datetimepicker_4_2').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-right',
            format: 'yyyy/mm/dd hh:ii'
        });

        $('#m_datetimepicker_4_3').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'top-left',
            format: 'yyyy-mm-dd hh:ii'
        });

        $('#m_datetimepicker_4_4').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            todayBtn: true,
            pickerPosition: 'top-right',
            format: 'yyyy-mm-dd hh:ii:ss'
        });

        $('#m_datetimepicker_5').datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left'
        });

        $('#m_datetimepicker_6').datetimepicker({
            format: "yyyy/mm/dd",
            todayHighlight: true,
            autoclose: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            pickerPosition: 'bottom-left'
        });

        $('#m_datetimepicker_7').datetimepicker({
            format: "hh:ii",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0,
            pickerPosition: 'bottom-left'
        });
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

var BootstrapDaterangepicker = function () {

    //== Private functions
    var demos = function () {
        // input group and left alignment setup

        loadAdminDateRangePicker();

        // $('#m_daterangepicker_2_modal').daterangepicker({
        //     buttonClasses: 'm-btn btn',
        //     applyClass: 'btn-primary',
        //     cancelClass: 'btn-secondary'
        // }, function(start, end, label) {
        //     $('#m_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        // });


        // minimum setup
        $('#m_daterangepicker_1, #m_daterangepicker_1_modal').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        });

        // input group and left alignment setup
        $('#m_daterangepicker_2').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        $('#m_daterangepicker_2_modal').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        // left alignment setup
        $('#m_daterangepicker_3').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_3 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        $('#m_daterangepicker_3_modal').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_3 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });


        // date & time
        $('#m_daterangepicker_4').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY h:mm A'
            }
        }, function(start, end, label) {
            $('#m_daterangepicker_4 .form-control').val( start.format('MM/DD/YYYY h:mm A') + ' / ' + end.format('MM/DD/YYYY h:mm A'));
        });

        // date picker
        $('#m_daterangepicker_5').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        }, function(start, end, label) {
            $('#m_daterangepicker_5 .form-control').val( start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
        });

        // predefined ranges
        var start = moment().subtract(29, 'days');
        var end = moment();

        $('#m_daterangepicker_6').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'هفت روز پیش': [moment().subtract(6, 'days'), moment()],
                '30 روز پیش': [moment().subtract(29, 'days'), moment()],
                'این ماه': [moment().startOf('month'), moment().endOf('month')],
                'ماه گذشته': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function(start, end, label) {
            $('#m_daterangepicker_6 .form-control').val( start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
        });
    }

    var validationDemos = function() {
        // input group and left alignment setup
        $('#m_daterangepicker_1_validate').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_1_validate .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        // input group and left alignment setup
        $('#m_daterangepicker_2_validate').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_3_validate .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });

        // input group and left alignment setup
        $('#m_daterangepicker_3_validate').daterangepicker({
            buttonClasses: 'm-btn btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary'
        }, function(start, end, label) {
            $('#m_daterangepicker_3_validate .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
        });
    }

    return {
        // public functions
        init: function() {
            demos();
            validationDemos();
        }
    };
}();


function loadAdminDateRangePicker() {
    $('.admin-date-range-picker').daterangepicker({
        buttonClasses: 'm-btn btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        locale: {
            format: 'YYYY-MM-DD'
        },
        inputs: $('.range-start-date , .range-end-date'),
    }, function(start, end, label) {
        $(this.element).find('.range-start-date').val( start.format('YYYY-MM-DD HH:mm:ss'));
        $(this.element).find('.range-end-date').val(  end.format('YYYY-MM-DD HH:mm:ss'));
    });
}

function loadAdminDateTimePicker() {
    $('.admin-datetime-picker').datetimepicker({
        todayHighlight: true,
        autoclose: true,
        todayBtn: true,
        pickerPosition: 'top-right',
        format: 'yyyy-mm-dd hh:ii:ss'
    });
}

function loadAdminDatePicker() {
    $('.admin-date-picker').datepicker({
        todayHighlight: true,
        autoclose: true,
        todayBtn: true,
        pickerPosition: 'top-right',
        format: 'yyyy-mm-dd'
    });
}
jQuery(document).ready(function() {
    BootstrapDatetimepicker.init();
    BootstrapDaterangepicker.init();
});

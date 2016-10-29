/**
 * Created by Orhan Gazi on 26.10.2016.
 */


$(document).ready(function () {
    //bootsrap datepicker
    $('#stream-date').datepicker({
        format: 'dd/mm/yyyy',
        startDate: '-3d'
    });

    //clockpicker
    $('#stream-time').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done',
        autoclose: true
    });
});
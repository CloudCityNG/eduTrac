/* ==========================================================
 * QuickAdmin v1.3.2
 * form_elements.js
 * 
 * http://www.mosaicpro.biz
 * Copyright MosaicPro
 *
 * Built exclusively for sale @Envato Marketplaces
 * ========================================================== */ 

$(function()
{    
    /*
     * bootstrap-timepicker
     */
    $('#timepicker1').timepicker();
    $('#timepicker2').timepicker();
    $('#timepicker3').timepicker();
    $('#timepicker4').timepicker();
    $('#timepicker5').timepicker();
    $('#timepicker6').timepicker();
    $('#timepicker7').timepicker({
        minuteStep: 1,
        template: 'modal',
        showSeconds: true,
        showMeridian: false,
        modalBackdrop: true
    });
    $('#timepicker8').timepicker({
        minuteStep: 5,
        showInputs: false,
        disableFocus: true
    });
    $('#timepicker9').timepicker({
        minuteStep: 1,
        secondStep: 5,
        showInputs: false,
        showSeconds: true,
        showMeridian: false
    });
    $('#timepicker10').timepicker({
        template: false,
        showInputs: false,
        minuteStep: 5
    });
    $('#timepicker11').timepicker();
    $('#timepicker12').timepicker();
	
});
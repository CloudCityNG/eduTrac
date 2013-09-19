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
	// button state demo
	$('#btn-loading')
	    .click(function () {
	        var btn = $(this)
	        btn.button('loading')
	        setTimeout(function () {
	            btn.button('reset')
	        }, 3000)
	    });
	
	/* Select2 - Advanced Select Controls */
	
	// Basic
	$('#select2_1').select2();
	
	// Multiple
	$('#select2_2').select2();
	
	// Placeholders
	$("#select2_3").select2({
		placeholder: "Select a State",
		allowClear: true
	});
	$("#select2_4").select2({
	    placeholder: "Select a State",
	    allowClear: true
	});
	
	// tagging support
	//$("#select2_5").select2({tags:["red", "green", "blue"]});
	
	// enable/disable mode
	$("#select2_6_1").select2();
	$("#select2_6_2").select2();
	$("#select2_6_enable").click(function() { $("#select2_6_1,#select2_6_2").select2("enable"); });
	$("#select2_6_disable").click(function() { $("#select2_6_1,#select2_6_2").select2("disable"); });
	
	$('#select2_9').select2();
	$('#select2_10').select2();
	$('#select2_11').select2();
	$('#select2_12').select2();
	$('#select2_13').select2();
	$('#select2_14').select2();
	$('#select2_15').select2();
	$('#select2_16').select2();
	$('#select2_17').select2();
	$('#select2_18').select2();
	$('#select2_19').select2();
	$('#select2_20').select2();
	$('#select2_21').select2();
	$('#select2_22').select2();
	
	// templating
	function format(state) {
	    if (!state.id) return state.text; // optgroup
	    return "<img class='flag' src='http://ivaynberg.github.com/select2/images/flags/" + state.id.toLowerCase() + ".png'/>" + state.text;
	}
	$("#select2_7").select2({
	    formatResult: format,
	    formatSelection: format,
	    escapeMarkup: function(m) { return m; }
	});
	
	/* DateTimePicker */
	
	// default
	$("#datetimepicker1").datetimepicker({
		format: 'yyyy-mm-dd hh:ii',
		startDate: "2013-02-14 10:00",
		minView: 0
	});
	
	// component
	$('#datetimepicker2').datetimepicker({
		format: "dd MM yyyy - hh:ii",
		startDate: "2013-02-14 10:00"
	});
	
	// positioning
	$('#datetimepicker3').datetimepicker({
		format: "dd MM yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2013-02-14 10:00",
        pickerPosition: "bottom-left"
	});
	
	// advanced
	$('#datetimepicker4').datetimepicker({
		format: "dd MM yyyy - hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2013-02-14 10:00",
        minuteStep: 10
	});
	
	// meridian
	$('#datetimepicker5').datetimepicker({
		format: "dd MM yyyy - HH:ii P",
	    showMeridian: true,
	    autoclose: true,
	    startDate: "2013-02-14 10:00",
	    todayBtn: true
	});
	
	// with date only
	$("#datetimepicker6").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
	
	// with date only
	$("#datetimepicker7").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
	
	// with date only
	$("#datetimepicker8").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
    
    // with date only
    $("#datetimepicker9").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
    
    // with date only
    $("#datetimepicker10").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
    
    // with date only
    $("#datetimepicker11").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
    
    // with date only
    $("#datetimepicker12").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
    
    // with date only
    $("#datetimepicker13").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
    
    // with date only
    $("#datetimepicker14").datetimepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true,
        todayBtn: true,
	    minView: 2, // this forces the picker to not go any further than days view
	    pickerPosition: "bottom-left"
	});
	
	/*
	 * Input Masks
	 */
	$.extend($.inputmask.defaults, {
        'autounmask': true
    });

    $("#inputmask-date").inputmask("d/m/y", {autoUnmask: true});
    $("#inputmask-date-1").inputmask("d/m/y",{ "placeholder": "*"});
    $("#inputmask-date-2").inputmask("d/m/y",{ "placeholder": "dd/mm/yyyy" });
    $("#inputmask-phone").inputmask("mask", {"mask": "(999) 999-9999"});
    $("#inputmask-tax").inputmask({"mask": "99-9999999"});
    $("#inputmask-decimal").inputmask('decimal', { rightAlignNumerics: false });
    $("#inputmask-currency").inputmask('\u20AC 999,999,999.99', { numericInput: true, rightAlignNumerics: false, greedy: false});
    $("#inputmask-ssn").inputmask("999-99-9999", {clearMaskOnLostFocus: true });
    
    /*
     * Multiselect
     */
    $('#multiselect-optgroup').multiSelect({ selectableOptgroup: true });
    $('#pre-selected-options').multiSelect();
    $('#multiselect-custom').multiSelect({
    	selectableHeader: "<div class='custom-header'>Selectable items</div>",
    	selectionHeader: "<div class='custom-header'>Selection items</div>",
    	selectableFooter: "<div class='custom-header custom-footer'>Selectable footer</div>",
    	selectionFooter: "<div class='custom-header custom-footer'>Selection footer</div>"
    });
    
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
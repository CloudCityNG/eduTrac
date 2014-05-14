/* ========================================================== 
 * 
 * bootstrap-maxlength.js v 1.5.0 
 * Copyright 2013 Maurizio Napoleoni @mimonap
 * Licensed under MIT License
 * URL: https://github.com/mimo84/bootstrap-maxlength/blob/master/LICENSE
 *
 * ========================================================== */

!function(a){"use strict";a.fn.extend({maxlength:function(b,c){function d(a){var c=a.val(),d=c.match(/\n/g),f=0,g=0;return b.utf8?(f=d?e(d):0,g=e(a.val())+f):(f=d?d.length:0,g=a.val().length+f),g}function e(a){for(var b=0,c=0;c<a.length;c++){var d=a.charCodeAt(c);128>d?b++:b+=d>127&&2048>d?2:3}return b}function f(a,c,e){var f=!0;return!b.alwaysShow&&e-d(a)>c&&(f=!1),f}function g(a,b){var c=b-d(a);return c}function h(a){a.css({display:"block"})}function i(a){a.css({display:"none"})}function j(a,c){var d="";return b.message?d=b.message.replace("%charsTyped%",c).replace("%charsRemaining%",a-c).replace("%charsTotal%",a):(b.preText&&(d+=b.preText),d+=b.showCharsTyped?c:a-c,b.showMaxLength&&(d+=b.separator+a),b.postText&&(d+=b.postText)),d}function k(a,c,d,e){e.html(j(d,d-a)),a>0?f(c,b.threshold,d)?h(e.removeClass(b.limitReachedClass).addClass(b.warningClass)):i(e):h(e.removeClass(b.warningClass).addClass(b.limitReachedClass))}function l(b){var c=b[0];return a.extend({},"function"==typeof c.getBoundingClientRect?c.getBoundingClientRect():{width:c.offsetWidth,height:c.offsetHeight},b.offset())}function m(a,c){var d=l(a),e=a.outerWidth(),f=c.outerWidth(),g=c.width(),h=c.height();switch(b.placement){case"bottom":c.css({top:d.top+d.height,left:d.left+d.width/2-g/2});break;case"top":c.css({top:d.top-h,left:d.left+d.width/2-g/2});break;case"left":c.css({top:d.top+d.height/2-h/2,left:d.left-g});break;case"right":c.css({top:d.top+d.height/2-h/2,left:d.left+d.width});break;case"bottom-right":c.css({top:d.top+d.height,left:d.left+d.width});break;case"top-right":c.css({top:d.top-h,left:d.left+e});break;case"top-left":c.css({top:d.top-h,left:d.left-f});break;case"bottom-left":c.css({top:d.top+a.outerHeight(),left:d.left-f});break;case"centered-right":c.css({top:d.top+h/2,left:d.left+e-f-3})}}function n(a){return a.attr("maxlength")||a.attr("size")}var o=a("body"),p={alwaysShow:!1,threshold:10,warningClass:"label label-success",limitReachedClass:"label label-important",separator:" / ",preText:"",postText:"",showMaxLength:!0,placement:"bottom",showCharsTyped:!0,validate:!1,utf8:!1};return a.isFunction(b)&&!c&&(c=b,b={}),b=a.extend(p,b),this.each(function(){var c,d,e=a(this);e.focus(function(){var b=j(c,"0");c=n(e),d=a('<span class="bootstrap-maxlength"></span>').css({display:"none",position:"absolute",whiteSpace:"nowrap",zIndex:1099}).html(b),e.is("textarea")&&(e.data("maxlenghtsizex",e.outerWidth()),e.data("maxlenghtsizey",e.outerHeight()),e.mouseup(function(){(e.outerWidth()!==e.data("maxlenghtsizex")||e.outerHeight()!==e.data("maxlenghtsizey"))&&m(e,d),e.data("maxlenghtsizex",e.outerWidth()),e.data("maxlenghtsizey",e.outerHeight())})),o.append(d);var f=g(e,n(e));k(f,e,c,d),m(e,d)}),e.blur(function(){d.remove()}),e.keyup(function(a){var f=g(e,n(e)),h=!0;return a.keyCode||a.which,b.validate&&0>f?h=!1:k(f,e,c,d),h})})}})}(jQuery);
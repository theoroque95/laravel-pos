/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');

require('../../../bower_components/jquery-ui/jquery-ui.min');
require('../../../bower_components/bootstrap/dist/js/bootstrap.min');
require('../../../bower_components/jquery-slimscroll/jquery.slimscroll.min');
require('../../../bower_components/jquery-sparkline/dist/jquery.sparkline.min');
require('../../../bower_components/jquery-knob/dist/jquery.knob.min');
require('./plugins/jquery-jvectormap-1.2.2.min');
require('../../../bower_components/bootstrap-daterangepicker/daterangepicker');
require('../../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min');
require('../../../bower_components/fastclick/lib/fastclick');
require('./plugins/bootstrap-slider');
require('./plugins/bootstrap-timepicker.min');
require('./plugins/pace.min');
require('../../../bower_components/raphael/raphael.min');
require('../../../bower_components/morris.js/morris.min');
require('./plugins/jquery.inputmask');
require('./plugins/jquery.inputmask.date.extensions');
require('./plugins/jquery.inputmask.extensions');
require('../../../bower_components/datatables.net/js/jquery.dataTables.min');
require('../../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min');

import moment from 'moment';
import 'moment/locale/en-gb';

require('./BoxRefresh');
require('./BoxWidget');
require('./ControlSidebar');
require('./Layout');
require('./PushMenu');
require('./Tree');

require('./adminlte.min');
require('./dashboard');

$.widget.bridge('uibutton', $.ui.button);

/*
 * CUSTOM FUNCTIONS AND SCRIPTS
 */

// var tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
// var tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

// function GetClock() {
//   var d = new Date();
//   var nday = d.getDay(),nmonth = d.getMonth(),ndate = d.getDate(),nyear = d.getFullYear();
//   var nhour = d.getHours(),nmin = d.getMinutes(),nsec = d.getSeconds(),ap;

//   if(nhour==0){ap=" AM";nhour=12;}
//   else if(nhour<12){ap=" AM";}
//   else if(nhour==12){ap=" PM";}
//   else if(nhour>12){ap=" PM";nhour-=12;}

//   if(nmin<=9) nmin="0"+nmin;
//   if(nsec<=9) nsec="0"+nsec;

//   document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
// }

// window.onload=function(){
//   GetClock();
//   setInterval(GetClock,1000);
// }
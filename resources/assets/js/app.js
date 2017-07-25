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
require('./plugins/icheck.min');
require('./plugins/pace.min');
require('../../../bower_components/raphael/raphael.min');
// require('../../../node_modules/moment/moment');
require('../../../bower_components/morris.js/morris.min');

import moment from 'moment';
import 'moment/locale/en-gb';

require('./BoxRefresh');
require('./BoxWidget');
require('./ControlSidebar');
require('./DirectChat');
require('./Layout');
require('./PushMenu');
require('./TodoList');
require('./Tree');

require('./adminlte.min');
require('./dashboard');

$.widget.bridge('uibutton', $.ui.button);
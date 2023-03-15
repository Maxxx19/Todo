require('./bootstrap');
require('popper.js');
//require('moment.js');

import * as Vue from 'vue'
import { createApp } from 'vue'
import App from './components/app.vue'
import DateFormat from '@voidsolutions/vue-dateformat'
import {SetupCalendar} from 'v-calendar';
import 'v-calendar/dist/style.css';
//import moment from "moment";

/*const app = new Vue({
el:'#app',

})*/

const app = createApp({
  components:{App},  
  data() {
    return {
      count: 0
    }
  }
})
app.use(SetupCalendar, {})
app.mount('#app')
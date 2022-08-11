import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import axios from 'axios';
import VueAxios from 'vue-axios';

import '~/plugins'
import '~/components'

Vue.config.productionTip = false
Vue.use(VueAxios, axios);

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})

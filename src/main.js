import '@/main.scss';

import { createApp } from 'vue';
import store from '@/store';
import App from '@/App.vue';
import router from '@/router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import { createMetaManager, plugin as metaPlugin } from 'vue-meta';
import app_mixin from "./mixin.js";
import lib from '@/lib';

//import 'bootstrap/dist/css/bootstrap.min.css';
//import 'bootstrap';
//import '@/assets/css/bootstrap.min.css';
//import '@/assets/css/icons.min.css';
//import '@/assets/css/app.min.css';
//import '@/assets/css/style.css';

//import '@/assets/js/date.format.js';


const app = createApp(App);
const metaManager = createMetaManager();

window['appInstance'] = null;
window['appComponent'] = null;
window['storeInstance'] = null;

app.config.globalProperties.$store = store;
//app.config.productionTip = false;
//app.config.debug = true;
//app.config.devtools = true;
app.use(router);
app.use(store)
app.use(VueAxios, axios);
app.use(store.state.app.i18n);
app.use(metaManager);
lib.addMixin(app_mixin);
app.mount('#app');

window['lib'] = lib;
window['axios'] = axios;

window['appInstance'] = app;
window['storeInstance'] = store;
//window['routerInstance'] = router;

// Запускаем скрипт проверки авторизации
setTimeout(() => {
	//storeInstance.state.auth.SSI_step1();
}, 100);

require('../bootstrap');

window.Vue = require('vue');

import store from './store';
import App from './App';

new Vue({
    store,
    components: {App}
    //render: h => h(App),
}).$mount('#app');

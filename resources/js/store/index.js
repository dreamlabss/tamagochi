import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

import tamagochi from './modules/tamagochi';

export default new Vuex.Store({
    modules: {
        tamagochi
    },
    strict: false,
});

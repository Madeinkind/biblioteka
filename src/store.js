import { createStore } from "vuex";

import AppModel from '@/models/AppModel.js';


class AppStore
{
	/**
	 * Конструктор
	 */
	constructor()
	{
		this.app = new AppModel();
		this.js_version = "20221004.1";
	}
}

let state = new AppStore();

const getters = {};
const actions = {};
const mutations = {};

const store = createStore({
	namespaced: true,
	state,
	getters,
	actions,
	mutations,
});

export default store;

import { createRouter, createWebHistory } from 'vue-router';

import lib from '@/lib';

import Layout from '@/layouts/Layout.vue';

import Login from '@/pages/Login.vue';
import Main from '@/pages/Main.vue';
import MainAcc from '@/pages/MainAcc.vue';
import MainKniga from '@/pages/MainKniga.vue';
import MainChange from '@/pages/MainChange.vue';
import SpisokChit from '@/pages/SpisokChit.vue';
import MainAdd from '@/pages/MainAdd.vue';
import Langs from '@/pages/Langs.vue';
import Test1 from '@/pages/Test1.vue';
import Test2 from '@/pages/Test2.vue';

import PageNotFound from '@/pages/PageNotFound.vue';

const routes = [
	/*{
		path: '/',
		redirect: '/index',
	},*/
	{
		path: '/',
		component: Layout,
		children: [
			{
				path: '/',
				component: Main,
				meta: {
					//requiresAuth: true,
				},
			},
			{
				path: '/mainacc',
				component: MainAcc,
				meta: {
					//requiresAuth: true,
				},
			},
			{
				path: '/mainkniga',
				component: MainKniga,
				meta: {
					//requiresAuth: true,
				},
			},
			{
				path: '/spisokchit',
				component: SpisokChit,
				meta: {
					//requiresAuth: true,
				},
			},
			{
				path: '/mainchange',
				component: MainChange,
				meta: {
					//requiresAuth: true,
				},
			},
			{
				path: '/mainadd',
				component: MainAdd,
				meta: {
					//requiresAuth: true,
				},
			},
			
			{
				path: '/langs',
				component: Langs,
				meta: {
					//requiresAuth: true,
				},
			},
			
			{
				path: '/test1',
				component: Test1,
			},
			{
				path: '/test2',
				component: Test2,
			},
		],
	},
	{
		path: '/login',
		component: Login,
		meta: {
			//guest: true,
		},
	},
	{
		path: '/logout',
		beforeEnter(to, from, next){
			/*storeInstance.state.app.auth.doLogout().then(() => {
				next({path: '/login'});
			});*/
		},
	},
	{
		path: '/:pathMatch(.*)*',
		name: 'not-found',
		component: PageNotFound,
	},
	{
		path: '/:pathMatch(.*)',
		name: 'bad-not-found',
		component: PageNotFound,
	},
];

const router = createRouter({
	history: createWebHistory(),
	routes,
});

router.beforeEach((to, from, next) => {
	/*storeInstance.state.app.auth.doCheckAuth().then(() => {
		if(to.matched.some(record => record.meta.requiresAuth)){
			if(!storeInstance.state.app.auth.isAuth()){
				next({
					path: '/login',
					params: {
						nextUrl: to.fullPath,
					},
				})
			} else {
				let user = lib.localStorageGet('user')||{};
				if(to.matched.some(record => record.meta.is_admin)){
					if(user.is_admin){
						next()
					} else {
						next('/')
					}
				} else {
					next()
				}
				next()
			}
		} else if(to.matched.some(record => record.meta.guest)){
			if(storeInstance.state.app.auth.isAuth()){
				next('/')
			} else {
				next()
			}
		} else {
			next() 
		}
	});*/
	next() 
});
/*router.beforeEach((to, from, next) => {
	if (to.path == '/login' && storeInstance.state.app.auth.userProfile !== null) next({path: '/'})
  	else next()
})*/

export default router;
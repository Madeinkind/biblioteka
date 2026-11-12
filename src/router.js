import { createRouter, createWebHistory } from 'vue-router';

import lib from '@/lib';

import Layout from '@/layouts/Layout.vue';

import Login from '@/pages/Login.vue';
import BooksIssued from '@/pages/BooksIssued.vue';
import BooksIssuedReturn from '@/pages/BooksIssuedReturn.vue';
import BooksIssuedHistory from '@/pages/BooksIssuedHistory.vue';
import BooksExtradition from '@/pages/BooksExtradition.vue';
import BooksExtraditionAdd from '@/pages/BooksExtraditionAdd.vue';
import Books from '@/pages/Books.vue';
import BooksEdit from '@/pages/BooksEdit.vue';
import ReadersEdit from '@/pages/ReadersEdit.vue';
import Readers from '@/pages/Readers.vue';
import Visitors from '@/pages/Visitors.vue';
import VisitorsAdd from '@/pages/VisitorsAdd.vue';
import VisitorsEdit from '@/pages/VisitorsEdit.vue';
import ReadersAdd from '@/pages/ReadersAdd.vue';
import ReadersDebtors from '@/pages/ReadersDebtors.vue';
import BooksAdd from '@/pages/BooksAdd.vue';

import PageNotFound from '@/pages/PageNotFound.vue';

const routes = [
	{
		path: '/',
		redirect: '/books',
	},
	{
		path: '/',
		component: Layout,
		children: [
			{
				path: '/books',
				component: Books,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/readers-debtors',
				component: ReadersDebtors,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/readers',
				component: Readers,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/visitors',
				component: Visitors,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/visitors/add',
				component: VisitorsAdd,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/visitors/:id/edit',
				component: VisitorsEdit,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/readers/add',
				component: ReadersAdd,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books-issued',
				component: BooksIssued,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books-issued-return/:id',
				component: BooksIssuedReturn,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books-issued-history',
				component: BooksIssuedHistory,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books-extradition',
				component: BooksExtradition,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books-extradition-add',
				component: BooksExtraditionAdd,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books/:id/edit',
				component: BooksEdit,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/readers/:id/edit',
				component: ReadersEdit,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/books/add',
				component: BooksAdd,
				meta: {
					requiresAuth: true,
				},
			},
		],
	},
	{
		path: '/login',
		component: Login,
		meta: {
			guest: true,
		},
	},
	{
		path: '/logout',
		beforeEnter(to, from, next){
			storeInstance.state.app.auth.doLogout().then(() => {
				next({path: '/login'});
			});
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
	storeInstance.state.app.auth.doCheckAuth().then(() => {
		if(to.matched.some(record => record.meta.requiresAuth)){
			if(!storeInstance.state.app.auth.isAuth()){
				next({
					path: '/login',
					params: {
						nextUrl: to.fullPath,
					},
				})
			} else {
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
	});
});
/*router.beforeEach((to, from, next) => {
	if (to.path == '/login' && storeInstance.state.app.auth.userProfile !== null) next({path: '/'})
  	else next()
})*/

export default router;
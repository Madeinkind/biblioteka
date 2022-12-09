import { createRouter, createWebHistory } from 'vue-router';

import lib from '@/lib';

import Layout from '@/layouts/Layout.vue';

import Login from '@/pages/Login.vue';
import RecoveryPassword from '@/pages/RecoveryPassword.vue';

import Main from '@/pages/Main.vue';
import Auditories from '@/pages/Auditories.vue';
import AuditoriesLoad from '@/pages/AuditoriesLoad.vue';
import CallSchedule from '@/pages/CallSchedule.vue';
import JournalStudentStatuses from '@/pages/JournalStudentStatuses.vue';
import Specialities from '@/pages/Specialities.vue';
import StudentGroups from '@/pages/StudentGroups.vue';
import StudyShifts from '@/pages/StudyShifts.vue';
import Langs from '@/pages/Langs.vue';
import StudyModules from '@/pages/StudyModules.vue';
import StudyResultedu from '@/pages/StudyResultedu.vue';
import StudyTopics from '@/pages/StudyTopics.vue';
import StudyTopicTypes from '@/pages/StudyTopicTypes.vue';
import JournalGrades from '@/pages/JournalGrades.vue';
import JournalTopics from '@/pages/JournalTopics.vue';
import StudyLoad from '@/pages/StudyLoad.vue';
import StudySchedule from '@/pages/StudySchedule.vue';

import Profile from '@/pages/Profile.vue';
import ProfileSettings from '@/pages/ProfileSettings.vue';
import Notifications from '@/pages/Notifications.vue';

import AdminUsers from '@/pages/admin/Users.vue';
import AdminUserRoles from '@/pages/admin/UserRoles.vue';

/*import TargetsList from '@/pages/Targets/List.vue';
import TargetAdd from '@/pages/Targets/Add.vue';
import TargetEdit from '@/pages/Targets/Edit.vue';

import TasksList from '@/pages/Tasks/List.vue';
import TaskAdd from '@/pages/Tasks/Add.vue';
import TaskEdit from '@/pages/Tasks/Edit.vue';

import ProjectsList from '@/pages/Projects/List.vue';
import ProjectAdd from '@/pages/Projects/Add.vue';
import ProjectEdit from '@/pages/Projects/Edit.vue';

import TagsList from '@/pages/Tags/List.vue';
import TagAdd from '@/pages/Tags/Add.vue';
import TagEdit from '@/pages/Tags/Edit.vue';

import TasksTypesList from '@/pages/TasksTypes/List.vue';
import TasksTypeAdd from '@/pages/TasksTypes/Add.vue';
import TasksTypeEdit from '@/pages/TasksTypes/Edit.vue';

import DocumentTemplatesList from '@/pages/DocumentTemplates/List.vue';
import DocumentTemplateAdd from '@/pages/DocumentTemplates/Add.vue';
import DocumentTemplateEdit from '@/pages/DocumentTemplates/Edit.vue';

import TasksCustomFieldsList from '@/pages/TasksCustomFields/List.vue';
import TasksCustomFieldAdd from '@/pages/TasksCustomFields/Add.vue';
import TasksCustomFieldEdit from '@/pages/TasksCustomFields/Edit.vue';

import TasksPrioritiesList from '@/pages/TasksPriorities/List.vue';
import TasksPriorityAdd from '@/pages/TasksPriorities/Add.vue';
import TasksPriorityEdit from '@/pages/TasksPriorities/Edit.vue';

import TasksStatusesTypesList from '@/pages/TasksStatusesTypes/List.vue';
import TasksStatusesTypeAdd from '@/pages/TasksStatusesTypes/Add.vue';
import TasksStatusesTypeEdit from '@/pages/TasksStatusesTypes/Edit.vue';

import TasksStatusesList from '@/pages/TasksStatuses/List.vue';
import TasksStatusAdd from '@/pages/TasksStatuses/Add.vue';
import TasksStatusEdit from '@/pages/TasksStatuses/Edit.vue';*/

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
					requiresAuth: true,
				},
			},
			
			{
				path: '/profile',
				component: Profile,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/profile/settings',
				component: ProfileSettings,
				meta: {
					requiresAuth: true,
				},
			},
			
			{
				path: '/notifications',
				component: Notifications,
				meta: {
					requiresAuth: true,
				},
			},
			
			{
				path: '/study-modules',
				component: StudyModules,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/study-resultedu',
				component: StudyResultedu,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/study-topics',
				component: StudyTopics,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/study-topic-types',
				component: StudyTopicTypes,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/journal-grades',
				component: JournalGrades,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/journal-topics',
				component: JournalTopics,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/study-load',
				component: StudyLoad,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/study-schedule',
				component: StudySchedule,
				meta: {
					requiresAuth: true,
				},
			},
			
			{
				path: '/admin/users',
				component: AdminUsers,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/admin/user-roles',
				component: AdminUserRoles,
				meta: {
					requiresAuth: true,
				},
			},
			
			{
				path: '/auditories',
				component: Auditories,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/auditories-load',
				component: AuditoriesLoad,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/call-schedule',
				component: CallSchedule,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/journal-student-statuses',
				component: JournalStudentStatuses,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/specialities',
				component: Specialities,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/student-groups',
				component: StudentGroups,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/study-shifts',
				component: StudyShifts,
				meta: {
					requiresAuth: true,
				},
			},
			{
				path: '/langs',
				component: Langs,
				meta: {
					requiresAuth: true,
				},
			},
			
			/*{
				path: '/targets',
				component: TargetsList,
			},
			{
				path: '/targets/add',
				component: TargetAdd,
			},
			{
				path: '/targets/:id',
				component: TargetEdit,
			},
			{
				path: '/tasks',
				component: TasksList,
			},
			{
				path: '/tasks/add',
				component: TaskAdd,
			},
			{
				path: '/tasks/:id',
				component: TaskEdit,
			},
			{
				path: '/projects',
				component: ProjectsList,
			},
			{
				path: '/projects/add',
				component: ProjectAdd,
			},
			{
				path: '/projects/:id',
				component: ProjectEdit,
			},
			{
				path: '/tags',
				component: TagsList,
			},
			{
				path: '/tags/add',
				component: TagAdd,
			},
			{
				path: '/tags/:id',
				component: TagEdit,
			},
			{
				path: '/tasks-types',
				component: TasksTypesList,
			},
			{
				path: '/tasks-types/add',
				component: TasksTypeAdd,
			},
			{
				path: '/tasks-types/:id',
				component: TasksTypeEdit,
			},
			{
				path: '/document-templates',
				component: DocumentTemplatesList,
			},
			{
				path: '/document-templates/add',
				component: DocumentTemplateAdd,
			},
			{
				path: '/document-templates/:id',
				component: DocumentTemplateEdit,
			},
			{
				path: '/tasks-custom-fields',
				component: TasksCustomFieldsList,
			},
			{
				path: '/tasks-custom-fields/add',
				component: TasksCustomFieldAdd,
			},
			{
				path: '/tasks-custom-fields/:id',
				component: TasksCustomFieldEdit,
			},
			{
				path: '/tasks-priorities',
				component: TasksPrioritiesList,
			},
			{
				path: '/tasks-priorities/add',
				component: TasksPriorityAdd,
			},
			{
				path: '/tasks-priorities/:id',
				component: TasksPriorityEdit,
			},
			{
				path: '/tasks-statuses-types',
				component: TasksStatusesTypesList,
			},
			{
				path: '/tasks-statuses-types/add',
				component: TasksStatusesTypeAdd,
			},
			{
				path: '/tasks-statuses-types/:id',
				component: TasksStatusesTypeEdit,
			},
			{
				path: '/tasks-statuses',
				component: TasksStatusesList,
			},
			{
				path: '/tasks-statuses/add',
				component: TasksStatusAdd,
			},
			{
				path: '/tasks-statuses/:id',
				component: TasksStatusEdit,
			},*/
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
		path: '/recovery-password',
		component: RecoveryPassword,
		meta: {
			guest: true,
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
				//let user = lib.localStorageGet('user')||{};
				/*if(to.matched.some(record => record.meta.is_admin)){
					if(user.is_admin){
						next()
					} else {
						next('/')
					}
				} else {
					next()
				}*/
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
import { createI18n } from 'vue-i18n';
import kz from '@/locales/kz.json';
import ru from '@/locales/ru.json';
import en from '@/locales/en.json';
//import axios from 'axios';

import AuthModel from '@/models/AuthModel.js';
import NoticeModel from '@/models/NoticeModel.js';

export default class AppModel
{
	/**
	 * Конструктор
	 */
	constructor()
	{
		this.selected_role = 'student';
		this.navbarMenu = [];
		
		this.langs = ['kz', 'ru', 'en'];
		this.langsName = {
			kz: 'Қазақша',
			ru: 'Русский',
			en: 'English',
		};
		this.title = '';
		this.i18n = createI18n({
			locale: 'ru',
			messages: { kz, ru, en },
		});
		
		this.auth = new AuthModel();
		this.notice = new NoticeModel();
	}
	
	/**
	 * Set page title
	 */
	setPageTitle(title)
	{
		this.title = title;
		document.title = title;
	}
	
	/**
	 * Set app lang
	 */
	setLang(lang = 'ru')
	{
		this.i18n.global.locale = lang;
		//axios.defaults.headers.common['Accept-Language'] = lang;
		document.querySelector('html').setAttribute('lang', lang);
		return lang;
	}
	
	/**
	 * Returns lang
	 */
	getLang()
	{
		//return this.i18n.locale;
		return this.i18n.global.locale;
	}
	
	pageReload()
	{
		document.location.reload();
	}
	
	setSelectedRole(role_api_name)
	{
		this.selected_role = role_api_name;
		this.loadNavbarMenu(role_api_name);
	}
	
	loadNavbarMenu(role_api_name = '')
	{
		switch(role_api_name){
			case 'admin':
				this.navbarMenu = [
					{
						type: 'item',
						icon: 'uil-file-alt',
						text: 'Базы',
						path: '#',
						badgeText: '',
						badgeClass: '',
						childs: [
							{
								type: 'item',
								path: '/auditories',
								text: 'Аудитории',
								childs: [],
							},
							{
								type: 'item',
								path: '/auditories-load',
								text: 'Занятость аудиторий',
								childs: [],
							},
							{
								type: 'item',
								path: '/call-schedule',
								text: 'Расписание звонков',
								childs: [],
							},
							{
								type: 'item',
								path: '/journal-student-statuses',
								text: 'Статусы студентов',
								childs: [],
							},
							{
								type: 'item',
								path: '/specialities',
								text: 'Специальности',
								childs: [],
							},
							{
								type: 'item',
								path: '/student-groups',
								text: 'Группы студентов',
								childs: [],
							},
							{
								type: 'item',
								path: '/study-shifts',
								text: 'Смены занятий',
								childs: [],
							},
							{
								type: 'item',
								path: '/langs',
								text: 'Языки',
								childs: [],
							},
						],
					},
					{
						type: 'item',
						icon: 'uil-file-alt',
						text: 'Рабочие Планы',
						path: '#',
						badgeText: '',
						badgeClass: '',
						childs: [
							{
								type: 'item',
								path: '/study-modules',
								text: 'Список учебн. модулей',
								childs: [],
							},
							{
								type: 'item',
								path: '/study-resultedu',
								text: 'Список РО',
								childs: [],
							},
							{
								type: 'item',
								path: '/study-topics',
								text: 'Темы РО',
								childs: [],
							},
							{
								type: 'item',
								path: '/study-topic-types',
								text: 'Типы тем РО',
								childs: [],
							},
						],
					},
					{
						type: 'item',
						icon: 'uil-file-alt',
						text: 'Препод',
						path: '#',
						badgeText: '',
						badgeClass: '',
						childs: [
							{
								type: 'item',
								path: '/journal-grades',
								text: 'Журнал оценок студ.',
								childs: [],
							},
							{
								type: 'item',
								path: '/journal-topics',
								text: 'Журнал тем и пройд. ч.',
								childs: [],
							},
						],
					},
					{
						type: 'item',
						icon: 'uil-file-alt',
						text: 'Расписание',
						path: '#',
						badgeText: '',
						badgeClass: '',
						childs: [
							{
								type: 'item',
								path: '/study-load',
								text: 'Учебная нагрузка',
								childs: [],
							},
							{
								type: 'item',
								path: '/study-schedule',
								text: 'Расписание занятий',
								childs: [],
							},
						],
					},
					{
						type: 'item',
						icon: 'uil-file-alt',
						text: 'Админ',
						path: '#',
						badgeText: '',
						badgeClass: '',
						childs: [
							{
								type: 'item',
								path: '/admin/users',
								text: 'Пользователи',
								childs: [],
							},
							{
								type: 'item',
								path: '/admin/user-roles',
								text: 'Роли пользователей',
								childs: [],
							},
						],
					},
				];
				break;
			default:
				this.navbarMenu = [];
				break;
		}
		
		/*this.navbarMenu3 = [
			{
				type: 'title',
				text: 'Menu',
			},
			{
				type: 'item',
				icon: 'uil-home-alt',
				text: 'Dashboard',
				path: '/',
				badgeText: '01',
				badgeClass: 'rounded-pill bg-primary',
				childs: [],
			},
			{
				type: 'item',
				icon: 'uil-window-section',
				text: 'Layouts',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Vertical',
						path: '#',
						childs: [
							{
								type: 'item',
								text: 'Dark Sidebar',
								path: '/',
							},
							{
								type: 'item',
								text: 'Compact Sidebar',
								path: '/',
							},
							{
								type: 'item',
								text: 'Icon Sidebar',
								path: '/',
							},
							{
								type: 'item',
								text: 'Boxed Width',
								path: '/',
							},
							{
								type: 'item',
								text: 'Preloader',
								path: '/',
							},
							{
								type: 'item',
								text: 'Colored Sidebar',
								path: '/',
							},
						],
					},
					{
						type: 'item',
						text: 'Horizontal',
						path: '#',
						childs: [
							{
								type: 'item',
								text: 'Horizontal',
								path: '/',
							},
							{
								type: 'item',
								text: 'Topbar Dark',
								path: '/',
							},
							{
								type: 'item',
								text: 'Boxed Width',
								path: '/',
							},
							{
								type: 'item',
								text: 'Preloader',
								path: '/',
							},
						],
					},
				],
			},
			{
				type: 'title',
				text: 'Apps',
			},
			{
				type: 'item',
				icon: 'uil-calender',
				text: 'Calendar',
				path: '/',
				badgeText: '',
				badgeClass: '',
				childs: [],
			},
			{
				type: 'item',
				icon: 'uil-comments-alt',
				text: 'Chat',
				path: '/',
				badgeText: '',
				badgeClass: '',
				childs: [],
			},
			{
				type: 'item',
				icon: 'uil-comments-alt',
				text: 'File Manager',
				path: '/',
				badgeText: '',
				badgeClass: '',
				childs: [],
			},
			{
				type: 'item',
				icon: 'uil-store',
				text: 'Ecommerce',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Products',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Product Detail',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Orders',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Customers',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Cart',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Checkout',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Shops',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Add Product',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-envelope',
				text: 'Email',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Inbox',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Read Email',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-invoice',
				text: 'Invoices',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Invoice List',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Invoice Detail',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-book-alt',
				text: 'Contacts',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'User Grid',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'User List',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Profile',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'title',
				text: 'Pages',
			},
			{
				type: 'item',
				icon: 'uil-user-circle',
				text: 'Authentication',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Login',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Register',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Recover Password',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Lock Screen',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-file-alt',
				text: 'Utility',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Starter Page',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Maintenance',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Coming Soon',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Timeline',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'FAQs',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Pricing',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Error 404',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Error 500',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'title',
				text: 'Components',
			},
			{
				type: 'item',
				icon: 'uil-flask',
				text: 'UI Elements',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Alerts',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Buttons',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Cards',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Carousel',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Dropdowns',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Grid',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Images',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Lightbox',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Modals',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Offcanvas',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Range Slider',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Session Timeout',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Progress Bars',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Placeholders',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Sweet-Alert',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Tabs & Accordions',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Typography',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Utilities',
						path: '/',
						badgeText: 'New',
						badgeClass: 'rounded-pill bg-success',
						childs: [],
					},
					{
						type: 'item',
						text: 'Toasts',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Video',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'General',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Colors',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Rating',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Notifications',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-shutter-alt',
				text: 'Forms',
				path: '#',
				badgeText: '9',
				badgeClass: 'rounded-pill bg-info',
				childs: [
					{
						type: 'item',
						text: 'Basic Elements',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Validation',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Advanced Plugins',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Editors',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'File Upload',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Xeditable',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Repeater',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Wizard',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Mask',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-list-ul',
				text: 'Tables',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Bootstrap Basic',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Datatables',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Responsive',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Editable',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-chart',
				text: 'Charts',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Apex',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Chartjs',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Flot',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Jquery Knob',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Sparkline',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-streering',
				text: 'Icons',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Unicons',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Boxicons',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Material Design',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Dripicons',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Font Awesome',
						path: '/',
						childs: [],
					},
				],
			},
			{
				type: 'item',
				icon: 'uil-location-point',
				text: 'Maps',
				path: '#',
				badgeText: '',
				badgeClass: '',
				childs: [
					{
						type: 'item',
						text: 'Google',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Vector',
						path: '/',
						childs: [],
					},
					{
						type: 'item',
						text: 'Leaflet',
						path: '/',
						childs: [],
					},
				],
			},
		];*/
	}
}

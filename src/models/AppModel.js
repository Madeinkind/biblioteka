import { createI18n } from 'vue-i18n';
import kz from '@/locales/kz.json';
import ru from '@/locales/ru.json';
import en from '@/locales/en.json';
//import axios from 'axios';

import AuthModel from '@/models/AuthModel.js';

export default class AppModel
{
	/**
	 * Конструктор
	 */
	constructor()
	{
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
}

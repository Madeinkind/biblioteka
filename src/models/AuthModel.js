import axios from 'axios';
import lib from '@/lib';

export default class AuthModel
{
	/**
	 * Конструктор
	 */
	constructor()
	{
		/* Инициализация */
		this.authChecked = false;
		//this.token = lib.localStorageGet('token')||'';
		this.token = lib.getCookie('krasp_jwt')||'';
		
		this.userProfile = null;
		this.userSettings = null;
		this.userRoles = [];
	}
	
	/**
	 * Делает авторизацию
	 * Возвращает true если правильный логин и пароль.
	 * Также устанавливает авторизационную куку.
	 */
	async doLogin(username, password)
	{
		return await fetch('/api/auth/login', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				username,
				password,
			}),
			headers: {
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			if(data.error && data.error != ''){
				console.log(data.error||'');
				//lib.localStorageRemove('token');
				//delete axios.defaults.headers.common['Authorization'];
				this.authChecked = false;
				return false;
			}
			let token = data.token;
			//user.accessToken = token;
			//lib.localStorageSet('token', token);
			//axios.defaults.headers.common['Authorization'] = token;
			this.setUserProfile(data.user_data);
			this.setUserSettings(data.user_data);
			storeInstance.state.app.setLang(this.userSettings.lang||'ru');
			this.userRoles = data.user_roles||[];
			if(this.userRoles.length > 0){
				storeInstance.state.app.setSelectedRole(this.userRoles[0].api_name);
			}
			this.authChecked = true;
			return true;
		}).catch(error => {
			console.log(error);
			//lib.localStorageRemove('token');
			//delete axios.defaults.headers.common['Authorization'];
			storeInstance.state.app.setSelectedRole('');
			this.authChecked = false;
			return false;
		});
	}
	
	/**
	 * Делает выход
	 */
	async doLogout()
	{
		return await fetch('/api/auth/logout').then(stream => stream.json()).then(data => {
			this.userProfile = null;
			this.userSettings = null;
			this.userRoles = [];
			//lib.localStorageRemove('token');
			//delete axios.defaults.headers.common['Authorization'];
			storeInstance.state.app.setSelectedRole('');
			this.authChecked = false;
			return true;
		}).catch(error => {
			console.log(error);
			//lib.localStorageRemove('token');
			//delete axios.defaults.headers.common['Authorization'];
			storeInstance.state.app.setSelectedRole('');
			this.authChecked = false;
			return false;
		});
	}
	
	/**
	 * Делает проверку на авторизованность
	 */
	async doCheckAuth()
	{
		if(!this.authChecked){
			return await fetch('/api/auth/checkauth').then(stream => stream.json()).then(data => {
				//console.log(data);
				//console.log('auth check done');
				
				if(!data.auth){
					// session expired or not exists. logout
					this.userProfile = null;
					this.userSettings = null;
					this.userRoles = [];
					//lib.localStorageRemove('token');
					storeInstance.state.app.setSelectedRole('');
					this.authChecked = false;
					return true;
				}
				
				//let token = data.jwt_string;
				//user.accessToken = token;
				//lib.localStorageSet('token', token);
				//axios.defaults.headers.common['Authorization'] = token;
				this.setUserProfile(data.user_data);
				this.setUserSettings(data.user_data);
				storeInstance.state.app.setLang(this.userSettings.lang||'ru');
				this.userRoles = data.user_roles||[];
				if(this.userRoles.length > 0){
					storeInstance.state.app.setSelectedRole(this.userRoles[0].api_name);
				}
				this.authChecked = true;
				return true;
			}).catch(error => {
				console.log(error);
				this.userProfile = null;
				this.userSettings = null;
				this.userRoles = [];
				//lib.localStorageRemove('token');
				//delete axios.defaults.headers.common['Authorization'];
				storeInstance.state.app.setSelectedRole('');
				this.authChecked = false;
				return false;
			});
		} else {
			return true;
		}
	}
	
	/*
	* Запросы к api
	*/
	
	/**
	 * Восстановление пароля через api 
	 * step 1
	 */
	async doRecoveryPasswordStep1(params)
	{
		let response = await lib.ioCallAction({
			entity: 'com.sso.api.user.recoveryPasswordStep1', 
			params: {
				user_data: params.user_data || '',
				captcha: params.captcha || '',
				captcha_type: params.captcha_type || '',
			},
		})
		return response;
	}
	
	/**
	 * Восстановление пароля через api 
	 * step 2
	 */
	async doRecoveryPasswordStep2(params)
	{
		let response = await lib.ioCallAction({
			entity: 'com.sso.api.user.recoveryPasswordStep2', 
			params: {
				user_data: params['email'],
				code: params['code'],
				pass1: params['pass1'],
				pass2: params['pass2'],
			},
		})
		
		return response;
	}
	
	/**
	 * Сохранение данных профиля пользователя через api
	 */
	async doSaveProfileData()
	{
		return await fetch('/api/user/save-profile-data', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				sname: this.userProfile.sname,
				fname: this.userProfile.fname,
				lname: this.userProfile.lname,
				tel: this.userProfile.tel,
				gender: this.userProfile.gender,
				iin: this.userProfile.iin,
			}),
			headers: {
				Authorization: 'Bearer '+this.token,
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			return data;
		}).catch(error => {
			//console.log(error);
			return {
				success: false,
				error,
			};
		});
	}
	
	/**
	 * Сохранение социальных данных пользователя через api
	 */
	async doSaveSocialData()
	{
		return await fetch('/api/user/save-social-data', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				about: this.userProfile.about,
			}),
			headers: {
				Authorization: 'Bearer '+this.token,
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			return data;
		}).catch(error => {
			//console.log(error);
			return {
				success: false,
				error,
			};
		});
	}
	
	/**
	 * Сохранение настроек интерфейса пользователя через api
	 */
	async doChangeEmail(email)
	{
		return await fetch('/api/user/change-email', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				email,
			}),
			headers: {
				Authorization: 'Bearer '+this.token,
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			return data;
		}).catch(error => {
			//console.log(error);
			return {
				success: false,
				error,
			};
		});
	}
	
	/**
	 * Сохранение настроек интерфейса пользователя через api
	 */
	async doChangePassword(password1, password2)
	{
		return await fetch('/api/user/change-password', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				password1: password1,
				password2: password2,
			}),
			headers: {
				Authorization: 'Bearer '+this.token,
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			return data;
		}).catch(error => {
			//console.log(error);
			return {
				success: false,
				error,
			};
		});
	}
	
	/**
	 * Сохранение настроек интерфейса пользователя через api
	 */
	async doSaveInterfaceSettings()
	{
		return await fetch('/api/user/save-interface-settings', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				lang: this.userSettings.lang,
				theme: this.userSettings.theme,
			}),
			headers: {
				Authorization: 'Bearer '+this.token,
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			return data;
		}).catch(error => {
			//console.log(error);
			return {
				success: false,
				error,
			};
		});
	}
	
	isAuth()
	{
		return this.userProfile != null;
	}
	
	getSname()
	{
		return this.userProfile != null ? this.userProfile.sname : '';
	}
	
	getFname()
	{
		return this.userProfile != null ? this.userProfile.fname : '';
	}
	
	getLogin()
	{
		return this.userProfile != null ? this.userProfile.login : '';
	}
	
	getUserId()
	{
		return this.userProfile != null ? this.userProfile.user_id : '';
	}
	
	getAvatarLink()
	{
		return this.userProfile != null ? this.userProfile.ava : '';
	}
	
	hasRole(role_api_name)
	{
		return !!this.userRoles.find(({api_name}) => api_name == role_api_name);
	}
	
	/**
	 * Устанавливает user profile
	 */
	setUserProfile(res)
	{
		if(res == null){
			this.userProfile = null;
		} else {
			this.userProfile = {
				user_id: res.id,
				login: res.login,
				sname: res.sname,
				fname: res.fname,
				lname: res.lname,
				gender: res.gender,
				email: res.email,
				tel: res.tel,
				about: res.about,
				iin: res.iin,
				ava: res.avatar,
			};
		}
	}
	
	/**
	 * Устанавливает user settings
	 */
	setUserSettings(res)
	{
		if(res == null){
			this.userSettings = null;
		} else {
			this.userSettings = {
				theme: res.theme,
				lang: res.lang_code.toLowerCase(),
			};
		}
	}
}

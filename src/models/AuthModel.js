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
		this.token = lib.getCookie('biblioteka_jwt')||null;
	}
	
	/**
	 * Делает авторизацию
	 * Возвращает true если правильный логин и пароль.
	 * Также устанавливает авторизационную куку.
	 */
	async doLogin(login, password)
	{
		return await fetch('/api/auth/login', {
			mode: 'cors',
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'include', // include, *same-origin, omit
			method: 'POST',
			body: JSON.stringify({
				login,
				password,
			}),
			headers: {
				'Content-Type': 'application/json',
			},
		}).then(stream => stream.json()).then(data => {
			//console.log(data);
			
			if(data.error && data.error != ''){
				console.log(data.error||'');
				this.token = null;
				this.authChecked = false;
				return false;
			}
			this.token = data.token;
			this.authChecked = true;
			return true;
		}).catch(error => {
			console.log(error);
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
			this.token = null;
			this.authChecked = false;
			return true;
		}).catch(error => {
			console.log(error);
			this.token = null;
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
					this.token = null;
					this.authChecked = false;
					return true;
				}
				
				this.token = data.token;
				this.authChecked = true;
				return true;
			}).catch(error => {
				console.log(error);
				this.token = null;
				this.authChecked = false;
				return false;
			});
		} else {
			return true;
		}
	}
	
	isAuth()
	{
		return this.token != null;
	}
}

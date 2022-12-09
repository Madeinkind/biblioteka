import axios from "axios";
import io7_mixin from "./mixin.js";

const lib = {
	is_frame: false,
	
	mixins: [
		io7_mixin,
	],

	/**
	 * Create store from model
	 */
	createStoreFromModel(class_name)
	{
		let state = new class_name()
		
		const getters = {};
		const actions = {};
		const mutations = {};
		
		return {
			namespaced: true,
			state,
			getters,
			actions,
			mutations,
		};
	},
	
	/**
	 * Add mixin
	 */
	addMixin(mixin)
	{
		this.mixins.push(mixin);
	},
	
	/**
	 * Check is exists
	 */
	isExists(value)
	{
		return value != null && value != undefined;
	},
	
	/**
	 * Получает cookie по названию
	 */
	getCookie(name)
	{
		var matches = document.cookie.match(
			new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\/\+^])/g, "\$1") + "=([^;]*)"	)
		);
		return matches ? decodeURIComponent(matches[1]) : null; 
	},
	
	/**
	 * Устанавливает cookie
	 */
	setCookie(name, value, expires, path, domain, secure)
	{
		//console.log("setCookie " + name);
		if(expires == undefined) expires = 7 * 24 * 60 * 60;
		if(path == undefined) path = "/";
		var cookie_string = name+'='+escape(value);
		//if(expires) cookie_string += '; expires='+expires.toUTCString();
		if(path) cookie_string += '; path='+escape(path);
		if(domain) cookie_string += '; domain='+escape(domain);
		if(secure) cookie_string += '; secure';
		document.cookie = cookie_string;
	},

	/**
	 * Удаляет куки
	 */
	deleteCookie(name)
	{
		this.setCookie(name, '', 0);
	},
	
	/**
	 * Парсит JWT токен на основе строки
	 */
	parseJwt(token)
	{
		let base64Url = token.split(".")[1];
		let base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
		
		//console.log("token", token);
		//console.log("base64", base64);
		
		try
		{
			if(typeof atob != "undefined") base64 = atob(base64);
			else base64 = (Buffer.from(base64, 'base64').toString());
			
			//console.log("atob(base64)", base64);
			
			let jsonPayload = decodeURIComponent(
				base64
				.split("")
				.map(function (c) {
					return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
				})
				.join("")
			);
			
			//console.log("jsonPayload", jsonPayload);
			
			return JSON.parse(jsonPayload);
		}
		catch (e)
		{
			
		}
		
		return null;
	},
	
	nl2br(str)
	{
		return str.replace(/([^>])\n/g, '$1<br/>');
	},
	
	urlGetAddArr(url, arr, force)
	{
		var url = new String(url);
		var pos = url.indexOf('#');
		if((typeof force) == 'undefined') force = 1;
		if(pos != -1){
			url = url.substring(0, pos);
		}

		for(var param in arr){
			var value = encodeURIComponent(arr[param]);
			var val = new RegExp('(\\?|\\&)'+param+'=.*?(?=(&|$))'), qstring = /\?.+$/;
			param = encodeURIComponent(param);
			if(val.test(url)){
				if(force == 1){
					if(value != ''){
						url = url.replace(val, '$1'+param+'='+value);
					} else {
						url = url.replace(val, '$1');
					}
				}
			} else if(qstring.test(url)){
				if(value != ''){
					url += '&'+param+'='+value;
				} else {
					url = url;
				}
			} else {
				if(value != ''){
					url += '?'+param+'='+value;
				} else {
					url = url;
				}
			}
		}
		return url;
	},
	
	urlGetAdd(url)
	{
		var arr = {};
		var param, value, j = 0;
		for(var i = 1; i < arguments.length; i++){
			if(j == 0){
				param = arguments[i];
			} else {
				value = arguments[i];
				arr[param] = value;
				j = -1;
			}
			j++;
		}
		return this.urlGetAddArr(url, arr, 1);
	},
	
	urlGetAdd2(url)
	{
		var arr = {};
		var param, value, j = 0;
		for(var i = 1; i < arguments.length; i++){
			if(j == 0){
				param = arguments[i];
			} else {
				value = arguments[i];
				if((typeof arr[param]) == 'undefined'){
					arr[param] = value;
				}
				j = -1;
			}
			j++;
		}
		return this.urlGetAddArr(url, arr, 0);
	},
	
	urlGetNormal(url)
	{
		var url = new String(url);
		var s1 = new RegExp("\\&+", "g");
		var s2 = new RegExp("\\?\\&+", "g");
		var s3 = new RegExp("\\&$", "g");
		url = url.replace(s1, '&');
		url = url.replace(s2, '?');
		url = url.replace(s3, '');
		return url;
	},
	
	isUrl(s)
	{
		var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		return regexp.test(s);
	},
	
	/**
	 * Добавляет value в FormData
	 */
	appendFormData(form, value, key)
	{
		if (key == undefined)
		{
			key = "";
		}
		if (typeof value === 'object')
		{
			for (let i in value)
			{
				let v = value[i];
				if (key == '')
				{
					this.appendFormData(form, v, i);
				}
				else
				{
					this.appendFormData(form, v, key + '[' + i + ']');
				}
			}
		}
		else
		{
			form.append(key, value);
		}
	},
	
	/**
	 * Вызывает API
	 */
	ioCallAction: async function(arr)
	{
		var arr = arr || {};
		var entity = arr.entity || null;
		var resultType = arr.resultType || 'json';
		var resultNoParams = arr.resultNoParams || 0;
		var log_echo = arr.log_echo || 1;
		var params = arr.params || {};
		var form = arr.form || new FormData();
		
		this.appendFormData(form, {
			"entitypost": params,
		});
		
		if (entity == null)
		{
			return {
				"error_code": -1,
				"error_str": "Entity is null",
			};
		}
		
		/* Build url */
		var url = '/entity/' + entity + '/';
		url = this.urlGetAdd(url, 'resultType', resultType);
		url = this.urlGetAdd(url, 'resultNoParams', resultNoParams);
		if ((typeof app_settings["current_account"]) != 'undefined')
		{
			url = this.urlGetAdd(url, 'account', app_settings["current_account"]);
		}
		/* Send post */
		let response = await axios
			.post(
				url,
				form,
				{
					withCredentials: true,
					credentials: "include",
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				},
			);
		if (!response)
		{
			return {
				"error_code": -1,
				"error_str": "Response is null",
			};
		}
		//console.log('lib response', response)
		
		if (typeof(response.data) != "object")
		{
			return {
				"error_code": -1,
				"error_str": "Response data is not object",
			};
		}
		
		if (typeof(response.data.res) != "object")
		{
			return {
				"error_code": -1,
				"error_str": "Result is null",
			};
		}
		
		if (log_echo && response.data.content != "")
		{
			console.log( response.data.content );
		}
		
		return response.data.res;
	},
	
	/**
	 * Создает blob файл из base64 string
	 */
	createBlobFromBase64: function (b64Data, contentType = '', sliceSize = 512)
	{
		const byteCharacters = atob(b64Data);
		const byteArrays = [];
		for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
			const slice = byteCharacters.slice(offset, offset + sliceSize);
			const byteNumbers = new Array(slice.length);
			for (let i = 0; i < slice.length; i++) {
			byteNumbers[i] = slice.charCodeAt(i);
			}
			const byteArray = new Uint8Array(byteNumbers);
			byteArrays.push(byteArray);
		}
		const blob = new Blob(byteArrays, {type: contentType});
		return blob;
	},
	
	/* my */
	
	microtime(get_as_float){
		// discuss at: http://phpjs.org/functions/microtime/
		// original by: Paulo Freitas
		// example 1: timeStamp = microtime(true);
		// example 1: timeStamp > 1000000000 && timeStamp < 2000000000
		// returns 1: true
		let now = new Date().getTime() / 1000;
		let s = parseInt(now, 10);
		return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
	},
	
	mt_rand(min, max){
		return Math.floor(Math.random() * (max - min) + min);
	},
	
	genId(){
		return Math.floor(microtime(1) * 10000)+''+mt_rand(10, 99);
	},
	
	/**
	 * Склонение слов (метод 1)
	 */
	decl1(intval, expr){
		if(intval == null || typeof(intval) == 'undefined') intval = 1;
		if(expr == null || typeof(expr) == 'undefined') expr = ['день', 'дня', 'дней'];
		
		intval = parseInt(intval);
		let count = intval % 100;
		let result = '';
		if(count >= 5 && count <= 20){
			result = expr[2];
		} else {
			count = count % 10;
			if(count == 1){
				result = expr[0];
			} else if(count >= 2 && count <= 4){
				result = expr[1];
			} else {
				result = expr[2];
			}
		}
		return result;
	},
	
	/**
	 * Склонение слов (метод 2)
	 */
	decl2(intval, expr){
		if(intval == null || typeof(intval) == 'undefined') intval = 1;
		if(expr == null || typeof(expr) == 'undefined') expr = ['день', 'дня', 'дней'];
		
		let k = intval % 10 == 1 && intval % 100 != 11 ? 0 : (intval % 10 >= 2 && intval % 10 <= 4 && (intval % 100 < 10 || intval % 100 >= 20) ? 1 : 2);
		return expr[k];
	},
	
	/**
	 * ex: alert(dateDiff('2013-01-10 00:10', '2013-01-11 00:09'));
	 * ex: alert(dateDiff('2013-04-10', '2013-10-20'));
	 * date1 - ot, date2 - do
	 */
	dateDiff(date1, date2){
		date1 = new Date(date1);
		date2 = new Date(date2);
		
		let milliseconds = date2.getMilliseconds() - date1.getMilliseconds();
		
		if(milliseconds < 0){
			milliseconds += 1000;
			date2.setSeconds(date2.getSeconds() - 1);
		}
		
		let seconds = date2.getSeconds() - date1.getSeconds();
		
		if(seconds < 0){
			seconds += 60;
			date2.setMinutes(date2.getMinutes() - 1);
		}
		
		let minutes = date2.getMinutes() - date1.getMinutes();
		
		if(minutes < 0){
			minutes += 60;
			date2.setHours(date2.getHours() - 1);
		}
		
		let hours = date2.getHours() - date1.getHours();
		
		if(hours < 0){
			hours += 24;
			date2.setDate(date2.getDate() - 1);
		}
		
		let days = date2.getDate() - date1.getDate();
		
		if(days < 0){
			days += new Date(date2.getFullYear(), date2.getMonth() - 1, 0).getDate() + 1;
			date2.setMonth(date2.getMonth() - 1);
		}

		let months = date2.getMonth() - date1.getMonth();
		
		if(months < 0){
			months += 12;
			date2.setFullYear(date2.getFullYear() - 1);
		}
		
		let years = date2.getFullYear() - date1.getFullYear();
		
		return {
			years: years,
			months: months,
			days: days,
			hours: hours,
			minutes: minutes,
			seconds: seconds,
			milliseconds: milliseconds
		};
	},
	
	deleteCookieOld(name){
		setCookie(name, "", -1);
	},
	
	setCookieOld(name, value, days){
		let expires;
		if(days){
			let date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		}
		else expires = "";
		document.cookie = name + "=" + value + expires + "; path=/";
	},
	
	getCookieOld(name){
		let nameEQ = name + "=";
		let ca = document.cookie.split(';');
		for(let i = 0;i < ca.length; i++){
			let c = ca[i];
			while(c.charAt(0) == ' ') c = c.substring(1, c.length);
			if(c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	},
	
	localStorageSet(key, value, ttl = 60 * 60 * 24 * 1000){
		const now = new Date();

		// `item` is an object which contains the original value
		// as well as the time when it's supposed to expire
		const item = {
			value: value,
			expiry: now.getTime() + ttl,
		}
		localStorage.setItem(key, JSON.stringify(item));
	},
	
	localStorageGet(key){
		const itemStr = localStorage.getItem(key);

		// if the item doesn't exist, return null
		if(!itemStr){
			return null;
		}

		const item = JSON.parse(itemStr);
		const now = new Date();

		// compare the expiry time of the item with the current time
		if(now.getTime() > item.expiry){
			// If the item is expired, delete the item from storage
			// and return null
			localStorage.removeItem(key);
			return null;
		}
		return item.value;
	},
	
	localStorageRemove(key){
		localStorage.removeItem(key);
	},
};

export default lib;

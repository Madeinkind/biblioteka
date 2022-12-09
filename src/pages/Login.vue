<template>
	<div>
		<div class="account-pages d-flex align-items-center min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <router-link :to="{path: '/'}" class="my-5 d-block auth-logo">
                                <img src="/assets/images/logo-lg-colored.svg" alt="Krasp" height="50" class="logo logo-dark" />
                                <img src="/assets/images/logo-lg-white.svg" alt="Krasp" height="50" class="logo logo-light" />
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
									<h5 class="text-primary">Авторизация</h5>
								</div>
								<div class="p-2 mt-4">
									<form @submit.prevent="onLoginSubmit">
										<div class="mb-3">
											<label class="form-label" for="username">Логин, email, номер телефона</label>
											<input
												type="text"
												class="form-control"
												id="username"
												v-model="username"
												autofocus
											/>
										</div>
										<div class="mb-3">
											<div class="float-end">
												<router-link :to="{path: '/recovery-password'}" class="text-muted">Забыли пароль?</router-link>
											</div>
											<label class="form-label" for="userpassword">Пароль</label>
											<input
												type="password"
												class="form-control"
												id="userpassword"
												v-model="password"
											/>
										</div>
										<div class="mt-3 text-end">
											<button class="btn btn-primary w-sm waves-effect waves-light" type="submit" :disabled="btnLoginDisabled">{{$t('btn-login')}}</button>
										</div>
									</form>
									<div class="alert alert-warning mt-3 mb-0" v-if="error">{{error}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 text-center">
							<span v-for="(lang, i) in appModel.langs" :key="`lang-${i}`">
								<input type="radio" class="btn-check" autocomplete="off" v-model="$root.$i18n.locale" :id="'btnlang'+i" :value="lang" />
								<label class="btn btn-sm btn-light mx-1" :for="'btnlang'+i">{{appModel.langsName[lang]}}</label>
							</span>
						</div>
                        <div class="mt-2 text-center">
							<p>2022 © Krasp. Разработал <a href="https://bylex.info" target="_blank" class="text-reset">Алексей (lexinzector) Михалёв</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<style lang="css" scoped>

</style>

<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';

export default {
	name: 'Login',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Авторизация | Krasp'});
	},
	data: () => ({
		username: '',
		password: '',
		error: '',
		btnLoginDisabled: false,
	}),
	methods: {
		async onLoginSubmit(){
			this.btnLoginDisabled = true;
			this.error = '';
			
			let res = await this.authModel.doLogin(this.username, this.password);
			
			/* Если авторизация произошла успешно */
			this.btnLoginDisabled = false;
			if(res){
				this.$router.push('/');
			} else {
				/* Неверный логин или пароль */
				this.error = 'Неправильный логин или пароль.';
				console.log('Auth failed');
			}
		},
	},
	beforeMount(){
		window.scrollTo(0, 0);
		document.body.classList.add('authentication-bg');
	},
	beforeUnmount(){
		document.body.classList.remove('authentication-bg');
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		document.body.classList.add('authentication-bg');
	},
	computed: {},
	components: {
		
	},
};
</script>
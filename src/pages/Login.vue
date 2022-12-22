<template>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                  </span>
                  <router-link :to="{path: '/'}" class="app-brand-text demo menu-text fw-bolder ms-2">Главная</router-link>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Добро пожаловать! 👋</h4>
              <p class="mb-4">Пожалуйста, войдите в свою учетную запись</p>

              <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Электронная почта или имя пользователя</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email-username"
                    placeholder="Enter your email or username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Пароль</label>
                    <a href="auth-forgot-password-basic.html">
                      <small><router-link :to="{path: '/:pathMatch(.*)*'}">Забыли пароль</router-link></small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Запомните меня </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Войти</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->
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
		useMeta({title: 'Авторизация'});
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
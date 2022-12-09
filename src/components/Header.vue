<template>
	<header id="page-topbar">
		<div class="navbar-header">
			<div class="d-flex">
				<div class="navbar-brand-box">
					<a href="index.html" class="logo logo-dark">
						<span class="logo-sm">
							<img src="/assets/images/logo-sm.png" alt="" height="22" />
						</span>
						<span class="logo-lg">
							<img src="/assets/images/logo-dark.png" alt="" height="20" />
						</span>
					</a>
					<a href="index.html" class="logo logo-light">
						<span class="logo-sm">
							<img src="/assets/images/logo-sm.png" alt="" height="22" />
						</span>
						<span class="logo-lg">
							<img src="/assets/images/logo-light.png" alt="" height="20" />
						</span>
					</a>
				</div>
				<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn" @click="toggleVerticalMenu()">
					<i class="fa fa-fw fa-bars"></i>
				</button>
				<!--
				<form class="app-search d-none d-lg-block">
					<div class="position-relative">
						<input type="text" class="form-control" placeholder="Поиск..." />
						<span class="uil-search"></span>
					</div>
				</form>
				-->
			</div>
			<div class="d-flex">
				<!--
				<div class="dropdown d-inline-block d-lg-none ms-2">
					<button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="uil-search"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
						<form class="p-3">
							<div class="m-0">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Поиск ..." aria-label="Поиск" />
									<div class="input-group-append">
										<button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				-->
				<div class="dropdown d-inline-block" v-if="appModel.selected_role">
					<button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{getRoleByApiName(appModel.selected_role).name||''}}
					</button>
					<div class="dropdown-menu dropdown-menu-end">
						<a href="javascript://" @click="appModel.setSelectedRole(role.api_name); $router.push('/');" class="dropdown-item" :class="{'active': role.api_name == appModel.selected_role}" v-for="role in authModel.userRoles" :key="role.role_id">
							<i class="uil uil-bag font-size-18 align-middle me-1 text-muted"></i>
							<span class="align-middle">{{role.name}}</span>
						</a>
					</div>
				</div>
				<!--
				<div class="dropdown d-none d-lg-inline-block ms-1">
					<button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="uil-apps"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
						<div class="px-lg-2">
							<div class="row g-0">
								<div class="col">
									<a class="dropdown-icon-item" href="#">
										<img src="/assets/images/brands/github.png" alt="Github" />
										<span>GitHub</span>
									</a>
								</div>
								<div class="col">
									<a class="dropdown-icon-item" href="#">
										<img src="/assets/images/brands/bitbucket.png" alt="bitbucket" />
										<span>Bitbucket</span>
									</a>
								</div>
								<div class="col">
									<a class="dropdown-icon-item" href="#">
										<img src="/assets/images/brands/dribbble.png" alt="dribbble" />
										<span>Dribbble</span>
									</a>
								</div>
							</div>
							<div class="row g-0">
								<div class="col">
									<a class="dropdown-icon-item" href="#">
										<img src="/assets/images/brands/dropbox.png" alt="dropbox" />
										<span>Dropbox</span>
									</a>
								</div>
								<div class="col">
									<a class="dropdown-icon-item" href="#">
										<img src="/assets/images/brands/mail_chimp.png" alt="mail_chimp" />
										<span>Mail Chimp</span>
									</a>
								</div>
								<div class="col">
									<a class="dropdown-icon-item" href="#">
										<img src="/assets/images/brands/slack.png" alt="slack" />
										<span>Slack</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				-->
				<div class="dropdown d-inline-block">
					<button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="uil-bell"></i>
						<span class="badge bg-danger rounded-pill">4</span>
					</button>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
						<div class="p-3">
							<div class="row align-items-center">
								<div class="col">
									<h5 class="m-0 font-size-16">Уведомления</h5>
								</div>
								<div class="col-auto">
									<a href="#" class="small">Прочитано</a>
								</div>
							</div>
						</div>
						<div data-simplebar style="max-height: 230px;">
							<a href="javascript:void(0);" class="text-reset notification-item">
								<div class="d-flex align-items-start">
									<div class="flex-shrink-0 me-3">
										<div class="avatar-xs">
											<span class="avatar-title bg-primary rounded-circle font-size-16">
												<i class="uil-shopping-basket"></i>
											</span>
										</div>
									</div>
									<div class="flex-grow-1">
										<h6 class="mb-1">Ваш заказ размещен</h6>
										<div class="font-size-12 text-muted">
											<p class="mb-1">Если несколько языков объединяют грамматику</p>
											<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 минуты назад</p>
										</div>
									</div>
								</div>
							</a>
							<a href="javascript:void(0);" class="text-reset notification-item">
								<div class="d-flex align-items-start">
									<div class="flex-shrink-0 me-3">
										<img src="/assets/images/users/avatar-3.jpg" class="rounded-circle avatar-xs" alt="user-pic" />
									</div>
									<div class="flex-grow-1">
										<h6 class="mb-1">Иван Иванов</h6>
										<div class="font-size-12 text-muted">
											<p class="mb-1">Это будет выглядеть как упрощенный английский.</p>
											<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 час назад</p>
										</div>
									</div>
								</div>
							</a>
							<a href="javascript:void(0);" class="text-reset notification-item">
								<div class="d-flex align-items-start">
									<div class="flex-shrink-0 me-3">
										<div class="avatar-xs">
											<span class="avatar-title bg-success rounded-circle font-size-16">
												<i class="uil-truck"></i>
											</span>
										</div>
									</div>
									<div class="flex-grow-1">
										<h6 class="mb-1">Ваш заказ отправлен</h6>
										<div class="font-size-12 text-muted">
											<p class="mb-1">Если несколько языков объединяют грамматику</p>
											<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 минуты назад</p>
										</div>
									</div>
								</div>
							</a>
							<a href="javascript:void(0);" class="text-reset notification-item">
								<div class="d-flex align-items-start">
									<div class="flex-shrink-0 me-3">
										<img src="/assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="user-pic" />
									</div>
									<div class="flex-grow-1">
										<h6 class="mb-1">Селена Лэйфильд</h6>
										<div class="font-size-12 text-muted">
											<p class="mb-1">Как скептически настроенный кембриджский друг, мой западный.</p>
											<p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 час назад</p>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="p-2 border-top">
							<div class="d-grid">
								<router-link :to="{path: '/notifications'}" class="btn btn-sm btn-link font-size-14 text-center">
									<i class="uil-arrow-circle-right me-1"></i>
									<span>Все уведомления</span>
								</router-link>
							</div>
						</div>
					</div>
				</div>
				<div class="dropdown d-inline-block">
					<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img class="rounded-circle header-profile-user" :src="authModel.userProfile.ava||'/files/avatar/default.svg'" alt="Avatar" />
						<!--<span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{authModel.userProfile.login}}</span>-->
						<i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
					</button>
					<div class="dropdown-menu dropdown-menu-end">
						<router-link :to="{path: '/profile'}" class="dropdown-item">
							<i class="uil uil-user-circle font-size-18 align-middle me-1 text-muted"></i>
							<span class="align-middle">Профиль</span>
						</router-link>
						<router-link :to="{path: '/profile/settings'}" class="dropdown-item">
							<i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i>
							<span class="align-middle">Настройки</span>
						</router-link>
						<div class="dropdown-divider"></div>
						<router-link :to="{path: '/logout'}" class="dropdown-item">
							<i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
							<span class="align-middle">Выйти</span>
						</router-link>
					</div>
				</div>
				<div class="dropdown d-none d-lg-inline-block ms-1">
					<button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen" @click="toggleFullscreen()">
						<i class="uil-minus-path"></i>
					</button>
				</div>
				<div class="dropdown d-inline-block" v-if="authModel.hasRole('admin')">
					<button type="button" class="btn header-item right-bar-toggle noti-icon waves-effect" @click="toggleRightBar()">
						<i class="uil-cog"></i>
					</button>
				</div>
			</div>
		</div>
	</header>
</template>

<style lang="css" scoped>

</style>

<script>
import lib from '@/lib';

export default {
	name: 'Header',
	mixins: lib.mixins,
	props: {},
	data: () => ({
		
	}),
	methods: {
		getRoleByApiName(role_api_name){
			return this.authModel.userRoles.find(({api_name}) => api_name == role_api_name);
		},
		toggleRightBar(){
			document.body.classList.toggle('right-bar-enabled');
		},
		toggleFullscreen(){
			document.body.classList.toggle("fullscreen-enable");
			
			if(document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement){
				if(document.cancelFullScreen){
					document.cancelFullScreen();
				} else {
					if(document.mozCancelFullScreen){
						document.mozCancelFullScreen();
					} else {
						document.webkitCancelFullScreen && document.webkitCancelFullScreen();
					}
				}
			} else {
				if(document.documentElement.requestFullscreen){
					document.documentElement.requestFullscreen();
				} else {
					if(document.documentElement.mozRequestFullScreen){
						document.documentElement.mozRequestFullScreen();
					} else {
						document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
					}
				}
			};
		},
		toggleVerticalMenu(){
			document.body.classList.toggle("sidebar-enable");
			
			if(992 <= window.innerWidth){
				let a = document.body.getAttribute("data-sidebar-size");
				if(null == a){
					if(null == document.body.getAttribute("data-sidebar-size") || "lg" == document.body.getAttribute("data-sidebar-size")){
						document.body.setAttribute("data-sidebar-size", "sm");
					} else {
						document.body.setAttribute("data-sidebar-size", "lg");
					}
				} else {
					if("md" == a){
						if("md" == document.body.getAttribute("data-sidebar-size")){
							document.body.setAttribute("data-sidebar-size", "sm");
						} else {
							document.body.setAttribute("data-sidebar-size", "md");
						}
					} else {
						if("sm" == document.body.getAttribute("data-sidebar-size")){
							document.body.setAttribute("data-sidebar-size", "lg");
						} else {
							document.body.setAttribute("data-sidebar-size", "sm");
						}
					}
				}
			}
		},
	},
	computed: {},
}
</script>
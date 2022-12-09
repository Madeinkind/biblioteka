<template>
	<div>
		<div id="layout-wrapper">
			<header-block></header-block>
			<vertical-menu></vertical-menu>
			<div class="main-content">
				<div class="page-content">
					<div class="container-fluid">
						<router-view/>
					</div>
				</div>
				<footer-block></footer-block>
			</div>
		</div>
		<right-bar></right-bar>
	</div>
</template>

<style lang="css">

</style>

<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';
import HeaderBlock from '@/components/Header.vue';
import FooterBlock from '@/components/Footer.vue';
import RightBar from '@/components/RightBar.vue';
import VerticalMenu from '@/components/VerticalMenu.vue';

export default {
	name: 'LayoutMain',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Krasp'});
	},
	data: () => ({
		navbarMenu: [],
	}),
	methods: {
		load(){
			document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || (console.log("pressed"), document.body.classList.remove("fullscreen-enable"));
			
			let elements = document.getElementsByClassName("switch");
			for(let i = 0; i < elements.length; i++){
				elements[i].addEventListener('switch-change', function(){
					toggleWeather();
				});
			}
			
			if(1024 <= window.innerWidth && window.innerWidth <= 1366){
				document.body.setAttribute("data-sidebar-size", "sm");
				document.getElementById("sidebar-size-small").checked = true;
			}
			
			//document.getElementById("status").fadeOut();
			//document.getElementById("preloader").delay(350).fadeOut("slow");
		},
		t(){
			 document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || (console.log("pressed"), document.body.classList.remove("fullscreen-enable"));
		},
	},
	beforeMount(){
		window.scrollTo(0, 0);
		//this.loadNavbarMenu();
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		//this.loadNavbarMenu();
	},
	mounted(){
		this.load();
		this.t();
		
		document.addEventListener("fullscreenchange", this.t);
		document.addEventListener("webkitfullscreenchange", this.t);
		document.addEventListener("mozfullscreenchange", this.t);
		
		let elems = document.getElementsByClassName(".navbar-nav a");
		for(let i = 0; i < elems.length; i++){
            var t = window.location.href.split(/[?#]/)[0];
            elems[i].href == t && (elems[i].classList.add("active"),
			elems[i].parentElement.classList.add("active"),
			elems[i].parentElement.parentElement.classList.add("active"),
			elems[i].parentElement.parentElement.parentElement.classList.add("active"),
			elems[i].parentElement.parentElement.parentElement.parentElement.classList.add("active"),
			elems[i].parentElement.parentElement.parentElement.parentElement.parentElement.classList.add("active"));
        };
	},
	created(){
		this.$http.interceptors.response.use(undefined, function(err){
			return new Promise(function(resolve, reject){
				if(err.status === 401 && err.config && !err.config.__isRetryRequest){
					this.authModel.doLogout();
				}
				throw err;
			});
		});
	},
	computed: {},
	components: {
		HeaderBlock,
		FooterBlock,
		RightBar,
		VerticalMenu,
	},
}
</script>
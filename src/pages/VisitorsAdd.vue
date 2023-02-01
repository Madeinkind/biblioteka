<template>
	 <div class="container-xxl flex-grow-1 container-p-y">
		        <!-- Basic Breadcrumb -->
                  <!-- Custom style1 Breadcrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item">
                        <router-link :to="{path: '/'}" class="menu-link">Главная</router-link>
                      </li>
                      <li class="breadcrumb-item">
						<router-link :to="{path: '/visitors'}" class="menu-link">Добавление посетители</router-link>
                      </li>
                    </ol>
                  </nav>
              <h4 class="fw-bold py-3 mb-4">Добавление посетителя</h4>

			  <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-10">
                  <div class="card mb-4">
                    <!-- Account -->
					<form @submit.prevent="onVisitorAdd()">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label for="firstName" class="form-label">ФИО</label>
										<input id="visitor_fio" class="form-control" type="text"  v-model="visitor_fio" required>
									</div>
									<div class="mb-3">
										<label for="firstName" class="form-label">Группа</label>
										<input id="visitor_group" class="form-control" type="text" v-model="visitor_group" required>
									</div>
									<div class="mb-3">
										<label for="firstName" class="form-label">Дата посещения</label>
										<input id="visitor_date" class="form-control" type="date" required v-model="visitor_date">
									</div>
								</div>
							</div>
						</div>
						<hr class="my-0" />
						<div class="card-body">
							<div class="mt-2">
							<button type="submit" class="btn btn-primary me-2">Добавить</button>
								<router-link :to="{path: '/visitors'}" class="btn btn-outline-secondary">
									Назад
								</router-link>
								</div>
							</div>
						</form>

						<!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
	</div>
</template>

<style lang="css" scoped>

</style>



<script>
import lib from '@/lib';
import { useMeta } from 'vue-meta';

export default {
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Добавление посетителя | Biblioteka'});
	},
	data: () => ({
		visitor_fio: '',
		visitor_group: '',
		visitor_date:'',
	}),
	methods: {
		onVisitorAdd(){
			fetch('/api/visitors', {
				method: 'POST',
				body: JSON.stringify({
					fio: this.visitor_fio,
					group: this.visitor_group,
					date: this.visitor_date,
				}),
				headers: {
					Authorization: 'Bearer '+this.authModel.token,
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.$router.push('/visitors');
			}).catch(error => {
				console.log(error);
			});
		},
	},
	mounted(){
		
	},
	beforeMount(){
		window.scrollTo(0, 0);
		
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		
	},
	computed: {},
	components: {
		//Navbar,
	},
};


</script>
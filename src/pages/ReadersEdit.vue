<template>
        <div class="container-xxl flex-grow-1 container-p-y">
			<nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item">
                        <router-link :to="{path: '/'}" class="menu-link">Главная</router-link>
                      </li>
					  <li class="breadcrumb-item">
                        <router-link :to="{path: '/readers'}" class="menu-link">Список читателей</router-link>
                      </li>
                      <li class="breadcrumb-item active">Изменение читателя</li>
                    </ol>
                  </nav>
    		<h4 class="fw-bold py-3 mb-4">Изменение читателя</h4>
			<!-- Content wrapper -->
		<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-10">
                  <div class="card mb-4">
                    <!-- Account -->
					<form @submit.prevent="onReaderEdit">
                    <div class="card-body">
						<div class="row">
							<div class="text-center">
							</div>
							<div class="col">
						
							<div class="mb-3">
                            	<label for="firstName" class="form-label">ФИО</label>
                            	<input class="form-control" type="text" v-model="reader_fio" placeholder="ФИО" aria-label="default input example">
                          </div>
							<div class="mb-3">
                            	<label for="firstName" class="form-label">Группа</label>
                            	<input class="form-control" type="text" v-model="reader_group" placeholder="ПО-42" aria-label="default input example">
                          </div>
							<div class="mb-3">
                            	<label for="firstName" class="form-label">ИИН</label>
                            	<input class="form-control" type="text" v-model="reader_iin" placeholder="00000000000" aria-label="default input example">
                          </div>
							</div>
						</div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
						<div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Сохранить</button>
						  	<router-link :to="{path: '/readers'}" class="btn btn-outline-secondary">
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
          <!-- Content wrapper -->
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
		useMeta({title: 'Изменение читателя | Biblioteka'});
	},
	data: () => ({
		
		reader_fio: '',
		reader_group: '',
		reader_iin: '',
	}),
	methods: {
		onReaderEdit(){
			fetch('/api/readers/' + this.$route.params.id, {
				method: 'POST',
				body: JSON.stringify({
					fio: this.reader_fio,
					group: this.reader_group,
					iin: this.reader_iin,
				}),
				headers: {
					Authorization: 'Bearer '+this.authModel.token,
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				if(data.success){
					this.$router.push('/readers');
				}
			}).catch(error => {
				console.log(error);
			});
		},
		onLoad(id){
			fetch('/api/readers/' + id, {
				headers: {
					Authorization: 'Bearer '+this.authModel.token,
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.reader_fio = data.fio;
				this.reader_group = data.group;
				this.reader_iin = data.iin;
			}).catch(error => {
				console.log(error);
			});
		},
	},
	mounted(){
		//this.loadBooks();
		this.onLoad(this.$route.params.id);
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
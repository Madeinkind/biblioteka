<template>
		<!-- Navbar -->

		<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center w-100" >
                <form class="nav-item d-flex align-items-center w-100" @submit.prevent="loadVisitors()">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Поиск..."
                    aria-label="Поиск..."
					v-model="search"
					@keyup="loadVisitors()"
                  />
				</form>
              </div>
              <!-- /Search -->
            </div>
          </nav>
          <!-- / Navbar -->
		  
        <div class="container-xxl flex-grow-1 container-p-y">
				<!-- Basic Breadcrumb -->
                  <!-- Custom style1 Breadcrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1">
                      <li class="breadcrumb-item">
                        <router-link :to="{path: '/'}" class="menu-link">Главная</router-link>
                      </li>
                      <li class="breadcrumb-item active">Посетители</li>
                    </ol>
                  </nav>
    		<h4 class="fw-bold py-3 mb-4">Посетители</h4>
			<!-- Basic Bootstrap Table -->
			<div class="card">
				<router-link :to="{path: '/visitors/add'}" class="btn btn-primary">
					Добавить
              </router-link>
                <div class="table-responsive text-nowrap"></div>
				  <table class="table">
					<thead class="thead">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">ФИО</th>
						<th scope="col">Группа</th>
						<th scope="col">Дата посещения</th>
					</tr>
					</thead>
					<tbody class="table-group-divider">
					<tr v-for="visitor in visitors" :key="visitor.id">
						<td>{{visitor.id}}</td>
						<td>{{visitor.fio}}</td>
						<td>{{visitor.group}}</td>
						<td>{{formatDate(visitor.date)}}</td>
						
						<td class="text-end">
							<router-link :to="{path: '/visitors/'+visitor.id+'/edit'}" class="btn btn-success me-1 px-3">
								<i class='bx bxs-pencil'></i>
							</router-link>
							<input type="button" class="btn btn-danger" @click="onDeleteVisitor(visitor.id)" value="✖" />
            			</td>
					</tr>
					
					</tbody>
				</table>
			  </div>
			  <nav aria-label="Page navigation">
				<ul class="pagination justify-content-center">
					<li class="page-item" v-for="p in getPagesCount()">
						<a class="page-link" href="javascript://" @click="page = p; loadVisitors();">{{p}}</a>
					</li>
				</ul>
        	</nav>
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
		useMeta({title: 'Список посетителей | Biblioteka'});
	},
	data: () => ({	
		search: '',
		page: 1,
		limit: 10,
		
		visitors: [],
		visitors_count: 0,
	}),
	methods: {
		loadVisitors(){
			fetch('/api/visitors?' + new URLSearchParams({
				search: this.search,
				start: (this.page - 1) * this.limit,
				limit: this.limit,
			}), {
				headers: {
					Authorization: 'Bearer '+this.authModel.token,
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.visitors = data.list;
				this.visitors_count = data.count;
			}).catch(error => {
				console.log(error);
			});
		},
		

		onDeleteVisitor(id){
			if(confirm('Вы уверены?')){
     		   fetch('/api/visitors/'+id, {
				method: 'DELETE',
				/*body: JSON.stringify({
					name: this.read_name,
					count: this.read_count,
				}),*/
				headers: {
					'Content-Type': 'application/json',
					Authorization: 'Bearer '+this.authModel.token,
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
        if(data.success){
			this.loadVisitors();
        }
			}).catch(error => {
				console.log(error);
			});  
      }
      
		},
				// получение количества страниц для списка новостей
		getPagesCount(){
			return Math.ceil(this.visitors_count / this.limit);
		},

		formatDate(date_str){
			try {
				let d = new Date(date_str);
				d.setHours(d.getHours()+6); //gmt+6
				let d2 = d.toISOString().split('T')[0];
				return d2.split('-').reverse().join('.');
			} catch (e){
				return '';
			}
		},
	},
	mounted(){
		//this.loadreads();
	},
	beforeMount(){
		window.scrollTo(0, 0);
		this.loadVisitors();
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		this.loadVisitors();
	},
	computed: {},
	components: {
		//Navbar,
	},
	
	
};




</script>
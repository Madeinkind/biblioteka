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
                <form class="nav-item d-flex align-items-center w-100" @submit.prevent="loadBooks()">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
					v-model="search"
					@keyup="loadBooks()"
                  />
				</form>
              </div>
              <!-- /Search -->
            </div>
          </nav>
          <!-- / Navbar -->
        <div class="container-xxl flex-grow-1 container-p-y">
    		<h4 class="fw-bold py-3 mb-4">Список читателей</h4>
			<!-- Basic Bootstrap Table -->
			<div class="card">
				<router-link :to="{path: '/readers/add'}" class="btn btn-primary">
					Добавить
              </router-link>
                <div class="table-responsive text-nowrap"></div>
				  <table class="table">
					<thead class="thead">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">ФИО</th>
						<th scope="col">Группа</th>
						<th scope="col">ИИН</th>
					</tr>
					</thead>
					<tbody class="table-group-divider">
					<tr v-for="reader in readers" :key="reader.id">
						<td>{{reader.id}}</td>
						<td>{{reader.fio}}</td>
						<td>{{reader.group}}</td>
						<td>{{reader.iin}}</td>
						<td class="text-end">
							<router-link :to="{path: '/readers/'+reader.id+'/edit'}" class="btn btn-success">
								<i class='bx bxs-pencil'></i>
							</router-link>
							<input type="button" class="btn btn-danger" @click="onDeleteReader(reader.id)" value="✖" />
            			</td>
					</tr>
					
					</tbody>
				</table>
			  </div>
			  <nav aria-label="Page navigation">
                	<ul class="pagination justify-content-center">
                	  <li class="page-item prev">
                	    <a class="page-link" href="javascript:void(0);"
                	      ><i class="tf-icon bx bx-chevrons-left"></i
                	    ></a>
                	  </li>
                	  <li class="page-item">
                	    <a class="page-link" href="javascript:void(0);">1</a>
                	  </li>
                	  <li class="page-item">
                	    <a class="page-link" href="javascript:void(0);">2</a>
                	  </li>
                	  <li class="page-item active">
                	    <a class="page-link" href="javascript:void(0);">3</a>
                	  </li>
                	  <li class="page-item">
                	    <a class="page-link" href="javascript:void(0);">4</a>
                	  </li>
                	  <li class="page-item">
                	    <a class="page-link" href="javascript:void(0);">5</a>
                	  </li>
                	  <li class="page-item next">
                	    <a class="page-link" href="javascript:void(0);"
                	      ><i class="tf-icon bx bx-chevrons-right"></i
                	    ></a>
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
	name: 'Main',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Список читателей | Biblioteka'});
	},
	data: () => ({	
		search: '',
		page: 1,
		limit: 10,
		
		readers: [],
		readers_count: 0,
	}),
	methods: {
		loadReaders(){
			fetch('/api/readers?' + new URLSearchParams({
				search: this.search,
				start: (this.page - 1) * this.limit,
				limit: this.limit,
			})).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.readers = data.list;
				this.readers_count = data.count;
			}).catch(error => {
				console.log(error);
			});
		},
		

		onDeleteReader(id){
			if(confirm('Вы уверены?')){
     		   fetch('/api/readers/'+id, {
				method: 'DELETE',
				/*body: JSON.stringify({
					name: this.read_name,
					count: this.read_count,
				}),*/
				headers: {
					'Content-Type': 'application/json',
				},
			}).then(stream => stream.json()).then((data) => {
				//console.log(data);
        if(data.success){
			this.loadReaders();
        }
			}).catch(error => {
				console.log(error);
			});  
      }
      
		},
				// получение количества страниц для списка новостей
				getPagesCount(){
			return Math.ceil(this.books_count / this.limit);
		},
	},
	mounted(){
		//this.loadreads();
	},
	beforeMount(){
		window.scrollTo(0, 0);
		this.loadReaders();
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		this.loadReaders();
	},
	computed: {},
	components: {
		//Navbar,
	},
	
	
};




</script>
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
                <form class="nav-item d-flex align-items-center w-100" @submit.prevent="loadReadersDebtors()">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Поиск..."
                    aria-label="Поиск..."
					v-model="search"
					@keyup="loadReadersDebtors()"
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
                      <li class="breadcrumb-item active">Должники</li>
                    </ol>
                  </nav>
    		<h4 class="fw-bold py-3 mb-4">Должники</h4>
			<!-- Basic Bootstrap Table -->
			<div class="card">
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
					<tr v-for="book in books" :key="book.id">
						<td>{{book.id}}</td>
						<td>{{book.reader_fio}}</td>
						<td>{{book.reader_group}}</td>
						<td>{{book.reader_iin}}</td>
					</tr>
					</tbody>
				</table>
			  </div>
			  <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
				<li class="page-item" v-for="p in getPagesCount()">
					<a class="page-link" href="javascript://" @click="page = p; loadReadersDebtors();">{{p}}</a>
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
		useMeta({title: 'Должники | Biblioteka'});
	},
	data: () => ({
		search: '',
		page: 1,
		limit: 10,
		
		books: [],
		books_count: 0,
	}),
	methods: {
		loadReadersDebtors(){
			fetch('/api/readers-debtors?' + new URLSearchParams({
				search: this.search,
				start: (this.page - 1) * this.limit,
				limit: this.limit,
			})).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.books = data.list;
				this.books_count = data.count;
			}).catch(error => {
				console.log(error);
			});
		},
		// получение количества страниц для списка новостей
		getPagesCount(){
			return Math.ceil(this.books_count / this.limit);
		},
	},
	mounted(){
		//this.loadReadersDebtors();
	},
	beforeMount(){
		window.scrollTo(0, 0);
		this.loadReadersDebtors();
	},
	beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		this.loadReadersDebtors();
	},
	computed: {},
	components: {
		//Navbar,
	},
};


</script>
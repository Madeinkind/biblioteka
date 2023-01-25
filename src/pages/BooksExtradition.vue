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
          <form class="nav-item d-flex align-items-center w-100" @submit.prevent="page_name == 'select-book' ? loadBooks() : (page_name == 'select-reader' ? loadReaders() : null)">
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
    <!-- Basic Breadcrumb -->
    <!-- Custom style1 Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-style1">
        <li class="breadcrumb-item">
          <router-link :to="{path: '/'}" class="menu-link">Главная</router-link>
        </li>
        <li class="breadcrumb-item active">Выдача книг</li>
      </ol>
    </nav>
    <div class="card mb-3" v-if="book_id != ''">
      <div class="card-body">
        <div @click="page_name = 'select-book'; book_id = '';" class="btn btn-primary float-end">Выбрать другую</div>
        <h4 class="card-title mt-2 mb-n2">Выбрана книга: {{ getBook(book_id).name }}</h4>
      </div>
    </div>
    <div class="card mb-3" v-if="reader_id != ''">
      <div class="card-body">
        <div @click="page_name = 'select-reader'; reader_id = '';" class="btn btn-primary float-end">Выбрать другого</div>
        <h4 class="card-title mt-2 mb-n2">Выбран читатель: {{ getReader(reader_id).fio }} (группа: {{ getReader(reader_id).group }})</h4>
      </div>
    </div>
    <div v-if="page_name == 'select-book'">
      <h4 class="fw-bold py-3 mb-4">Выберите книгу</h4>
      <!-- Examples -->
      <div class="row mb-5">
        <div class="col-md-6 col-lg-2 mb-3" v-for="book in books" :key="book.id">
          <div class="card h-100">
            <img class="card-img-top" src="/assets/img/elements/2.jpg" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">{{book.name}}</h5>
              <p class="card-text">Автор</p>
              <div class="btn btn-outline-primary" @click="reader_id == '' ? page_name='select-reader' : page_name='select-date'; book_id = book.id;">Выбрать</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="page_name == 'select-reader'">
      <h4 class="fw-bold py-3 mb-4">Выберите читателя</h4>
      <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
          <router-link :to="{path: '/readers/add'}" class="btn btn-primary">Добавить</router-link>
          <div class="table-responsive text-nowrap"></div>
          <table class="table">
            <thead class="thead">
              <tr>
                <th width="50">ID</th>
                <th>ФИО</th>
                <th width="30%">Группа</th>
                <th width="20%">ИИН</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr v-for="reader in readers" :key="reader.id">
                <td>{{reader.id}}</td>
                <td>{{reader.fio}}</td>
                <td>{{reader.group}}</td>
                <td>{{reader.iin}}</td>
                <td class="text-end" width="200">
                  <div class="btn btn-outline-primary" @click="book_id == '' ? page_name='select-book' : page_name='select-date';  reader_id = reader.id;">Выбрать</div>
                </td>
              </tr>
            </tbody>
          </table>
          <form @submit.prevent="onReaderAddSelect()">
            <table class="table">
              <tbody class="table-group-divider">
                <tr>
                  <td width="50">#</td>
                  <td>
                    <input type="text" class="form-control" placeholder="ФИО" v-model="reader_fio" required>
                  </td>
                  <td width="30%">
                    <input type="text" class="form-control" placeholder="Группа" v-model="reader_group" required>
                  </td>
                  <td width="20%">
                    <input type="text" class="form-control" placeholder="ИИН" v-model="reader_iin" required>
                  </td>
                  <td class="text-end" width="200">
                    <button type="submit" class="btn btn-outline-primary">Добавить и выбрать</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
    <div v-if="page_name == 'select-date'">
      <h4 class="fw-bold py-3 mb-4">Укажите дополнительные параметры</h4>
      <form @submit.prevent="onBookExtradition()">
        <div class="card-body">
          <div class="row">
            <div class="col col-md-3">
              <div class="mb-3">
               <label for="firstName" class="form-label">Дата выдачи книги</label>
               <input class="form-control" type="date" required v-model="date_start">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col col-md-3">
              <div class="mb-3">
               <label for="firstName" class="form-label">Дата планируемого возврата книги</label>
               <input class="form-control" type="date" required v-model="date_end_plan">
              </div>
            </div>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Выдать</button>
          </div>
        </div>
      </form>
    </div>
	 </div>
</template>

<style lang="css" scoped>

</style>



<script>
import lib from '@/lib';
import { enumBooleanMember } from '@babel/types';
import { useMeta } from 'vue-meta';

export default {
	name: 'Main',
	mixins: lib.mixins,
	setup(){
		useMeta({title: 'Выдача книги | Biblioteka'});
	},
	data: () => ({
		search: '',
		
		books: [],
		books_count: 0,
    
    readers: [],
		readers_count: 0,
    
    page_name: 'select-book',
    book_id: '',
    reader_id: '',
    date_start: '',
    date_end_plan:'',

    reader_fio:'',
    reader_group:'',
    reader_iin:'',

	}),
	methods: {
		async loadBooks(){
			await fetch('/api/books?' + new URLSearchParams({
				search: this.search,
			})).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.books = data.list;
				this.books_count = data.count;
			}).catch(error => {
				console.log(error);
			});
		},
    
    async loadReaders(){
		  await fetch('/api/readers?' + new URLSearchParams({
				search: this.search,
			})).then(stream => stream.json()).then((data) => {
				//console.log(data);
				this.readers = data.list;
				this.readers_count = data.count;
			}).catch(error => {
				console.log(error);
			});
		},

    onReaderAddSelect(){
      if(confirm('Вы уверены?')){
				fetch('/api/readers', {
          method: 'POST',
          body: JSON.stringify({
            fio: this.reader_fio,
            group: this.reader_group,
            iin: this.reader_iin,
          }),
          headers: {
            'Content-Type': 'application/json',
          },
        }).then(stream => stream.json()).then(async (data) => {
          //console.log(data);
          if(data.success){
            await this.loadReaders();
            this.reader_id = data.id;
            if(this.book_id == ''){
              this.page_name = 'select-book';
            } else {
              this.page_name = 'select-date';
            }
            
          }
        }).catch(error => {
          console.log(error);
        });
     	}
    },

    onBookExtradition(){
      if(confirm('Вы уверены?')){
				fetch('/api/books-readers', {
					method: 'POST',
					body: JSON.stringify({
						book_id: this.book_id,
						reader_id: this.reader_id,
            date_start: this.date_start,
            date_end_plan: this.date_end_plan,
					}),
					headers: {
						'Content-Type': 'application/json',
					},
				}).then(stream => stream.json()).then((data) => {
					//console.log(data);
					if(data.success){
						this.$router.push('/books-issued-history');
					}
				}).catch(error => {
					console.log(error);
				});  
     	}
    },

    getBook(id){
      return this.books.find((elem => elem.id == id));
    },
    getReader(id){
      return this.readers.find((elem => elem.id == id));
    },
	},
	mounted(){
		//this.loadBooks();
	},
	async beforeMount(){
		window.scrollTo(0, 0);
		await this.loadBooks();
    await this.loadReaders();
    
    let d = new Date;
    let d2 = d.toISOString().split('T')[0];
    this.date_start = d2;
	},
	async beforeRouteUpdate(to, from, next){
		next();
		window.scrollTo(0, 0);
		await this.loadBooks();
    await this.loadReaders();

    let d = new Date;
    let d2 = d.toISOString().split('T')[0];
    this.date_start = d2;
	},
	computed: {},
	components: {
		//Navbar,
	},
};




</script>
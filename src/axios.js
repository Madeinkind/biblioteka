import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
/* axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Access-Control-Allow-Headers'] = '*'; */

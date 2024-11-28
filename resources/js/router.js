import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/components/Home.vue';  
import FormPelajar from './components/FormPelajar.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/form-pelajar',
    name: 'Form-pelajar',
    component: FormPelajar,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

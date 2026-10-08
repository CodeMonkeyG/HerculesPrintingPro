import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/services',
      name: 'services',
      component: () => import('../views/ServicesView.vue')
    },
    {
      path: '/services/:slug',
      name: 'service-detail',
      component: () => import('../views/ServiceDetailView.vue')
    },
    {
      path: '/contact',
      name: 'contact',
      component: () => import('../views/ContactView.vue')
    },
    // Spanish Routes (/es/)
    {
      path: '/es',
      name: 'home-es',
      component: HomeView
    },
    {
      path: '/es/servicios',
      name: 'services-es',
      component: () => import('../views/ServicesView.vue')
    },
    {
      path: '/es/services',
      redirect: '/es/servicios'
    },
    {
      path: '/es/servicios/:slug',
      name: 'service-detail-es',
      component: () => import('../views/ServiceDetailView.vue')
    },
    {
      path: '/es/services/:slug',
      redirect: to => `/es/servicios/${to.params.slug}`
    },
    {
      path: '/es/nosotros',
      name: 'about-es',
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/es/acerca',
      redirect: '/es/nosotros'
    },
    {
      path: '/es/about',
      redirect: '/es/nosotros'
    },
    {
      path: '/es/contacto',
      name: 'contact-es',
      component: () => import('../views/ContactView.vue')
    },
    {
      path: '/es/contact',
      redirect: '/es/contacto'
    }
  ],
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  }
})

export default router

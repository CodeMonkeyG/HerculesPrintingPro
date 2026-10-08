<template>
  <v-app>
    <v-app-bar color="primary" elevation="4" :height="xs ? 124 : 64">
      <v-container :class="['d-flex align-center', xs ? 'flex-column justify-center py-2' : 'justify-space-between']" fluid class="px-4 py-0">
        <router-link :to="isEs ? '/es' : '/'" class="text-decoration-none text-white">
          <div
            class="font-weight-bold text-uppercase text-center text-sm-left"
            :style="{
              letterSpacing: '2px',
              fontSize: xs ? '1.1rem' : '1.25rem',
              width: xs ? '100%' : 'auto',
              marginBottom: xs ? '8px' : '0'
            }"
          >
            Hercules Printing Pro
          </div>
        </router-link>

        <div :class="['d-flex align-center flex-wrap justify-center ga-1', xs ? 'w-100' : '']">
          <v-btn variant="text" :to="isEs ? '/es' : '/'" class="text-white" :density="xs ? 'compact' : 'default'">
            {{ isEs ? 'Inicio' : 'Home' }}
          </v-btn>
          <v-btn variant="text" :to="isEs ? '/es/servicios' : '/services'" class="text-white" :density="xs ? 'compact' : 'default'">
            {{ isEs ? 'Servicios' : 'Services' }}
          </v-btn>
          <v-btn variant="text" :to="isEs ? '/es/nosotros' : '/about'" class="text-white" :density="xs ? 'compact' : 'default'">
            {{ isEs ? 'Nosotros' : 'About' }}
          </v-btn>
          <v-btn variant="text" :to="isEs ? '/es/contacto' : '/contact'" class="text-white" :density="xs ? 'compact' : 'default'">
            {{ isEs ? 'Contacto' : 'Contact' }}
          </v-btn>

          <!-- Language Switcher Toggle -->
          <v-btn
            variant="outlined"
            color="white"
            :to="targetLangRoute"
            class="ml-1 font-weight-bold"
            :density="xs ? 'compact' : 'default'"
            size="small"
          >
            <v-icon icon="mdi-web" start size="16"></v-icon>
            {{ isEs ? 'English' : 'Español' }}
          </v-btn>

          <v-btn
            color="white"
            variant="flat"
            :to="isEs ? '/es/contacto' : '/contact'"
            class="ml-2 text-black d-none d-sm-flex font-weight-bold"
          >
            {{ isEs ? 'Cotizar' : 'Request Quote' }}
          </v-btn>
        </div>
      </v-container>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>

    <v-footer class="bg-grey-lighten-4 py-10 mt-12 border-t">
      <v-container class="text-center">
        <div class="font-weight-bold text-uppercase mb-2 text-grey-darken-4" style="letter-spacing: 2px; font-size: 1.25rem;">
          Hercules Printing Pro
        </div>
        <p class="text-body-2 text-grey-darken-2 mb-4 font-weight-medium">
          {{ isEs ? 'Precisión. Calidad. Rapidez.' : 'Precision. Quality. Speed.' }}
        </p>

        <!-- Direct Contact Info Strip -->
        <div class="d-flex flex-wrap justify-center align-center ga-4 ga-md-6 mb-4 text-body-2 text-grey-darken-3">
          <a href="tel:4159374062" class="text-decoration-none text-grey-darken-3 d-inline-flex align-center font-weight-medium">
            <v-icon icon="mdi-phone" size="18" color="black" class="mr-1"></v-icon>
            415-937-4062
          </a>
          <span class="d-none d-sm-inline text-grey-lighten-1">|</span>
          <a href="mailto:contact@herculesprintingpro.com" class="text-decoration-none text-grey-darken-3 d-inline-flex align-center font-weight-medium">
            <v-icon icon="mdi-email" size="18" color="black" class="mr-1"></v-icon>
            contact@herculesprintingpro.com
          </a>
          <span class="d-none d-sm-inline text-grey-lighten-1">|</span>
          <span class="d-inline-flex align-center">
            <v-icon icon="mdi-clock-outline" size="18" color="black" class="mr-1"></v-icon>
            {{ isEs ? 'Lun - Vie: 9:00 AM - 6:00 PM' : 'Mon - Fri: 9:00 AM - 6:00 PM' }}
          </span>
        </div>

        <p class="text-caption text-grey-darken-1 mb-2">
          {{ isEs ? 'Sirviendo a Hercules, Pinole, Crockett y Rodeo. Equipo de imprenta local con atención personalizada.' : 'Serving Hercules, Pinole, Crockett, and Rodeo. Local commercial print authority.' }}
        </p>
        <p class="text-caption text-grey mb-0">
          &copy; {{ new Date().getFullYear() }} Hercules Printing Pro. {{ isEs ? 'Todos los derechos reservados.' : 'All rights reserved.' }}
        </p>
      </v-container>
    </v-footer>
  </v-app>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useDisplay } from 'vuetify'
import { useRecaptchaProvider } from 'vue-recaptcha'

useRecaptchaProvider()
const { xs } = useDisplay()
const route = useRoute()

const isEs = computed(() => route.path.startsWith('/es'))

const targetLangRoute = computed(() => {
  const path = route.path
  if (isEs.value) {
    if (path === '/es' || path === '/es/') return '/'
    if (path.startsWith('/es/servicios/') || path.startsWith('/es/services/')) {
      return `/services/${route.params.slug}`
    }
    if (path === '/es/servicios' || path === '/es/services') return '/services'
    if (path === '/es/nosotros' || path === '/es/acerca' || path === '/es/about') return '/about'
    if (path === '/es/contacto' || path === '/es/contact') return '/contact'
    return '/'
  } else {
    if (path === '/') return '/es'
    if (path.startsWith('/services/')) {
      return `/es/servicios/${route.params.slug}`
    }
    if (path === '/services') return '/es/servicios'
    if (path === '/about') return '/es/nosotros'
    if (path === '/contact') return '/es/contacto'
    return '/es'
  }
})
</script>

<style>
body {
  margin: 0;
}
</style>

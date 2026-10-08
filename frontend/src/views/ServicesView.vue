<template>
  <div>
    <!-- Hero Header -->
    <v-sheet
      class="bg-black text-white d-flex align-center py-16"
      elevation="0"
    >
      <v-container>
        <v-row align="center" justify="center">
          <v-col cols="12" md="10" class="text-center">
            <h1 class="text-h3 text-md-h2 font-weight-bold mb-4">
              {{ isEs ? 'Nuestros Servicios de Impresión' : 'Commercial Print Services' }}
            </h1>
            <p class="text-h6 font-weight-medium mb-3 text-grey-lighten-1">
              {{ isEs ? 'Precisión. Calidad. Rapidez.' : 'Precision. Quality. Speed.' }}
            </p>
            <p class="text-body-1 text-md-h6 text-grey-lighten-2 mx-auto" style="max-width: 750px; line-height: 1.6;">
              {{ isEs ? 'Soluciones de impresión comercial de alta calidad diseñadas para negocios y eventos en Hercules, Pinole, Crockett y Rodeo.' : 'Commercial-grade print solutions built for businesses, organizations, and events across Hercules, Pinole, Crockett, and Rodeo.' }}
            </p>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>

    <!-- Services Grid -->
    <v-container class="py-16">
      <v-row>
        <v-col
          v-for="service in currentServices"
          :key="service.id"
          cols="12"
          md="6"
          lg="4"
        >
          <v-card
            class="h-100 d-flex flex-column pa-6"
            elevation="2"
            border
            hover
            style="transition: transform 0.2s;"
          >
            <div class="d-flex align-center mb-4">
              <v-avatar color="primary" variant="flat" size="52" class="mr-3 text-white">
                <v-icon :icon="service.icon" color="white" size="28"></v-icon>
              </v-avatar>
              <div>
                <h2 class="text-h6 font-weight-bold" style="line-height: 1.3;">
                  {{ service.title }}
                </h2>
              </div>
            </div>

            <p class="text-body-2 text-grey-darken-1 mb-4 flex-grow-1" style="line-height: 1.6;">
              {{ service.shortDescription }}
            </p>

            <div class="mb-4 pa-3 bg-grey-lighten-4 rounded">
              <div class="text-caption font-weight-bold text-grey-darken-3 mb-1">
                {{ isEs ? 'El Reto:' : 'The Challenge:' }}
              </div>
              <p class="text-caption text-grey-darken-2 mb-0" style="line-height: 1.4;">
                {{ service.problem }}
              </p>
            </div>

            <div class="mt-auto pt-3 border-t d-flex justify-space-between align-center">
              <v-btn
                variant="text"
                color="primary"
                :to="isEs ? `/es/servicios/${service.slug}` : `/services/${service.slug}`"
                class="px-0 font-weight-bold"
                density="comfortable"
              >
                {{ isEs ? 'Ver Detalles' : 'View Full Details' }}
                <v-icon icon="mdi-arrow-right" end size="18"></v-icon>
              </v-btn>

              <v-btn
                variant="tonal"
                color="primary"
                size="small"
                :to="`${isEs ? '/es/contacto' : '/contact'}?service=${encodeURIComponent(service.contactServiceValue)}`"
              >
                {{ isEs ? 'Cotizar' : 'Get Quote' }}
              </v-btn>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <!-- Local Footprint Banner -->
      <v-sheet
        class="mt-16 pa-8 pa-md-10 rounded-xl text-center text-white bg-black"
        elevation="4"
      >
        <h3 class="text-h4 font-weight-bold mb-3">
          {{ isEs ? 'Impresión Local en el East Bay' : 'East Bay Local Printing' }}
        </h3>
        <p class="text-h6 font-weight-bold mb-3 text-grey-lighten-2">
          {{ isEs ? 'Hercules, Pinole, Crockett y Rodeo' : 'Hercules, Pinole, Crockett, and Rodeo' }}
        </p>
        <p class="text-body-1 text-grey-lighten-2 mx-auto mb-6" style="max-width: 680px; line-height: 1.6;">
          {{ isEs ? 'Equipo de impresión local. Tiempos de entrega rápidos. Sin retrasos por envíos internacionales ni portales anónimos.' : 'Local print team. Rapid turnarounds. No overseas shipping delays or anonymous web portals.' }}
        </p>
        <div class="d-flex flex-wrap justify-center ga-4">
          <v-btn
            color="white"
            size="large"
            :to="isEs ? '/es/contacto' : '/contact'"
            class="px-8 font-weight-bold text-black"
            elevation="2"
          >
            {{ isEs ? 'Solicitar una Cotización' : 'Request a Quote' }}
          </v-btn>
          <v-btn
            variant="outlined"
            color="white"
            size="large"
            href="tel:4159374062"
            class="px-6"
          >
            <v-icon icon="mdi-phone" start></v-icon>
            415-937-4062
          </v-btn>
        </div>
      </v-sheet>
    </v-container>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useHead } from '@unhead/vue'
import { getServices } from '../data/services'

const route = useRoute()
const isEs = computed(() => route.path.startsWith('/es'))
const currentServices = computed(() => getServices(isEs.value ? 'es' : 'en'))

useHead({
  title: computed(() => isEs.value
    ? 'Servicios de Impresión Comercial | Hercules Printing Pro'
    : 'Commercial Print Services | Hercules Printing Pro'
  ),
  meta: [
    {
      name: 'description',
      content: computed(() => isEs.value
        ? 'Servicios de impresión comercial para negocios en Hercules, Pinole, Crockett y Rodeo. Tarjetas de presentación, lonas, folletos, ropa y gran formato.'
        : 'Commercial print services in Hercules, Pinole, Crockett, and Rodeo. Business cards, vinyl banners, brochures, apparel, stickers, and large format printing.'
      )
    },
    {
      property: 'og:title',
      content: computed(() => isEs.value ? 'Servicios de Impresión | Hercules Printing Pro' : 'Print Services | Hercules Printing Pro')
    },
    {
      property: 'og:url',
      content: computed(() => isEs.value ? 'https://herculesprintingpro.com/es/servicios' : 'https://herculesprintingpro.com/services')
    }
  ],
  link: [
    {
      rel: 'canonical',
      href: computed(() => isEs.value ? 'https://herculesprintingpro.com/es/servicios' : 'https://herculesprintingpro.com/services')
    },
    {
      rel: 'alternate',
      hreflang: 'en',
      href: 'https://herculesprintingpro.com/services'
    },
    {
      rel: 'alternate',
      hreflang: 'es',
      href: 'https://herculesprintingpro.com/es/servicios'
    },
    {
      rel: 'alternate',
      hreflang: 'x-default',
      href: 'https://herculesprintingpro.com/services'
    }
  ]
})
</script>

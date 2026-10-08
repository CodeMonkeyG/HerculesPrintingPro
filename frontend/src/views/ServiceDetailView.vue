<template>
  <div v-if="service">
    <!-- Hero Header -->
    <v-sheet
      class="bg-black text-white py-12 py-md-16"
      elevation="0"
    >
      <v-container>
        <v-row align="center">
          <v-col cols="12">
            <v-btn
              variant="text"
              color="grey-lighten-2"
              :to="isEs ? '/es/servicios' : '/services'"
              class="mb-4 pl-0"
            >
              <v-icon icon="mdi-arrow-left" start></v-icon>
              {{ isEs ? 'Volver a Todos los Servicios' : 'Back to All Services' }}
            </v-btn>

            <div class="d-flex align-center flex-wrap ga-4 mb-4">
              <v-avatar color="white" size="64" class="text-black" elevation="2">
                <v-icon :icon="service.icon" size="36" color="black"></v-icon>
              </v-avatar>
              <div>
                <span class="text-overline font-weight-bold text-grey-lighten-1 tracking-wide">
                  {{ isEs ? 'Servicio de Hercules Printing Pro' : 'Hercules Printing Pro Service' }}
                </span>
                <h1 class="text-h3 text-md-h2 font-weight-bold text-white" style="line-height: 1.2;">
                  {{ service.title }}
                </h1>
              </div>
            </div>

            <p class="text-h6 text-grey-lighten-1 mb-6" style="max-width: 800px; line-height: 1.6;">
              {{ service.shortDescription }}
            </p>

            <div class="d-flex flex-wrap align-center ga-4">
              <v-btn
                color="white"
                size="x-large"
                :to="`${isEs ? '/es/contacto' : '/contact'}?service=${encodeURIComponent(service.contactServiceValue)}`"
                class="px-8 font-weight-bold text-black"
                elevation="3"
              >
                {{ isEs ? 'Solicitar Cotización' : 'Request a Quote' }}
              </v-btn>
              <v-btn
                variant="outlined"
                color="white"
                size="x-large"
                href="tel:4159374062"
                class="px-6"
              >
                <v-icon icon="mdi-phone" start></v-icon>
                415-937-4062
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>

    <!-- Main Content Container -->
    <v-container class="py-12">
      <v-row justify="center">
        <v-col cols="12" lg="10">

          <!-- The Problem Section (Hook) -->
          <v-card class="pa-6 pa-md-8 mb-10 border" elevation="0" style="border-left: 6px solid #FF5252 !important; background-color: #FFF8F8;">
            <div class="d-flex align-start ga-4">
              <v-avatar color="error" variant="tonal" size="48">
                <v-icon icon="mdi-alert-circle-outline" color="error" size="28"></v-icon>
              </v-avatar>
              <div>
                <h2 class="text-h5 font-weight-bold text-grey-darken-4 mb-2">
                  {{ isEs ? 'El Problema' : 'The Problem' }}
                </h2>
                <p class="text-body-1 text-grey-darken-3 mb-0" style="line-height: 1.7; font-size: 1.1rem;">
                  {{ service.problem }}
                </p>
              </div>
            </div>
          </v-card>

          <!-- The Solution Section (What We Do) -->
          <v-card class="pa-6 pa-md-8 mb-10 border" elevation="0" style="border-left: 6px solid #000000 !important; background-color: #FAFAFA;">
            <div class="d-flex align-start ga-4">
              <v-avatar color="primary" variant="flat" size="48" class="text-white">
                <v-icon icon="mdi-check-decagram" color="white" size="28"></v-icon>
              </v-avatar>
              <div>
                <h2 class="text-h5 font-weight-bold text-grey-darken-4 mb-2">
                  {{ isEs ? 'Nuestra Solución' : 'What We Do' }}
                </h2>
                <p class="text-body-1 text-grey-darken-3 mb-0" style="line-height: 1.7; font-size: 1.1rem;">
                  {{ service.solution }}
                </p>
              </div>
            </div>
          </v-card>

          <!-- What's Included Section -->
          <div class="my-12">
            <div class="text-center mb-8">
              <h2 class="text-h4 font-weight-bold mb-2">
                {{ isEs ? 'Especificaciones y Beneficios' : "What's Included" }}
              </h2>
              <v-divider class="mx-auto mb-3" width="80" thickness="3" color="primary"></v-divider>
              <p class="text-subtitle-1 text-grey-darken-1">
                {{ isEs ? 'Estándares profesionales de producción y acabados de alta calidad' : 'Professional production standards and premium finishing options' }}
              </p>
            </div>

            <v-row>
              <v-col
                v-for="(item, idx) in service.whatsIncluded"
                :key="idx"
                cols="12"
                sm="6"
              >
                <v-card class="pa-5 h-100 border d-flex align-start" elevation="0">
                  <v-avatar color="black" variant="tonal" size="36" class="mr-4 flex-shrink-0">
                    <v-icon icon="mdi-check" color="black" size="20"></v-icon>
                  </v-avatar>
                  <div class="text-body-1 font-weight-medium text-grey-darken-3 pt-1" style="line-height: 1.5;">
                    {{ item }}
                  </div>
                </v-card>
              </v-col>
            </v-row>
          </div>

          <!-- Who It's For Section -->
          <v-card class="pa-6 pa-md-8 mb-12 bg-grey-lighten-4 border" elevation="0">
            <div class="d-flex align-start ga-4">
              <v-avatar color="grey-darken-3" variant="tonal" size="48">
                <v-icon icon="mdi-account-group" color="grey-darken-3" size="28"></v-icon>
              </v-avatar>
              <div>
                <h2 class="text-h5 font-weight-bold text-grey-darken-4 mb-2">
                  {{ isEs ? 'Ideal Para' : "Who It's For" }}
                </h2>
                <p class="text-body-1 text-grey-darken-2 mb-0" style="line-height: 1.7; font-size: 1.05rem;">
                  {{ service.whoItsFor }}
                </p>
              </div>
            </div>
          </v-card>

          <!-- Local Footprint Guarantee -->
          <div class="text-center pa-6 mb-12 rounded-lg bg-grey-lighten-3 border">
            <v-icon icon="mdi-map-marker-radius" color="black" size="32" class="mb-2"></v-icon>
            <h3 class="text-h6 font-weight-bold mb-1">
              {{ isEs ? 'Producción y Entrega Local en West Contra Costa County' : 'Local Production & Fast Delivery in West Contra Costa County' }}
            </h3>
            <p class="text-body-2 text-grey-darken-2 mb-0">
              {{ isEs ? 'Hercules, Pinole, Crockett y Rodeo. Equipo de imprenta local con atención personalizada.' : 'Hercules, Pinole, Crockett, and Rodeo. Local print team with dedicated personal service.' }}
            </p>
          </div>

          <!-- Custom CTA Banner -->
          <v-sheet
            class="pa-8 pa-md-12 rounded-xl text-center text-white bg-black"
            elevation="6"
          >
            <h2 class="text-h4 font-weight-bold mb-4" style="line-height: 1.3;">
              {{ service.cta }}
            </h2>
            <p class="text-body-1 text-grey-lighten-2 mx-auto mb-8" style="max-width: 650px; line-height: 1.6;">
              {{ isEs ? 'Envíenos sus archivos de diseño o conversemos sobre sus especificaciones para entregarle una cotización rápida y competitiva.' : 'Send us your artwork or talk through your project specifications for a fast, competitive quote.' }}
            </p>

            <div class="d-flex flex-wrap justify-center ga-4">
              <v-btn
                color="white"
                size="x-large"
                :to="`${isEs ? '/es/contacto' : '/contact'}?service=${encodeURIComponent(service.contactServiceValue)}`"
                class="px-8 font-weight-bold text-black"
                elevation="3"
              >
                {{ isEs ? 'Solicitar Cotización de Impresión' : 'Request Print Quote' }}
              </v-btn>
              <v-btn
                variant="outlined"
                color="white"
                size="x-large"
                href="tel:4159374062"
                class="px-6"
              >
                <v-icon icon="mdi-phone" start></v-icon>
                {{ isEs ? 'Llamar al 415-937-4062' : 'Call 415-937-4062' }}
              </v-btn>
            </div>

            <div class="mt-6 text-caption text-grey-lighten-2">
              {{ isEs ? 'Horario de Atención: Lun - Vie: 9:00 AM - 6:00 PM | Correo: contact@herculesprintingpro.com' : 'Business Hours: Mon - Fri: 9:00 AM - 6:00 PM | Email: contact@herculesprintingpro.com' }}
            </div>
          </v-sheet>

        </v-col>
      </v-row>
    </v-container>
  </div>

  <!-- Fallback if service not found -->
  <v-container v-else class="py-16 text-center">
    <h1 class="text-h4 font-weight-bold mb-4">
      {{ isEs ? 'Servicio No Encontrado' : 'Service Not Found' }}
    </h1>
    <p class="text-body-1 text-grey-darken-1 mb-6">
      {{ isEs ? 'El servicio de impresión solicitado no pudo ser encontrado.' : 'The requested print service could not be found.' }}
    </p>
    <v-btn color="primary" :to="isEs ? '/es/servicios' : '/services'">
      {{ isEs ? 'Ver Todos los Servicios' : 'View All Services' }}
    </v-btn>
  </v-container>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useHead } from '@unhead/vue'
import { getServiceBySlug } from '../data/services'

const route = useRoute()
const isEs = computed(() => route.path.startsWith('/es'))
const service = computed(() => getServiceBySlug(route.params.slug, isEs.value ? 'es' : 'en'))

useHead({
  title: computed(() => service.value
    ? `${service.value.title} | Hercules Printing Pro`
    : (isEs.value ? 'Servicio | Hercules Printing Pro' : 'Service | Hercules Printing Pro')
  ),
  meta: [
    {
      name: 'description',
      content: computed(() => service.value
        ? `${service.value.shortDescription}. ${isEs.value ? 'Sirviendo a Hercules, Pinole, Crockett y Rodeo.' : 'Serving Hercules, Pinole, Crockett, and Rodeo.'}`
        : 'Hercules Printing Pro commercial printing services.'
      )
    },
    {
      property: 'og:title',
      content: computed(() => service.value ? `${service.value.title} | Hercules Printing Pro` : 'Hercules Printing Pro')
    },
    {
      property: 'og:description',
      content: computed(() => service.value ? service.value.shortDescription : '')
    },
    {
      property: 'og:url',
      content: computed(() => service.value
        ? `https://herculesprintingpro.com${isEs.value ? '/es/servicios/' : '/services/'}${service.value.slug}`
        : 'https://herculesprintingpro.com/services'
      )
    }
  ],
  link: computed(() => service.value ? [
    {
      rel: 'canonical',
      href: `https://herculesprintingpro.com${isEs.value ? '/es/servicios/' : '/services/'}${service.value.slug}`
    },
    {
      rel: 'alternate',
      hreflang: 'en',
      href: `https://herculesprintingpro.com/services/${service.value.slug}`
    },
    {
      rel: 'alternate',
      hreflang: 'es',
      href: `https://herculesprintingpro.com/es/servicios/${service.value.slug}`
    },
    {
      rel: 'alternate',
      hreflang: 'x-default',
      href: `https://herculesprintingpro.com/services/${service.value.slug}`
    }
  ] : [])
})
</script>

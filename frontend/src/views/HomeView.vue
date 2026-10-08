<template>
  <div>
    <!-- Hero Section -->
    <v-sheet class="bg-black text-white d-flex align-center py-12 py-md-16" elevation="0">
      <v-container>
        <v-row align="center" justify="center">
          <v-col cols="12" md="10" class="text-center">
            <img src="/src/assets/hercules.png" alt="Hercules Printing Pro Logo" class="hero-image mb-6">

            <h1 class="text-h5 text-md-h4 font-weight-bold mb-3 text-white" style="line-height: 1.3;">
              {{ isEs ? 'Su Socio de Impresión Comercial de Confianza en Hercules y el East Bay' : 'Your Trusted Commercial Printing Partner in Hercules & East Bay' }}
            </h1>

            <p class="text-body-1 text-md-h6 mb-8 text-grey-lighten-2 mx-auto" style="max-width: 820px; line-height: 1.6;">
              {{ isEs ? 'Impresión nítida CMYK, papeles prémium y entregas locales rápidas para negocios y eventos del East Bay - sin demoras ni portales anónimos.' : 'CMYK-sharp printing, premium stocks, and fast local turnarounds for East Bay businesses and events - without the wait or the impersonal web portals.' }}
            </p>

            <div class="d-flex flex-wrap justify-center ga-4">
              <v-btn
                color="white"
                size="x-large"
                :to="isEs ? '/es/contacto' : '/contact'"
                class="px-8 font-weight-bold text-black"
                elevation="3"
              >
                {{ isEs ? 'Solicitar una Cotización' : 'Request a Quote' }}
              </v-btn>
              <v-btn
                color="white"
                variant="outlined"
                size="x-large"
                :to="isEs ? '/es/servicios' : '/services'"
                class="px-8 font-weight-bold"
              >
                {{ isEs ? 'Explorar Servicios de Impresión' : 'Explore Print Services' }}
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>

    <!-- Services Overview Section -->
    <v-container class="py-16">
      <v-row justify="center">
        <v-col cols="12" md="10" class="text-center">
          <h2 class="text-h4 font-weight-bold mb-3">
            {{ isEs ? 'Servicios de Impresión Comercial' : 'Commercial Print Services' }}
          </h2>
          <v-divider class="mx-auto mb-4" width="100" thickness="4" color="primary"></v-divider>
          <p class="text-subtitle-1 text-grey-darken-1 mb-8" style="line-height: 1.6; font-size: 1.15rem;">
            {{ isEs ? 'Soluciones de impresión de alta precisión para comercios, corporativos y creadores de marcas en el East Bay' : 'High-precision print solutions for East Bay storefronts, corporate teams, and brand creators' }}
          </p>
        </v-col>
      </v-row>

      <!-- Services Grid -->
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
              <v-avatar color="primary" variant="flat" size="48" class="mr-3 text-white">
                <v-icon :icon="service.icon" color="white" size="26"></v-icon>
              </v-avatar>
              <h3 class="text-h6 font-weight-bold" style="line-height: 1.3;">
                {{ service.title }}
              </h3>
            </div>
            <p class="text-body-2 text-grey-darken-1 flex-grow-1" style="line-height: 1.6;">
              {{ service.shortDescription }}
            </p>
            <div class="mt-4 pt-3 border-t d-flex justify-space-between align-center">
              <v-btn
                variant="text"
                color="primary"
                :to="isEs ? `/es/servicios/${service.slug}` : `/services/${service.slug}`"
                density="compact"
                class="px-0 font-weight-bold"
              >
                {{ isEs ? 'Más Información' : 'Learn More' }}
                <v-icon icon="mdi-arrow-right" end size="18"></v-icon>
              </v-btn>

              <v-btn
                variant="tonal"
                color="primary"
                size="small"
                :to="`${isEs ? '/es/contacto' : '/contact'}?service=${encodeURIComponent(service.contactServiceValue)}`"
              >
                {{ isEs ? 'Cotizar' : 'Quote' }}
              </v-btn>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <!-- Local Footprint Callout -->
      <v-sheet
        class="mt-12 pa-8 pa-md-10 rounded-xl text-center text-white bg-black"
        elevation="4"
      >
        <v-icon icon="mdi-map-marker-radius" color="white" size="36" class="mb-3"></v-icon>
        <h3 class="text-h5 text-md-h4 font-weight-bold mb-2">
          {{ isEs ? 'Presencia Local en el East Bay' : 'East Bay Local Footprint' }}
        </h3>
        <p class="text-h6 font-weight-bold mb-3 text-grey-lighten-2">
          {{ isEs ? 'Servimos a Hercules, Pinole, Crockett y Rodeo.' : 'We serve Hercules, Pinole, Crockett, and Rodeo.' }}
        </p>
        <p class="text-body-1 text-grey-lighten-2 mx-auto mb-0" style="max-width: 650px; line-height: 1.6; font-size: 1.1rem;">
          {{ isEs ? 'Equipo de imprenta local. Entregas rápidas. Sin retrasos por envíos internacionales.' : 'Local print team. Fast local turnarounds. No overseas shipping delays.' }}
        </p>
      </v-sheet>
    </v-container>

    <!-- Differentiation Section -->
    <v-sheet class="bg-grey-lighten-4 py-16">
      <v-container>
        <v-row justify="center" class="text-center mb-12">
          <v-col cols="12" md="8">
            <h2 class="text-h4 font-weight-bold mb-3">
              {{ isEs ? 'La Diferencia Hercules Printing Pro' : 'The Hercules Printing Pro Difference' }}
            </h2>
            <v-divider class="mx-auto mb-4" width="80" thickness="3" color="primary"></v-divider>
            <p class="text-subtitle-1 text-grey-darken-1">
              {{ isEs ? 'Por qué los negocios del East Bay eligen imprimir con nosotros' : 'Why East Bay businesses trust us with their critical print projects' }}
            </p>
          </v-col>
        </v-row>

        <v-row>
          <v-col
            v-for="(diff, dIdx) in currentDifferentiators"
            :key="dIdx"
            cols="12"
            md="6"
            lg="3"
          >
            <v-card class="h-100 pa-6 text-center" elevation="0" color="white" border>
              <v-avatar color="primary" size="56" class="mb-4 text-white">
                <v-icon :icon="diff.icon" size="30"></v-icon>
              </v-avatar>
              <h3 class="text-h6 font-weight-bold mb-3" style="line-height: 1.3;">
                {{ diff.title }}
              </h3>
              <p class="text-body-2 text-grey-darken-1" style="line-height: 1.6;">
                {{ diff.description }}
              </p>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>

    <!-- About Section -->
    <v-container class="py-16">
      <v-row justify="center">
        <v-col cols="12" md="10" lg="8" class="text-center">
          <h2 class="text-h4 font-weight-bold mb-3">
            {{ isEs ? 'Arraigados en la Precisión y Nuestra Comunidad' : 'Rooted in Precision and Our Community' }}
          </h2>
          <v-divider class="mx-auto mb-6" width="80" thickness="3" color="primary"></v-divider>

          <p class="text-body-1 text-grey-darken-2 mb-6" style="line-height: 1.85; font-size: 1.15rem;">
            {{ isEs ? 'Antes de que Hercules fuera una próspera comunidad junto a la bahía, era reconocida mundialmente por su industria, poder e impacto. Creemos que su negocio merece esa misma presencia inolvidable. Ya sea entregando una tarjeta prémium a un socio local en el East Bay o vistiendo a su equipo con uniformes de calidad, entregamos soluciones de impresión CMYK de alto calibre diseñadas para destacar.' : 'Before Hercules, California was a thriving modern community on the waterfront, it was a town known worldwide for its industry, power, and impact. We believe your business deserves that same unforgettable presence. Whether you are handing a premium card to a local partner in the East Bay or launching a brand across the country, we deliver the high-caliber, CMYK-sharp print solutions you need to stand out.' }}
          </p>

          <v-card class="pa-4 mb-6 bg-grey-lighten-4 border rounded" elevation="0">
            <p class="text-body-2 font-weight-bold text-grey-darken-3 mb-0">
              {{ isEs ? 'Somos un equipo local y arraigado en la comunidad que responde y respalda su trabajo.' : 'We are a local, community-rooted team that shows up and stands behind our work.' }}
            </p>
          </v-card>

          <div class="mt-8">
            <v-btn
              color="primary"
              variant="outlined"
              size="large"
              :to="isEs ? '/es/nosotros' : '/about'"
              class="px-8 font-weight-bold"
            >
              {{ isEs ? 'Conozca Nuestra Historia' : 'Read Our Full Story' }}
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>

    <!-- Contact Section (Visible on page) -->
    <v-sheet class="py-16 bg-black text-white">
      <v-container>
        <v-row justify="center">
          <v-col cols="12" md="10" class="text-center">
            <h2 class="text-h4 font-weight-bold mb-3">
              {{ isEs ? 'Póngase en Contacto' : 'Get In Touch' }}
            </h2>
            <p class="text-body-1 text-grey-lighten-2 mx-auto mb-10" style="max-width: 650px; line-height: 1.6; font-size: 1.15rem;">
              {{ isEs ? '¿Necesita tarjetas de presentación, lonas, uniformes o material para eventos? Estamos aquí para servirle.' : 'Need business cards, banners, apparel, or event marketing materials? We are here to help.' }}
            </p>

            <!-- Direct Contact Detail Cards -->
            <v-row class="mb-10 text-left">
              <v-col cols="12" sm="6" md="3">
                <v-card class="pa-5 h-100 bg-grey-darken-4 border text-center" elevation="0">
                  <v-icon icon="mdi-phone" color="white" size="32" class="mb-2"></v-icon>
                  <div class="text-caption text-grey-lighten-1 mb-1 font-weight-bold">
                    {{ isEs ? 'TELÉFONO' : 'PHONE' }}
                  </div>
                  <a href="tel:4159374062" class="text-decoration-none text-white font-weight-bold text-body-1">
                    415-937-4062
                  </a>
                </v-card>
              </v-col>

              <v-col cols="12" sm="6" md="3">
                <v-card class="pa-5 h-100 bg-grey-darken-4 border text-center" elevation="0">
                  <v-icon icon="mdi-email" color="white" size="32" class="mb-2"></v-icon>
                  <div class="text-caption text-grey-lighten-1 mb-1 font-weight-bold">
                    {{ isEs ? 'CORREO' : 'EMAIL' }}
                  </div>
                  <a href="mailto:contact@herculesprintingpro.com" class="text-decoration-none text-white font-weight-bold text-body-2" style="word-break: break-all;">
                    contact@herculesprintingpro.com
                  </a>
                </v-card>
              </v-col>

              <v-col cols="12" sm="6" md="3">
                <v-card class="pa-5 h-100 bg-grey-darken-4 border text-center" elevation="0">
                  <v-icon icon="mdi-map-marker" color="white" size="32" class="mb-2"></v-icon>
                  <div class="text-caption text-grey-lighten-1 mb-1 font-weight-bold">
                    {{ isEs ? 'UBICACIÓN' : 'LOCATION' }}
                  </div>
                  <div class="text-white font-weight-bold text-body-2">
                    Hercules, CA
                  </div>
                  <div class="text-caption text-grey-lighten-2">
                    West Contra Costa County
                  </div>
                </v-card>
              </v-col>

              <v-col cols="12" sm="6" md="3">
                <v-card class="pa-5 h-100 bg-grey-darken-4 border text-center" elevation="0">
                  <v-icon icon="mdi-clock-outline" color="white" size="32" class="mb-2"></v-icon>
                  <div class="text-caption text-grey-lighten-1 mb-1 font-weight-bold">
                    {{ isEs ? 'HORARIO' : 'HOURS' }}
                  </div>
                  <div class="text-white font-weight-bold text-body-2">
                    {{ isEs ? 'Lun - Vie: 9am - 6pm' : 'Mon - Fri: 9am - 6pm' }}
                  </div>
                  <div class="text-caption text-grey-lighten-2">
                    {{ isEs ? 'Fines de semana con cita previa' : 'Weekend by appointment' }}
                  </div>
                </v-card>
              </v-col>
            </v-row>

            <v-btn
              color="white"
              size="x-large"
              :to="isEs ? '/es/contacto' : '/contact'"
              class="px-10 font-weight-bold text-black"
              elevation="4"
            >
              {{ isEs ? 'Solicitar una Cotización' : 'Request a Quote' }}
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>
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
    ? 'Hercules Printing Pro | Imprenta Comercial en Hercules y East Bay'
    : 'Hercules Printing Pro | Commercial Printing in Hercules & East Bay'
  ),
  meta: [
    {
      name: 'description',
      content: computed(() => isEs.value
        ? 'Impresión comercial prémium en Hercules, CA. Tarjetas de presentación, lonas, folletos, serigrafía, bordado y gran formato para el East Bay.'
        : 'Premium commercial printing in Hercules, CA. Business cards, vinyl banners, brochures, apparel, stickers, and large format printing for the East Bay.'
      )
    },
    {
      property: 'og:title',
      content: computed(() => isEs.value
        ? 'Hercules Printing Pro | Imprenta Comercial'
        : 'Hercules Printing Pro | Commercial Printing'
      )
    },
    {
      property: 'og:description',
      content: computed(() => isEs.value
        ? 'Precisión, calidad y rapidez en impresión comercial para negocios y eventos del East Bay.'
        : 'Precision, quality, and speed in commercial printing for East Bay businesses and events.'
      )
    },
    {
      property: 'og:url',
      content: computed(() => isEs.value ? 'https://herculesprintingpro.com/es' : 'https://herculesprintingpro.com/')
    }
  ],
  link: [
    {
      rel: 'canonical',
      href: computed(() => isEs.value ? 'https://herculesprintingpro.com/es' : 'https://herculesprintingpro.com/')
    },
    {
      rel: 'alternate',
      hreflang: 'en',
      href: 'https://herculesprintingpro.com/'
    },
    {
      rel: 'alternate',
      hreflang: 'es',
      href: 'https://herculesprintingpro.com/es'
    },
    {
      rel: 'alternate',
      hreflang: 'x-default',
      href: 'https://herculesprintingpro.com/'
    }
  ]
})

const currentDifferentiators = computed(() => {
  if (isEs.value) {
    return [
      {
        title: 'Precisión CMYK y Calidad Táctil',
        icon: 'mdi-palette-swatch-outline',
        description: 'Calibración de color ultra nítida, papeles de lujo y acabados especiales que causan una impresión inolvidable.'
      },
      {
        title: 'Locales y Puntuales',
        icon: 'mdi-truck-fast-outline',
        description: 'Recoja localmente o reciba entrega rápida en Hercules y West Contra Costa County. Personas reales que revisan sus archivos.'
      },
      {
        title: 'Revisión Profesional de Archivos',
        icon: 'mdi-checkbox-marked-circle-outline',
        description: 'Sin sorpresas de pixelado o cambios de color. Inspeccionamos rebase, resolución y perfiles antes de prensa.'
      },
      {
        title: 'Integración de Imprenta y Tecnología',
        icon: 'mdi-qrcode-scan',
        description: 'Coordinado con Hercules Tech Solutions. Unifique su sitio web, códigos QR y material impreso bajo el mismo techo.'
      }
    ]
  }

  return [
    {
      title: 'CMYK Precision & Tactile Quality',
      icon: 'mdi-palette-swatch-outline',
      description: 'Ultra-crisp color calibration, luxury paper stocks, and tactile finishes that make an unforgettable impression.'
    },
    {
      title: 'Local & On Time',
      icon: 'mdi-truck-fast-outline',
      description: 'Pick up locally or get fast local delivery in Hercules and West Contra Costa County. Real humans who check your proofs.'
    },
    {
      title: 'Proofing Perfection',
      icon: 'mdi-checkbox-marked-circle-outline',
      description: 'No surprise pixelation or color shifts. We inspect your bleed, resolution, and color profiles to guarantee flawless output.'
    },
    {
      title: 'Print + Tech Integration',
      icon: 'mdi-qrcode-scan',
      description: 'Coordinated directly with Hercules Tech Solutions. Get your website, QR systems, and printed collateral aligned under one roof.'
    }
  ]
})
</script>

<style scoped>
.hero-image {
  width: 100%;
  max-width: 900px;
  height: auto;
}
</style>
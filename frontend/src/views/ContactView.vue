<template>
  <v-container class="py-12">
    <v-row justify="center">
      <v-col cols="12" md="10" lg="8">
        <h1 class="text-h3 font-weight-bold mb-3">
          {{ isEs ? 'Contactar a Hercules Printing Pro' : 'Contact Hercules Printing Pro' }}
        </h1>
        <p class="text-subtitle-1 text-grey-darken-1 mb-8" style="line-height: 1.6;">
          {{ isEs ? 'Solicite una cotización de impresión comercial o haga una pregunta. Nuestro equipo local le responderá a la brevedad.' : 'Request a commercial print quote or ask a question. Our local team will get back to you promptly.' }}
        </p>

        <!-- Direct Contact Info Banner -->
        <v-card class="pa-6 mb-8 border" elevation="0" style="background-color: #FAFAFA; border-left: 6px solid #000000 !important;">
          <v-row align="center">
            <v-col cols="12" sm="6" md="3">
              <div class="d-flex align-center ga-2 mb-1">
                <v-icon icon="mdi-phone" color="black" size="20"></v-icon>
                <span class="text-caption font-weight-bold text-grey-darken-2">
                  {{ isEs ? 'LLAMAR O TEXTO' : 'CALL OR TEXT' }}
                </span>
              </div>
              <a href="tel:4159374062" class="text-decoration-none text-grey-darken-4 font-weight-bold text-body-1">
                415-937-4062
              </a>
            </v-col>

            <v-col cols="12" sm="6" md="3">
              <div class="d-flex align-center ga-2 mb-1">
                <v-icon icon="mdi-email" color="black" size="20"></v-icon>
                <span class="text-caption font-weight-bold text-grey-darken-2">
                  {{ isEs ? 'CORREO' : 'EMAIL US' }}
                </span>
              </div>
              <a href="mailto:contact@herculesprintingpro.com" class="text-decoration-none text-grey-darken-4 font-weight-bold text-body-2" style="word-break: break-all;">
                contact@herculesprintingpro.com
              </a>
            </v-col>

            <v-col cols="12" sm="6" md="3">
              <div class="d-flex align-center ga-2 mb-1">
                <v-icon icon="mdi-map-marker" color="black" size="20"></v-icon>
                <span class="text-caption font-weight-bold text-grey-darken-2">
                  {{ isEs ? 'UBICACIÓN' : 'LOCATION' }}
                </span>
              </div>
              <div class="text-grey-darken-4 font-weight-bold text-body-2">
                Hercules, CA
              </div>
              <div class="text-caption text-grey">
                {{ isEs ? 'Sirviendo a Pinole, Crockett y Rodeo' : 'Serving Pinole, Crockett & Rodeo' }}
              </div>
            </v-col>

            <v-col cols="12" sm="6" md="3">
              <div class="d-flex align-center ga-2 mb-1">
                <v-icon icon="mdi-clock-outline" color="black" size="20"></v-icon>
                <span class="text-caption font-weight-bold text-grey-darken-2">
                  {{ isEs ? 'HORARIO' : 'HOURS' }}
                </span>
              </div>
              <div class="text-grey-darken-4 font-weight-bold text-body-2">
                {{ isEs ? 'Lun - Vie: 9am - 6pm' : 'Mon - Fri: 9am - 6pm' }}
              </div>
              <div class="text-caption text-grey">
                {{ isEs ? 'Fines de semana con cita' : 'Weekends by appointment' }}
              </div>
            </v-col>
          </v-row>
        </v-card>

        <v-form @submit.prevent="submitForm" ref="contactForm">
          <v-text-field
            v-model="form.name"
            :label="isEs ? 'Nombre Completo' : 'Full Name'"
            :placeholder="isEs ? 'Ingrese su nombre completo' : 'Enter your full name'"
            required
            variant="outlined"
            class="mb-3"
          ></v-text-field>

          <v-text-field
            v-model="form.email"
            :label="isEs ? 'Correo Electrónico' : 'Email Address'"
            :placeholder="isEs ? 'Ingrese su correo electrónico' : 'Enter your email address'"
            type="email"
            required
            variant="outlined"
            class="mb-3"
          ></v-text-field>

          <v-select
            v-model="form.service"
            :items="servicesList"
            :label="isEs ? 'Servicio de Impresión Solicitado' : 'Print Service Requested'"
            :placeholder="isEs ? 'Seleccione un servicio de impresión' : 'Select a print service'"
            required
            variant="outlined"
            class="mb-3"
          ></v-select>

          <v-textarea
            v-model="form.message"
            :label="isEs ? 'Detalles del Proyecto y Cantidades' : 'Project Details & Quantities'"
            :placeholder="isEs ? 'Describa su proyecto, medidas deseadas, cantidades estimadas y acabados...' : 'Describe your project, desired dimensions, estimated quantities, and finish preferences...'"
            rows="5"
            variant="outlined"
            class="mb-6"
          ></v-textarea>

          <v-card class="bg-grey-lighten-4 pa-4 mb-8 text-center" border elevation="0">
            <div class="d-flex justify-center">
              <Checkbox
                v-model="form.captchaToken"
                @success="onCaptchaSuccess"
                @expired="onCaptchaExpired"
                @error="onCaptchaError"
              ></Checkbox>
            </div>

            <!-- Status tracking blocks -->
            <v-alert
              v-if="captchaStatus === 'error'"
              type="error"
              variant="tonal"
              density="compact"
              class="mt-3 text-left"
            >
              {{ captchaErrorMessage || (isEs ? 'El desafío de seguridad no pudo cargarse. Por favor recargue la página.' : 'Verification challenge failed to load. Please refresh the page.') }}
            </v-alert>

            <v-alert
              v-else-if="captchaStatus === 'expired'"
              type="warning"
              variant="tonal"
              density="compact"
              class="mt-3 text-left"
            >
              {{ isEs ? 'La verificación ha expirado. Por favor marque la casilla nuevamente.' : 'Verification expired. Please re-check the box above.' }}
            </v-alert>

            <div
              v-else-if="captchaStatus === 'verified' && form.captchaToken"
              class="text-caption text-success mt-2 d-flex align-center justify-center ga-1 font-weight-medium"
            >
              <v-icon icon="mdi-shield-check" size="18" color="success"></v-icon>
              <span>{{ isEs ? 'Verificación completada' : 'Verification complete' }}</span>
            </div>
          </v-card>

          <v-btn
            type="submit"
            color="primary"
            block
            size="x-large"
            elevation="2"
            class="font-weight-bold text-white"
            :loading="isSubmitting"
            :disabled="isSubmitting"
          >
            {{ isEs ? 'Enviar Solicitud de Cotización' : 'Send Quote Request' }}
          </v-btn>
        </v-form>

        <v-snackbar
          v-model="toast.show"
          :color="toast.color"
          :timeout="4500"
          location="bottom"
        >
          {{ toast.message }}
        </v-snackbar>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { computed, onMounted, reactive, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useHead } from '@unhead/vue'
import { Checkbox } from 'vue-recaptcha'

const route = useRoute()
const isEs = computed(() => route.path.startsWith('/es'))

useHead({
  title: computed(() => isEs.value
    ? 'Cotizaciones y Contacto | Hercules Printing Pro'
    : 'Request a Quote & Contact | Hercules Printing Pro'
  ),
  meta: [
    {
      name: 'description',
      content: computed(() => isEs.value
        ? 'Solicite una cotización de impresión comercial en Hercules, CA. Llame al 415-937-4062 o envíe sus especificaciones en línea.'
        : 'Request a commercial print quote in Hercules, CA. Call 415-937-4062 or submit project specifications online for fast turnarounds.'
      )
    },
    {
      property: 'og:title',
      content: computed(() => isEs.value ? 'Cotizaciones | Hercules Printing Pro' : 'Contact | Hercules Printing Pro')
    },
    {
      property: 'og:url',
      content: computed(() => isEs.value ? 'https://herculesprintingpro.com/es/contacto' : 'https://herculesprintingpro.com/contact')
    }
  ],
  link: [
    {
      rel: 'canonical',
      href: computed(() => isEs.value ? 'https://herculesprintingpro.com/es/contacto' : 'https://herculesprintingpro.com/contact')
    },
    {
      rel: 'alternate',
      hreflang: 'en',
      href: 'https://herculesprintingpro.com/contact'
    },
    {
      rel: 'alternate',
      hreflang: 'es',
      href: 'https://herculesprintingpro.com/es/contacto'
    },
    {
      rel: 'alternate',
      hreflang: 'x-default',
      href: 'https://herculesprintingpro.com/contact'
    }
  ]
})

const contactForm = ref(null)
const isSubmitting = ref(false)
const captchaStatus = ref('idle')
const captchaErrorMessage = ref('')

const toast = reactive({
  show: false,
  message: '',
  color: 'success'
})

const apiBaseUrl = (import.meta.env.VITE_BACKEND_URL || window.location.origin).replace(/\/$/, '')

const form = reactive({
  name: '',
  email: '',
  service: null,
  message: '',
  captchaToken: ''
})

const servicesEn = [
  'Business Cards',
  'Banners & Signage',
  'Flyers & Brochures',
  'Large Format Printing',
  'Custom Apparel',
  'Stickers & Product Labels',
  'Direct Mail & EDDM',
  'Promotional Products',
  'Tech + Print Integration',
  'Other Print Request'
]

const servicesEs = [
  'Tarjetas de Presentación',
  'Lonas y Señalética',
  'Folletos y Volantes',
  'Gran Formato y Pósters',
  'Ropa Personalizada y Uniformes',
  'Calcomanías y Etiquetas',
  'Correo Directo y EDDM',
  'Artículos Promocionales',
  'Integración de Imprenta y Tecnología',
  'Otra Solicitud de Impresión'
]

const servicesList = computed(() => (isEs.value ? servicesEs : servicesEn))

const matchAndSetService = () => {
  if (route.query.service) {
    const queryService = String(route.query.service).toLowerCase().trim()
    const currentList = servicesList.value

    let found = currentList.find(
      s => s.toLowerCase() === queryService || s.toLowerCase().includes(queryService)
    )

    if (!found) {
      const otherList = isEs.value ? servicesEn : servicesEs
      const otherIndex = otherList.findIndex(
        s => s.toLowerCase() === queryService || s.toLowerCase().includes(queryService)
      )
      if (otherIndex !== -1) {
        found = currentList[otherIndex]
      }
    }

    if (found) {
      form.service = found
    }
  }
}

onMounted(() => {
  matchAndSetService()
})

watch(() => route.query.service, () => {
  matchAndSetService()
})

watch(isEs, () => {
  if (form.service) {
    const fromList = isEs.value ? servicesEn : servicesEs
    const toList = isEs.value ? servicesEs : servicesEn
    const idx = fromList.indexOf(form.service)
    if (idx !== -1) {
      form.service = toList[idx]
    }
  }
})

const onCaptchaSuccess = (token) => {
  form.captchaToken = token
  captchaStatus.value = 'verified'
  captchaErrorMessage.value = ''
}

const onCaptchaExpired = () => {
  form.captchaToken = ''
  captchaStatus.value = 'expired'
}

const onCaptchaError = (err) => {
  form.captchaToken = ''
  captchaStatus.value = 'error'
  captchaErrorMessage.value = isEs.value
    ? 'La verificación de seguridad no pudo cargarse. Por favor recargue o revise su conexión.'
    : 'Security verification failed to load. Please reload or check your connection.'
  console.error('reCAPTCHA error:', err)
}

const showToast = (message, color = 'success') => {
  toast.message = message
  toast.color = color
  toast.show = true
}

const submitForm = async () => {
  if (!form.captchaToken) {
    showToast(
      isEs.value ? 'Por favor complete el captcha de verificación.' : 'Please complete the verification captcha.',
      'warning'
    )
    return
  }

  isSubmitting.value = true

  try {
    const response = await fetch(`${apiBaseUrl}/api/contact`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        name: form.name,
        email: form.email,
        service: form.service,
        message: form.message,
        captchaToken: form.captchaToken
      })
    })

    const data = await response.json().catch(() => ({}))

    if (!response.ok) {
      throw new Error(data.message || (isEs.value ? 'Error al enviar la cotización.' : 'Failed to submit quote request.'))
    }

    showToast(
      isEs.value
        ? '¡Gracias! Su solicitud de cotización ha sido enviada a nuestro equipo local.'
        : (data.message || 'Thank you! Your quote request has been sent to our local team.'),
      'success'
    )

    form.name = ''
    form.email = ''
    form.service = null
    form.message = ''
    form.captchaToken = ''
    captchaStatus.value = 'idle'
  } catch (error) {
    console.error(error)
    showToast(
      isEs.value
        ? 'No pudimos enviar su solicitud en este momento. Por favor intente de nuevo en unos momentos.'
        : (error.message || 'We could not send your request right now. Please try again shortly.'),
      'error'
    )
  } finally {
    isSubmitting.value = false
  }
}
</script>

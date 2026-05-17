import { createApp } from 'vue'
import { createHead } from '@unhead/vue/client'
import '@mdi/font/css/materialdesignicons.css'
import './style.css'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { VueRecaptchaPlugin } from 'vue-recaptcha'

const app = createApp(App)
const head = createHead()

app.use(head)
app.use(router)
app.use(vuetify)
app.use(VueRecaptchaPlugin, {
  v2SiteKey: import.meta.env.VITE_RECAPTCHA_SITE_KEY,
})

app.mount('#app')

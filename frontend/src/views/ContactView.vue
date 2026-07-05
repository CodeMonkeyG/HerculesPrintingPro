<template>
  <v-container class='py-12'>
    <v-row justify='center'>
      <v-col cols='12' md='6'>
        <h1 class='text-h3 font-weight-bold mb-4'>Contact Us</h1>
        <p class='text-subtitle-1 text-grey-darken-1 mb-10'>
          Request a quote or ask us a question. Our team will get back to you as soon as possible.
        </p>

        <v-form @submit.prevent='submitForm' ref='contactForm'>
          <v-text-field
            v-model='form.name'
            label='Full Name'
            placeholder='Enter your full name'
            required
            variant='outlined'
            class='mb-2'
          ></v-text-field>

          <v-text-field
            v-model='form.email'
            label='Email Address'
            placeholder='Enter your email address'
            type='email'
            required
            variant='outlined'
            class='mb-2'
          ></v-text-field>

          <v-select
            v-model='form.service'
            :items='services'
            label='Service Requested'
            placeholder='Select a service'
            required
            variant='outlined'
            class='mb-2'
          ></v-select>

          <v-textarea
            v-model='form.message'
            label='Project Details'
            placeholder='Tell us about your project...'
            rows='5'
            variant='outlined'
            class='mb-6'
          ></v-textarea>

          <v-card class='bg-grey-lighten-4 pa-4 mb-8' border elevation='0'>
            <Checkbox
              v-model='form.captchaToken'
              @expired='onExpired'
            ></Checkbox>
          </v-card>

          <v-btn
            type='submit'
            color='primary'
            block
            size='x-large'
            elevation='2'
            :loading='isSubmitting'
            :disabled='isSubmitting'
          >
            Send Quote Request
          </v-btn>
        </v-form>

        <v-snackbar
          v-model='toast.show'
          :color='toast.color'
          :timeout='4500'
          location='bottom'
        >
          {{ toast.message }}
        </v-snackbar>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { Checkbox } from 'vue-recaptcha';

const contactForm = ref(null);
const isSubmitting = ref(false);
const toast = reactive({
  show: false,
  message: '',
  color: 'success'
});

const apiBaseUrl = (import.meta.env.VITE_BACKEND_URL || window.location.origin).replace(/\/$/, '');

const form = reactive({
  name: '',
  email: '',
  service: null,
  message: '',
  captchaToken: ''
});

const services = [
  'Business Cards',
  'Banners & Signage',
  'Flyers & Brochures',
  'Large Format Printing',
  'Custom Apparel',
  'Other'
];

const onExpired = () => {
  form.captchaToken = '';
};

const showToast = (message, color = 'success') => {
  toast.message = message;
  toast.color = color;
  toast.show = true;
};

const submitForm = async () => {
  if (!form.captchaToken) {
    showToast('Please complete the captcha.', 'warning');
    return;
  }

  isSubmitting.value = true;

  try {
    const response = await fetch(`${apiBaseUrl}/api/contact`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        name: form.name,
        email: form.email,
        service: form.service,
        message: form.message,
        captchaToken: form.captchaToken
      })
    });

    if (!response.ok) {
      throw new Error('Failed to submit contact form.');
    }

    showToast('Thank you! Your quote request has been sent.', 'success');

    form.name = '';
    form.email = '';
    form.service = null;
    form.message = '';
    form.captchaToken = '';
  } catch (error) {
    console.error(error);
    showToast('We could not send your request right now. Please try again shortly.', 'error');
  } finally {
    isSubmitting.value = false;
  }
};
</script>

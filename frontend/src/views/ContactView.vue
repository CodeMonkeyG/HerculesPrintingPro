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
              @verify='onVerify'
              @expired='onExpired'
            ></Checkbox>
          </v-card>

          <v-btn
            type='submit'
            color='primary'
            block
            size='x-large'
            elevation='2'
          >
            Send Quote Request
          </v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { Checkbox } from 'vue-recaptcha';

const contactForm = ref(null);

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

const onVerify = (response) => {
  form.captchaToken = response;
};

const onExpired = () => {
  form.captchaToken = '';
};

const submitForm = () => {
  if (!form.captchaToken) {
    alert('Please complete the captcha.');
    return;
  }
  console.log('Form Submitted:', form);
  alert('Thank you! Your quote request has been sent.');
};
</script>

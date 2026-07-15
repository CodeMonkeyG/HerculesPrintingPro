<template>
  <v-app>
    <v-app-bar color='primary' elevation='4' :height="xs ? 112 : 64">
      <v-container :class="['d-flex align-center', xs ? 'flex-column justify-center py-2' : 'justify-space-between']" fluid class="px-4 py-0">
        <div
          class='font-weight-bold text-uppercase text-center text-sm-left'
          :style="{
            letterSpacing: '2px',
            fontSize: xs ? '1.1rem' : '1.25rem',
            width: xs ? '100%' : 'auto',
            marginBottom: xs ? '8px' : '0'
          }"
        >
          Hercules Printing Pro
        </div>

        <div :class="['d-flex align-center', xs ? 'w-100 justify-space-between' : '']">
          <v-btn variant='text' to='/' class='mx-1' :class="{ 'flex-grow-1': xs }">Home</v-btn>
          <v-btn variant='text' to='/about' class='mx-1' :class="{ 'flex-grow-1': xs }">About</v-btn>
          <v-btn variant='text' to='/contact' class='mx-1' :class="{ 'flex-grow-1': xs }">Contact</v-btn>
        </div>
      </v-container>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>

    <v-footer class='bg-grey-lighten-4 py-8 mt-12'>
      <v-container class='text-center'>
        <p class='text-body-2 text-grey-darken-1'>
          &copy; {{ new Date().getFullYear() }} Hercules Printing Pro. All rights reserved.
        </p>
      </v-container>
    </v-footer>
  </v-app>
</template>

<script setup>
import { useDisplay } from 'vuetify'
import { useRecaptchaProvider } from 'vue-recaptcha';

useRecaptchaProvider();
const { xs } = useDisplay()
</script>

<style>
/* Global overrides can go here, but Vuetify handles most styling */
body {
  margin: 0;
}
</style>

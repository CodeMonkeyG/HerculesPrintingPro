<template>
  <v-app>
    <v-app-bar color='primary' elevation='4'>
      <v-container class='d-flex align-center'>
        <v-app-bar-title class='font-weight-bold text-uppercase' style='letter-spacing: 2px;'>
          Hercules Printing Pro
        </v-app-bar-title>

        <v-spacer></v-spacer>

        <v-btn variant='text' to='/' class='mx-1'>Home</v-btn>
        <v-btn variant='text' to='/about' class='mx-1'>About</v-btn>
        <v-btn variant='text' to='/contact' class='mx-1'>Contact</v-btn>
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
import { useRecaptchaProvider } from 'vue-recaptcha';
useRecaptchaProvider();
</script>

<style>
/* Global overrides can go here, but Vuetify handles most styling */
body {
  margin: 0;
}
</style>

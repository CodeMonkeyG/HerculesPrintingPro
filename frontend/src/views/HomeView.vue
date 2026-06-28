<template>
  <v-sheet class='bg-black text-white d-flex align-center' elevation='0'>
    <v-container class='py-6 py-md-0'>
      <v-row align='center' justify='center'>
        <v-col cols='12' md='10' class='text-center'>
          <img src="/src/assets/hercules.png" alt="Hercules Printing Pro Logo" class="hero-image">
          <p class='text-h5 mb-8 text-grey-lighten-1'>
            Precision. Quality. Speed.
          </p>
          <p class='text-h5 mb-8 text-grey-lighten-1'>
            <v-btn color='white' variant='outlined' size='x-large' to='/contact' class='px-8'>
              Request a Quote
            </v-btn>
          </p>
        </v-col>
      </v-row>
    </v-container>
  </v-sheet>
  <v-container class='py-16'>
    <v-row justify='center'>
      <v-col cols='12' md='8' class='text-center'>
        <h2 class='text-h4 font-weight-bold mb-6'>Your Local Partner in Professional Printing</h2>
        <v-divider class='mx-auto mb-6' width='100' thickness='4' color='primary'></v-divider>
        <p class='text-body-1 text-grey-darken-1' style='line-height: 1.8;'>
          Before Hercules, California was a thriving modern community on the waterfront, it was a town known worldwide for its industry, power, and impact. We believe your business deserves that same unforgettable presence. Whether you are handing a premium card to a local partner in the East Bay or launching a brand across the country, we deliver the high-caliber, CMYK-sharp print solutions you need to stand out. From tactile, luxury stocks to sleek modern finishes, we help local entrepreneurs turn brief handshakes into lasting connections. Build your card today and leave your mark.
        </p>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.hero-image {
  width: 100%;
  max-width: 1200px;
  height: auto;
}
</style>
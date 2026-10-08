<template>
  <v-container class="py-12">
    <v-row justify="center">
      <v-col cols="12" md="8">
        <h1 class="text-h3 font-weight-bold mb-4">
          {{ isEs ? 'Acerca de Hercules Printing Pro' : 'About Hercules Printing Pro' }}
        </h1>
        <div class="d-flex align-center mb-8">
          <v-divider class="mr-4" width="60" thickness="4" color="primary"></v-divider>
          <span class="text-subtitle-1 font-weight-medium text-grey-darken-3">
            {{ isEs ? 'Precisión de Nivel Empresarial, Calidad de Marcas de Lujo, Presencia Local.' : 'Enterprise Precision, Luxury Brand Quality, Local Presence.' }}
          </span>
        </div>

        <!-- English Story -->
        <template v-if="!isEs">
          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Our founder packed up and moved across the country for one specific reason: to immerse himself in the raw, relentless energy of the Bay Area startup scene. He wanted to be right where the future was being built, surrounded by the hustle, the late nights, and the sharp minds pushing the boundaries of what was possible. It was a baptism by fire in rapid scaling, agile execution, and the vital importance of making every single connection count from day one.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            That drive quickly pushed him into collaboration with some of the most recognized organizations in the world. Over the years, he had the privilege of architecting systems, deploying technology infrastructure, and solving complex problems for global titans from media powerhouses like Scripps and Turner to logistics networks like UPS and KLM, and retail giants like Walmart. He learned firsthand how the world's most successful operations organize their data and scale their reach.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Technology, however, is only half the equation; presentation, branding, and tactile quality are the other. Working alongside iconic luxury houses like Prada and Chanel, and fast-paced, elite environments like Formula 1, taught him an entirely different discipline: the absolute pursuit of perfection. At that level, there is no room for shortcuts. Every pixel, every color calibration, and every tactile finish must be flawless, because a brand's entire reputation is judged by the precision of its execution.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            His experience extended deep into ultra-luxury hospitality, where he spent years writing custom software and building technology resources to match Forbes 5-Star service standards. Collaborating closely with industry legends like the visionary builder of the Ritz-Carlton experience as well as SaaS growth pioneers, he learned that true excellence is not just about a product. It is about an obsessive attention to detail, a seamless user experience, and a relentless focus on anticipating a client's needs before they even voice them.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            After years of building for corporate giants and luxury empires, he looked around his local community here in Hercules and saw an opportunity to bring that exact same elite standard home. He believed that small businesses, local entrepreneurs, and Bay Area organizations should not have to settle for cheap, automated print portals that treat them like a number. He wanted to give local brands the same technological precision and premium design execution used by the Fortune 500, delivered with the care of a trusted neighbor.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            That is why Hercules Printing Pro was established. By combining cutting-edge infrastructure with a commitment to premium materials and the highest levels of service, Hercules Printing Pro provides a print experience that bridges the physical and digital worlds seamlessly. We utilize top-tier CMYK printing to ensure your cards aren't just handed out. They are remembered.
          </p>

          <p class="text-body-1 mb-8 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            We combine elite enterprise-level precision with meticulous standards to deliver flawless, fast local turnarounds with a deeply personal touch.
          </p>
        </template>

        <!-- Spanish Story -->
        <template v-else>
          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Nuestro fundador empacó sus pertenencias y cruzó el país por una razón muy clara: sumergirse en la energía incansable del ecosistema de empresas emergentes del Área de la Bahía. Quería estar exactamente donde se estaba construyendo el futuro, rodeado del esfuerzo, las largas noches de trabajo y las mentes brillantes que desafían los límites de lo posible. Fue un aprendizaje acelerado en escalabilidad, ejecución ágil y la importancia vital de hacer que cada conexión cuente desde el primer día.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Esa determinación rápidamente lo llevó a colaborar con algunas de las organizaciones más reconocidas del planeta. Con los años, tuvo el privilegio de diseñar sistemas, implementar infraestructura tecnológica y resolver complejos desafíos para líderes globales, desde motores de medios como Scripps y Turner, hasta redes logísticas como UPS y KLM, y gigantes del comercio minorista como Walmart. Aprendió de primera mano cómo las operaciones más exitosas del mundo escalan su impacto.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            La tecnología, sin embargo, es solo una parte de la ecuación; la presentación, la identidad de marca y la calidad táctil son la otra. Trabajar junto a casas de lujo icónicas como Prada y Chanel, y en entornos de alto rendimiento como la Fórmula 1, le enseñó una disciplina completamente diferente: la búsqueda absoluta de la perfección. En ese nivel no hay espacio para atajos. Cada píxel, cada calibración de color y cada acabado táctil debe ser impecable, porque la reputación de una marca se juzga por la precisión de su ejecución.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Su experiencia se profundizó aún más en la hospitalidad de ultralujo, cumpliendo con los exigentes estándares de servicio 5 Estrellas de Forbes. Al colaborar con leyendas de la industria, como el visionario creador de la experiencia Ritz-Carlton, comprendió que la verdadera excelencia no es solo un producto. Se trata de una atención obsesiva al detalle y una dedicación constante por anticipar las necesidades del cliente.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Después de años de construir para corporaciones globales e imperios del lujo, miró a su alrededor en su propia comunidad aquí en Hercules y vio la oportunidad de traer ese mismo estándar de élite a casa. Creía que los pequeños negocios y emprendedores locales no deberían conformarse con portales de impresión anónimos y de baja calidad que los tratan como un simple número. Quería darles la misma precisión y diseño prémium que disfrutan las marcas más influyentes, con la atención cercana de un vecino.
          </p>

          <p class="text-body-1 mb-6 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Por eso nació Hercules Printing Pro. Combinamos infraestructura de vanguardia con materiales de primera calidad para ofrecer una experiencia de impresión que conecta el mundo físico con el digital. Utilizamos impresión CMYK de máxima gama para que sus tarjetas y materiales no solo se entreguen, sino que sean recordados.
          </p>

          <p class="text-body-1 mb-8 text-grey-darken-2" style="line-height: 1.85; font-size: 1.1rem;">
            Combinamos precisión empresarial de élite con estándares rigurosos para ofrecer entregas locales rápidas y un servicio profundamente personalizado.
          </p>
        </template>

        <v-card class="bg-grey-lighten-4 pa-8 my-8 border" elevation="0" style="border-left: 6px solid #000000 !important;">
          <p class="text-h6 font-weight-medium text-center text-grey-darken-3 mb-0" style="line-height: 1.6;">
            "{{ isEs ? 'Precisión. Calidad. Rapidez.' : 'Precision. Quality. Speed.' }}"
          </p>
        </v-card>

        <div class="text-center mt-8">
          <div class="d-flex flex-wrap justify-center ga-4 mb-6">
            <v-btn
              color="primary"
              size="x-large"
              class="px-8 font-weight-bold text-white"
              :to="isEs ? '/es/contacto' : '/contact'"
              elevation="2"
            >
              {{ isEs ? 'Póngase en Contacto con Nosotros' : 'Get in Touch' }}
            </v-btn>
            <v-btn
              variant="outlined"
              color="primary"
              size="x-large"
              href="tel:4159374062"
              class="px-6 font-weight-bold"
            >
              <v-icon icon="mdi-phone" start></v-icon>
              415-937-4062
            </v-btn>
          </div>
          <p class="text-caption text-grey">
            {{ isEs ? 'Sirviendo a Hercules, Pinole, Crockett y Rodeo &bull; Lun - Vie: 9:00 AM - 6:00 PM' : 'Serving Hercules, Pinole, Crockett, and Rodeo &bull; Mon - Fri: 9:00 AM - 6:00 PM' }}
          </p>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useHead } from '@unhead/vue'

const route = useRoute()
const isEs = computed(() => route.path.startsWith('/es'))

useHead({
  title: computed(() => isEs.value
    ? 'Acerca de Nosotros | Hercules Printing Pro'
    : 'About Us | Hercules Printing Pro'
  ),
  meta: [
    {
      name: 'description',
      content: computed(() => isEs.value
        ? 'Conozca la historia de Hercules Printing Pro. Precisión de nivel empresarial y estándares de marcas de lujo llevados a Hercules, Pinole, Crockett y Rodeo.'
        : 'Learn about Hercules Printing Pro. Bringing enterprise-level precision and luxury brand print standards home to Hercules, Pinole, Crockett, and Rodeo.'
      )
    },
    {
      property: 'og:title',
      content: computed(() => isEs.value ? 'Acerca de Hercules Printing Pro' : 'About Hercules Printing Pro')
    },
    {
      property: 'og:url',
      content: computed(() => isEs.value ? 'https://herculesprintingpro.com/es/nosotros' : 'https://herculesprintingpro.com/about')
    }
  ],
  link: [
    {
      rel: 'canonical',
      href: computed(() => isEs.value ? 'https://herculesprintingpro.com/es/nosotros' : 'https://herculesprintingpro.com/about')
    },
    {
      rel: 'alternate',
      hreflang: 'en',
      href: 'https://herculesprintingpro.com/about'
    },
    {
      rel: 'alternate',
      hreflang: 'es',
      href: 'https://herculesprintingpro.com/es/nosotros'
    },
    {
      rel: 'alternate',
      hreflang: 'x-default',
      href: 'https://herculesprintingpro.com/about'
    }
  ]
})
</script>

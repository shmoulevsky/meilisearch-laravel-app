// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiURL: process.env.API_URL,
    },
  },
  css: [
    '~/assets/main.scss'
  ],
  script: [],
  plugins: [],
  modules: [
    ['@nuxtjs/google-fonts', {
      families: {
        Roboto: true
      }
    }],
  ],
  devtools: {enabled: true},
  ssr: false,
})

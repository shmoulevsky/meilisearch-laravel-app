// https://nuxt.com/docs/api/configuration/nuxt-config
import {resolve} from "path";

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
    '@pinia/nuxt',
  ],
  devtools: {enabled: true},
  ssr: false,
  hooks: {
    'pages:extend': (pages:Array<NuxtPage>) => {

      pages.push({
        name: 'home',
        path: '/',
        file: resolve(__dirname, 'pages/index.vue'),
      });

      pages.push({
        name: 'books.list',
        path: '/books',
        file: resolve(__dirname, 'pages/index.vue'),
      });

      pages.push({
        name: 'books.detail',
        path: '/books/:id',
        file: resolve(__dirname, 'pages/detail.vue'),
      });

      pages.push({
        name: 'books.genre',
        path: '/books/genre/:genre_id',
        file: resolve(__dirname, 'pages/index.vue'),
      });

      pages.push({
        name: 'books.author',
        path: '/books/author/:author_id',
        file: resolve(__dirname, 'pages/index.vue'),
      });

      pages.push({
        name: 'books.search',
        path: '/books/search',
        file: resolve(__dirname, 'pages/index.vue'),
      });



    }
  }
})
